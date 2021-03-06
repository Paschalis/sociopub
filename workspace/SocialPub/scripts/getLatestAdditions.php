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


 * */


header('Content-type: text/html; charset=UTF-8');


include("initializeSession.php");

$username = mysql_real_escape_string($_SESSION['username']);

$limit = 20; //CHECK make this variable?

$getLatestArticles = "CALL get_latest_articles('" . $username . "','". $limit ."')";

$result = mysql_query($getLatestArticles) or handleGetArticlesError(mysql_error());

$found=0;

while ($row = mysql_fetch_assoc($result)) {

    //found elements
    if(!$found){

        $code['code']='1';

        $row_set[] = $code;

        $found=1;
    }



    $renamedRow['title'] = $row['TITLE'];
    $renamedRow['url'] = $row['URL'];
    $renamedRow['likes'] = $row['LIKES'];
    $renamedRow['views'] = $row['VIEWS'];
    $renamedRow['shares'] = $row['SHARES'];



    $row_set[] = $renamedRow;
}

//found elements
if(!$found){

    $code['code']='0';
    $row_set[] = $code;

}


echo json_encode($row_set);

die();


/*
 * Handle postArticle error from mySQL database
 *
 * */

function handleGetArticlesError($errorMsg)
{
    echo "Error: " . $errorMsg . '<br>';
    die();
}


?>