<?php
/**
 *
 * Initializes session,  and gets database connection
 *
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/8/13
 * Time: 8:57 PM
 * To change this template use File | Settings | File Templates.
 */

session_start();

include("genericFunctions.php");

// Include database class
require("database.php");

$database = new Database();

if(!$database->connect()){
    // save error
    $_SESSION["errorMessage"]="Database error";

}
else{
    $_SESSION["errorMessage"]="";
}