<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Paschalis
 * Date: 4/20/13
 * Time: 10:39 AM
 * To change this template use File | Settings | File Templates.
 */


include("initializeSession.php");

$_SESSION['loggedin'] = "0";

//Store user data on session
$_SESSION['username'] = "";
$_SESSION['name'] = "";
$_SESSION['surname'] = "";
$_SESSION['country'] = "";
$_SESSION['email'] = "";
$_SESSION['gender'] = "";
$_SESSION['status'] = "";

//Reload webpage

printMessage(1,"");