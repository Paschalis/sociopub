<?php


/*

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





*/


// Init session
include("initializeSession.php");


$usersActivationCode = $_REQUEST['code'];
$_SESSION['username'] = $_REQUEST['username'];


//Check if Users Act.Code and database Act.Code Match
if (getActivationCode() == $usersActivationCode) {
    activateUser();

} else {

    printMessage(0, "Wrong activation code");

}


/* Returns the activation Code from Database

*/
function getActivationCode()
{
    //Build query string
    $strQueryActivate =
        mysql_query("SELECT ACTIVATION_CODE, idUSER, NAME, STATUS FROM USER WHERE USERNAME='" . $_SESSION['username'] . "'");
    $strQueryActivate = mysql_fetch_array($strQueryActivate);



    $_SESSION['idUSER'] = $strQueryActivate['idUSER'];
    $_SESSION['name'] = $strQueryActivate['NAME'];
    $status = $strQueryActivate['STATUS'];


    // SHow messages according to statuses
    if ($status != 0) {
        if ($status == -1) {
            printMessage(2, "You are banned from " . _NAME);
        } else if ($status == 1) {
            printMessage(2, "Account already activated");
        }
        //
        die();
    }

    return $strQueryActivate['ACTIVATION_CODE'];
}

//Activates the user
function activateUser()
{
    $activationresult =
        mysql_query("UPDATE USER SET STATUS='1', ACTIVATION_CODE=null WHERE idUSER='" . $_SESSION['idUSER'] . "'");

    if ($activationresult == "1") {
        printMessage(1, "Account Successfully activated");
    } else {
        printMessage(0, "Failed to activate user: Database Error :(");
    }

}

?>