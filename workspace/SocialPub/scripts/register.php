<?php
/**

Copyright 2013 Paschalis Mpeis

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.




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
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['confPassword'] = $_POST['confPassword'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['surname'] = $_POST['surname'];
$_SESSION['country'] = $_POST['country'];
$_SESSION['gender'] = $_POST['gender'];


//Save errors to inform user
$_SESSION['registerErrors'] = "0";

$_SESSION['errorMessage'] = "";

//TODO REMOVE


//Gather errors
if ($_SESSION['username'] == "" || strlen($_SESSION['username']) > 30) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error in username<br>";
}

if ($_SESSION['password'] == "" || strlen($_SESSION['password']) > 40) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error in password<br>";
}

if ($_SESSION['confPassword'] == "" || strlen($_SESSION['confPassword']) > 40) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error in password confirmation<br>";
}

if ($_SESSION['password'] != $_SESSION['confPassword']) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Password and confirmation dont match<br>";
}

if ($_SESSION['name'] == "" || strlen($_SESSION['name']) > 40) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error in name<br>";
}

if ($_SESSION['surname'] == "" || strlen($_SESSION['surname']) > 50) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error in surname<br>";
}

if ($_SESSION['email'] == "" || !isEmailCorrect($_SESSION['email']) || strlen($_SESSION['email']) > 80) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error at email<br>";
}

if ($_SESSION['country'] == "" || strlen($_SESSION['country'] > 60)) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error in country<br>";
}

if (!($_SESSION['gender'] == "f" || $_SESSION['gender'] == "m")){
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].="Error in gender<br>";
}

// Check username uniqueness
$strQueryFindUsernames = sprintf("SELECT USERNAME FROM USER WHERE USERNAME='%s'",
    mysql_real_escape_string($_SESSION['username']));


$usernameMatches = mysql_query($strQueryFindUsernames);
$usernameMatchesNum = mysql_num_rows($usernameMatches);

if ($usernameMatchesNum > 0) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].= "Username already registered</br>";
}


// Username already registered
$emailMatches = mysql_query("SELECT EMAIL FROM USER WHERE EMAIL='" . $_SESSION['email'] . "'");
$emailMatchesNum = mysql_num_rows($emailMatches);

// Email already registered
if ($emailMatchesNum > 0) {
    $_SESSION['registerErrors'] = 1;
    $_SESSION['errorMessage'].= "Email already registered</br>";
}



// Registration input is correct
if ($_SESSION['registerErrors'] == 0) {

    //Register user to database
    registerUserToDatabase();

    //Registration completed
    if ($_SESSION['registerErrors'] == "0") {
        if ($_SESSION['isMobileDevice']) {
            mobileSendLoginSuccess();
        } else {


            $msg = "You have successfully registered.<br>" .
                "Please activate your account using your email: ".$_SESSION['email'];

            printMessage(1,$msg);

            //Clear error messages+codes
            $_SESSION['errorMessage']="";

        }

    }

}

// Something went wrong
if ($_SESSION['registerErrors'] != "0") {

    printMessage(0,$_SESSION["errorMessage"]);


}




/* Functions
Generates the Activation Code */
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

/* Registers a user to Database */
function registerUserToDatabase()
{

    //Generate User's Activation Code
    $activationCode = generateActivationCode();

    //Increase protection
    $salt = _SALT;
    $pepper = _PEPPER;

    $encPassword = $_SESSION['password'];
    // Put salt&pepper on password
    $encPassword = $salt . $encPassword . $pepper;

    // Password Encryption
    $encPassword = md5($encPassword);


    // Create query string
    $queryInsertUser = sprintf("INSERT INTO USER (USERNAME, PASSWORD, NAME, SURNAME, COUNTRY,"
            . "EMAIL, GENDER, STATUS, ACTIVATION_CODE) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
        mysql_real_escape_string($_SESSION['username']),
        mysql_real_escape_string($encPassword),
        mysql_real_escape_string($_SESSION['name']),
        mysql_real_escape_string($_SESSION['surname']),
        mysql_real_escape_string($_SESSION['country']),
        mysql_real_escape_string($_SESSION['email']),
        mysql_real_escape_string($_SESSION['gender']),
        "0",
        mysql_real_escape_string($activationCode)
    );

    //Insert User to database
    $insert = mysql_query($queryInsertUser) or dbError(mysql_error());


    // Notify user to activate the account
    $strTo = $_SESSION['email'];
    $strSubject = "Sociopub Activation";
    $strHeader = "From: Sociopub <" . _EMAIL . ">";
    $strMessage = "Hello " . $_SESSION['name'] . ",\nWelcome to Social Publishing system.\n" .
        "\n\nTo activate your account please follow this link: \n\n" .
        _URL .
        "/scripts/activate.php?username=" . $_SESSION['username'] .
        "&code=" . $activationCode . "\n\nThank you,\nSocioPub Team";


    // @ = avoid showing error
    //$flgSend = ;

    // Send email to user
    if (@mail($strTo, $strSubject, $strMessage, $strHeader)) {
    } else {
        $_SESSION['registerErrors'] = "1";

        printMessage(0, "Email address is invalid!</br>");

    }


}

////////////// Functions


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


