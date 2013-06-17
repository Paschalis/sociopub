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
 * User: paschalis
 * Date: 4/22/13
 * Time: 10:49 PM
 * To change this template use File | Settings | File Templates.
 */

include('initializeSession.php');

// Get Article
$idArticle = $_POST['articleID'];
// Get username
$username = $_SESSION['username'];



$deleteArticleSrt = "SELECT delete_users_article('".$username ."',".$idArticle.");";

$result = mysql_query($deleteArticleSrt) or handlePostArticleError(mysql_error());

//Query runned successfully
if ($result) {

    // Get result code
    $resultCode = mysql_result($result,0,0);

    switch($resultCode){
        case 1:
            // Print result code
            printMessage(1,"Article successfully deleted");
            break;
        case -1:
            // Print result code
            printMessage(0,"Something went wrong. User doesnt exist!");
            break;
        case -2:
            // Print result code
            printMessage(0,"Article doesnt exists");
            break;
        case -3:
            // Print result code
            printMessage(0,"Article already deleted");
            break;
    }
}
 else{
        // Print result code
        printMessage(0,"Something went wrong!");
        }







/*
 * Handle postArticle error from mySQL database
 *
 * */

function handlePostArticleError($errorMsg){
    echo "Error: " . $errorMsg.'<br>';
    die();
}


