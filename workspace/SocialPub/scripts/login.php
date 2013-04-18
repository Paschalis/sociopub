<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/8/13
 * Time: 8:46 PM
 * To change this template use File | Settings | File Templates.
 */

// Init session
include("initializeSession.php");


//Get username and password from our form (login.php)
$username = $_POST['username'];
$password = $_POST['password'];


//Check if user hasnt provided credencials
if ($username == "" || $password == ""
) {

    printMessage("0", "Username and password cant be empty");

}

$salt = _SALT;
$pepper = _PEPPER;

// Put salt and pepper
$password = $salt . $password . $pepper;

// Password Encryption
$password = md5($password);

// just to be sure.
$username = mysql_real_escape_string($username);

//Build the query string CHECK select * ?
$query = "SELECT * FROM USER WHERE USERNAME = '$username' AND PASSWORD = '$password'  LIMIT 1";


//Execute the query(Find all users with that password)
$result = mysql_query($query) or dbError(mysql_error());


//Username is correct

while ($row = mysql_fetch_array($result)) {
    $resusername = $row['username']; // username from DB
    $respassword = $row['password']; // password from DB
    $resname = $row['name']; // users name from DB
    $ressurname = $row['surname']; // users surname from DB
    $resemail = $row['email']; // email from DB
    $restelephone = $row['telephone']; // telephone from DB
    $resallowRequests = $row['allowRequests']; // allowRequests from DB
    $reslevel = $row['level']; // level from DB

}


// Found User in Database
if ($respassword == $password) {


// Save dta in session
    if (!$_SESSION['isMobileDevice']) {
        if ($reslevel >= 1) {
            $_SESSION['loggedin'] = "1";

            //Store user data on session
            $_SESSION['email'] = $resemail;
            $_SESSION['username'] = $resusername;
            $_SESSION['name'] = $resname;
            $_SESSION['surname'] = $ressurname;
            $_SESSION['telephone'] = $restelephone;
            $_SESSION['allowRequests'] = $resallowRequests;
            $_SESSION['level'] = $reslevel;
        } else {
            $_SESSION['loggedin'] = "0";
        }

    }

    //
    printMessage(1, "");

} //Users credencials are wrong
else {

    //If user is from webpage, mark as loggout
    if (!$_SESSION['isMobileDevice']) {
        $_SESSION['loggedin'] = "0";
    }

    //
    printMessage(0, "Failed to login into ");

}




