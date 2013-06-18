<?php
/**

Copyright 2013, Internet Technologies course (code epl425) Team, at Computer Science Dept., University of Cyprus,

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
