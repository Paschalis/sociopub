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
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/22/13
 * Time: 10:49 PM
 * To change this template use File | Settings | File Templates.
 */

include('initializeSession.php');


// Username
$username = $_SESSION['username'];

// Get articles categories
$articleID = $_POST['articleID'];


$likeArticleSrt = "CALL toggle_like_article('".$articleID."','".$username."')";

$result = mysql_query($likeArticleSrt) or handleLikeArticleError(mysql_error());



$row = mysql_fetch_assoc($result); // get the results

$resultCode = $row['RESULT'];


//  RESULT:  1: Successfully added
//  RESULT:  2: article already exists, but dont exists for current user

switch($resultCode){
    // Successfully liked
    case 1:
    case 0:
        printLikedData($resultCode, $row);
        break;
    //Something went wrong
    case -1:
    case -2:
    case -3:
        printMessage($resultCode,"");
        break;
}

/*
 * Print result code + article data
 * code: 1 article added
 * code: 2 article existed for other users and just added for current user
 *
 * */
function printLikedData($resultCode, $row){

    $renamedRow['code'] = $resultCode;
    $renamedRow['likes'] = $row['LIKES'];

    echo json_encode($renamedRow);

    die();

}






/*
 * Handle likeArticle error from mySQL database
 *
 * */

function handleLikeArticleError($errorMsg){
    echo "Error: " . $errorMsg.'<br>';
    die();
}






