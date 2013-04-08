<?php
/**
 * User registers to our system
 *
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/8/13
 * Time: 9:19 PM
 * To change this template use File | Settings | File Templates.
 */


include("initializeSession.php");

//Get data from webpage
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['confPassword'] = $_POST['confPassword'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['surname'] = $_POST['surname'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['country'] = $_POST['telephone'];


//Save errors to inform user
$_SESSION['regHasErrors'] = "0";
$_SESSION['regMessage'] = "";


//Gather errors
if ($_SESSION['username'] == "" || strlen($_SESSION['username']) > 30) {
    $_SESSION['regHasErrors'] = 1;
}

if ($_SESSION['password'] == "" || strlen($_SESSION['password']) > 40) {
    $_SESSION['regHasErrors'] = 1;
}

if ($_SESSION['confPassword'] == "" || strlen($_SESSION['confPassword']) > 40) {
    $_SESSION['regHasErrors'] = 1;
}

if ($_SESSION['password'] != $_SESSION['confPassword']) {
    $_SESSION['regHasErrors'] = 1;
}

if ($_SESSION['name'] == "" || strlen($_SESSION['name']) > 40) {
    $_SESSION['regHasErrors'] = 1;
}

if ($_SESSION['surname'] == "" || strlen($_SESSION['surname']) > 50) {
    $_SESSION['regHasErrors'] = 1;
}

if ($_SESSION['email'] == "" || !isEmailCorrect($_SESSION['email']) || strlen($_SESSION['email']) > 80) {
    $_SESSION['regHasErrors'] = 1;
}

if ($_SESSION['country'] == "" || strlen($_SESSION['country'] > 60) ) {
    $_SESSION['regHasErrors'] = 1;
}


// TODO LEFTHERE

//Check if is the first User (= Admin/Owner)

$queryFirstUser = sprintf("SELECT username FROM SMARTLIB_USER");
$allUsernames = mysql_query($queryFirstUser);
$allUsernamesNum = mysql_num_rows($allUsernames);


//User level is admin
if ($allUsernamesNum == 0) {
    $_SESSION['foundLevel'] = "3";
} else {
    $_SESSION['foundLevel'] = "0";
}

// Check username uniqueness
$queryFindUsernames = sprintf("SELECT username FROM SMARTLIB_USER WHERE username='%s'",
    mysql_real_escape_string($_SESSION['username']));


$usernameMatches = mysql_query($queryFindUsernames);
$usernameMatchesNum = mysql_num_rows($usernameMatches);

if ($usernameMatchesNum > 0) {
    $_SESSION['errUsername'] = "1";
    $_SESSION['regHasErrors'] = 1;
    $_SESSION['regMessage'] .= "Username already registered</br>";
}


// Check email uniqueness
$emailMatches = mysql_query("SELECT email FROM SMARTLIB_USER WHERE email='" . $_SESSION['REGemail'] . "'");
$emailMatchesNum = mysql_num_rows($emailMatches);

//Already registered email
if ($emailMatchesNum > 0) {
    $_SESSION['errEmail'] = "1";
    $_SESSION['regHasErrors'] = 1;
    $_SESSION['regMessage'] .= "Email already registered</br>";
}


//Registration Input was correct
if ($_SESSION['regHasErrors'] == "0") {

    //Register user to database
    registerUserToDatabase();

    //Registration completed
    if ($_SESSION['regHasErrors'] == "0") {
        if ($_SESSION['isMobileDevice']) {
            mobileSendLoginSuccess();
        } else {


            $msg = "";

            if ($_SESSION['foundLevel'] == "3") {
                $msg = "Your administrator/owner account successfully created<br>" .
                    " No activation threw email needed for this account.<br>" .
                    "All other accounts must be activated using their email address given.";
            } else {
                $msg = "Your account successfully created<br>" .
                    "Please Activate it using your email: <br>" . $_SESSION['REGemail'];

            }


            $result = array(
                "result" => "1",
                "message" => $msg
            );

            echo json_encode($result);
            die();
        }

    }

}

//Registration Info is wrong
if ($_SESSION['regHasErrors'] != "0") {

    if ($_SESSION['isMobileDevice']) {
        mobileSendRegisterError();
    } else {
        printError();
    }

}

function printError()
{
    $result = array(
        "result" => "0",
        "message" => $_SESSION['regMessage']
    );
    //Hide other info

    $_SESSION['regHasErrors'] = 0;

    echo json_encode($result);
    die();

}


//Functions
//Generates the Activation Code
function generateActivationCode()
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $str = "";

    $size = strlen($chars);
    for ($i = 0; $i < 10; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }

    return $str;
}

//Registers a user to Database
function registerUserToDatabase()
{

    //Generate User's Activation Code
    $activationCode = generateActivationCode();

    //Increase protection
    $salt = _SALT;
    $pepper = _PEPPER;

    $encPassword = $_SESSION['REGpassword'];
    // Put salt&pepper on password
    $encPassword = $salt . $encPassword . $pepper;

    // Password Encryption
    $encPassword = md5($encPassword);

    $allowRequests = 0;


    //User allow app Notifications
    if ($_SESSION['REGappNotif'] == "on") {
        //User allows Both Notifications
        if ($_SESSION['REGemailNotif'] == "on") {
            $allowRequests = 3;
        } //User wants only App notifications
        else $allowRequests = 1;
    } //User wants only Email notifications
    else if ($_SESSION['REGemailNotif'] == "on") {
        $allowRequests = 2;
    } //User wont share its books
    else $allowRequests = 0;

    $queryInsertUser = sprintf("INSERT INTO SMARTLIB_USER (username, password, name, surname, email,"
            . "telephone,allowRequests,activationCode, level) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
        mysql_real_escape_string($_SESSION['username']),
        mysql_real_escape_string($encPassword),
        mysql_real_escape_string($_SESSION['REGname']),
        mysql_real_escape_string($_SESSION['REGsurname']),
        mysql_real_escape_string($_SESSION['REGemail']),
        mysql_real_escape_string($_SESSION['REGtelephone']),
        $allowRequests,
        mysql_real_escape_string($activationCode),
        $_SESSION['foundLevel']
    );

    //Insert User to database
    $insert = mysql_query($queryInsertUser) or dbError(mysql_error());


    //Library has a email server
    if ($_SESSION['foundLevel'] == "3") {

        $strTo = $_SESSION['REGemail'];
        $strSubject = "SmartLib " . _NAME . " Activation";
        $strHeader = "From: Smartlib " . _NAME . " <" . _EMAIL . ">";
        $strMessage = "Hello " . $_SESSION['REGname'] . ",\nWelcome to the library of the modern world.\n" .
            "\n\nTo activate your account please follow this link: \n\n" .
            _LIB_URL .
            "activate.php?uLnk=yes&uLnkUsername=" . $_SESSION['username'] .
            "&activationCode=" . $activationCode . "\n\nThank you,\nSmartLib Team";


        // @ = avoid showing error
        //$flgSend = ;

        if (@mail($strTo, $strSubject, $strMessage, $strHeader)) {
        } else {
            $_SESSION['errEmail'] = "1";
            $_SESSION['regHasErrors'] = "1";
            $_SESSION['regMessage'] .= "Email address is invalid!</br>";

            printError();

        }
    } else {

        $strTo = $_SESSION['REGemail'];
        $strSubject = "SmartLib " . _NAME . "  Activation";
        $strHeader = "From: Smartlib " . _NAME . " <" . _EMAIL . ">";
        $strMessage = "Hello " . $_SESSION['REGname'] . ",\nWelcome to the library of the modern world.\n" .
            "\n\nTo activate your account please follow this link: \n\n" .
            _LIB_URL .
            "activate.php?uLnk=yes&uLnkUsername=" . $_SESSION['username'] .
            "&activationCode=" . $activationCode . "\n\nThank you,\nSmartLib Team";


        // @ = avoid showing error
        //$flgSend = ;

        if (@mail($strTo, $strSubject, $strMessage, $strHeader)) {
        } else {
            $_SESSION['errEmail'] = "1";
            $_SESSION['regHasErrors'] = "1";
            $_SESSION['regMessage'] .= "Email address is invalid!</br>";

            printError();

        }

    }


}

////////////// Functions

//Returns the URL user is, without include the last page in the URL path

function getCustomURL()
{

    $len = strlen($_SERVER['REQUEST_URI']);

    for ($i = $len - 1; $i > 0; $i--) {
        //Remove the last name of the URI
        if ($_SERVER['REQUEST_URI'][$i] == "/") {

            $found = 1;

            $urlResult = substr($_SERVER['REQUEST_URI'], 0, $i + 1);
            break;
        }

    }

    if (!$found)
        $urlResult = $_SERVER['REQUEST_URI'];

    return $_SERVER['SERVER_NAME'] . $urlResult;

}


function isTelephoneCorrect($telephone)
{
    if (!ereg("^((\+[1-9]{3,4}|0[1-9]{4}|00[1-9]{3})\-?)?[0-9]{8,20}$", $telephone)) {
        // Email invalid because wrong number of characters
        // in one section or wrong number of @ symbols.
        return false;
    } // else if($telephone=="")
    // TODO Check if its correct!   return false;
    else
        return true;
}

//Checks if the email is correct
function isEmailCorrect($email)
{
    // First, we check that there's one @ symbol,
    // and that the lengths are right.
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters
        // in one section or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if
        (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
				↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
            $local_array[$i])
        ) {
            return false;
        }
    }
    // Check if domain is IP. If not,
    // it should be valid domain name
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if
            (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
					↪([A-Za-z0-9]+))$",
                $domain_array[$i])
            ) {
                return false;
            }
        }
    }
    return true;

}

//Mobile Device Functions
// Sends error to mobile device using JSON Object Format
function mobileSendRegisterError()
{
    //Convert HTML New Line to Java New Line
    $javaMSG = $_SESSION['regMessage'];
    $oldNL = "</br>";
    ;
    $newNL = "\n";

    $offset = 0;
    $i = 1;
    $tmpOldStrLength = strlen($oldNL);
    while (($offset = strpos($javaMSG, $oldNL, $offset)) !== false) {
        $javaMSG = substr_replace($javaMSG, $newNL, $offset, $tmpOldStrLength);
    }


    $result = array(
        "result" => "0",
        "message" => $javaMSG
    );
    //Encode Answer
    echo json_encode($result);

    die();
}

//Mobile Device Functions
// Sends error to mobile device using JSON Object Format
function mobileSendLoginSuccess()
{
    $result = array(
        "result" => "1"
    );
    //Encode Answer
    echo json_encode($result);

    die();
}


// TODO Sends error to mobile device using JSON Object Format
function mobileSendDatabaseError()
{
    $result[] = array(
        "result" => "-11"
    );
    //Encode Answer
    echo json_encode($result);

    die();
}


// Database Error
function dbError($pError)
{

    if ($_SESSION['isMobileDevice']) {
        //Inform Mobile Device about database Error
        mobileSendDatabaseError();
    }

    $result = array(
        "result" => "0",
        "message" => "Database Error :("
    );
    //Hide other info

    $_SESSION['regHasErrors'] = 0;
    echo json_encode($result);
    die();

}
