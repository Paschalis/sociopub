<?php


/*
 This file is part of SmartLib Project.

SmartLib is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

SmartLib is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with SmartLib.  If not, see <http://www.gnu.org/licenses/>.


Author: Paschalis Mpeis

Affiliation:
Data Management Systems Laboratory
Dept. of Computer Science
University of Cyprus
P.O. Box 20537
1678 Nicosia, CYPRUS
Web: http://dmsl.cs.ucy.ac.cy/
Email: dmsl@cs.ucy.ac.cy
Tel: +357-22-892755
Fax: +357-22-892701

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
    if ($status != "0") {
        if ($status == "-1") {
            printMessage(0, "You are banned from " + _NAME);
        } else if ($status == "1") {
            printMessage(0, "Account already activated");
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