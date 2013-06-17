<?php
/**

Copyright 2013, Internet Technologies course Team, at Computer Science Dept., University of Cyprus,

Members:
Dr. Marios Dikaiakos,
Dimitris Christofi, Paschalis Mpeis, Charalambos Charalambous.

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