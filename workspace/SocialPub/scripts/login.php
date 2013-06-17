<?php
/**

Copyright 2013, Internet Technologies course Team, at Computer Science Dept., University of Cyprus,

Members:
Dr. Marios Dikaiakos,
Dimitris Christofi, Paschalis Mpeis, Pampos Charalambous.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.




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

    printMessage("0", "Username or password cant be empty");

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
    $RESusername = $row['USERNAME'];
    $RESname = $row['NAME'];
    $RESsurname = $row['SURNAME'];
    $REScountry = $row['COUNTRY'];
    $RESemail = $row['EMAIL'];
    $RESpassword = $row['PASSWORD'];
    $REgender = $row['GENDER'];
    $RESstatus = $row['STATUS'];
}



// Found User in Database
if ($RESpassword == $password) {


// Save dta in session
    if ($RESstatus >= 1) {
        $_SESSION['loggedin'] = "1";

        //Store user data on session
        $_SESSION['username'] = $RESusername;
        $_SESSION['name'] = $RESname;
        $_SESSION['surname'] = $RESsurname;
        $_SESSION['country'] = $REScountry;
        $_SESSION['email'] = $RESemail;
        $_SESSION['gender'] = $REgender;
        $_SESSION['status'] = $RESstatus;


        printMessage(1, "");

    } else {

        $_SESSION['loggedin'] = "0";

        if ($RESstatus == 0) {
            printMessage(2, "Your account hasn't yet activated. Please activate it using your email.");
        }
        else if ($RESstatus == -1) {
            printMessage(2, "Your account is banned.");
        }
    }

    //


} //Users credencials are wrong
else {

    //If user is from webpage, mark as loggout
    if (!$_SESSION['isMobileDevice']) {
        $_SESSION['loggedin'] = "0";
    }

    //
    printMessage(0, "Failed to login into " . _NAME);

}




