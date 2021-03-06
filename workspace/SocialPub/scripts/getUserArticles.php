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




 */
header('Content-type: text/html; charset=UTF-8');


include("initializeSession.php");

$username = mysql_real_escape_string($_SESSION['username']);

$query = mysql_real_escape_string($_POST['q']);

$getArticles = "CALL get_user_articles('" . $username . "','". $query ."')";

$result = mysql_query($getArticles) or handleGetArticlesError(mysql_error());

$found=0;
include('Encoding.php');


while ($row = mysql_fetch_assoc($result)) {


    //found elements
    if(!$found){

        $code['code']='1';

        $row_set[] = $code;

        $found=1;
    }



    $renamedRow['uid'] = $row['idARTICLE'];

//    $renamedRow['title'] = $row['TITLE'];
//    $renamedRow['description'] = $row['DESCRIPTION'];


    $renamedRow['title'] = Encoding::toUTF8($row['TITLE']);
    $renamedRow['description']  = Encoding::toUTF8($row['DESCRIPTION']);


    $renamedRow['url'] = $row['URL'];
    $renamedRow['added'] = strtotime($row['TIME']);
    $renamedRow['views'] = $row['VIEWS'];
    $renamedRow['shares'] = $row['SHARES'];

    $renamedRow['site'] = substr($row['SITE_NAME'], 0, 20);



    $renamedRow['likes'] = $row['LIKES'];

    //Save personal :like, view, favorite
    $renamedRow['like'] = $row['LIKED'];
    $renamedRow['view'] = $row['VIEWED'];
    $renamedRow['readLater'] = $row['READ_LATER'];


    if($row['IMG_URL']!=""){
        $renamedRow['image'] = $row['IMG_URL'];
    }
    else{
    $renamedRow['image'] = "";// "./img/default.png";
    }



    $categoriesTables = explode(',', $row['CATEGORY']);

    $renamedRow['tags'] = $categoriesTables;

    $row_set[] = $renamedRow;
}

//found elements
if(!$found){

    $code['code']='0';
    $row_set[] = $code;

}

//$row_set[] = array_map('utf8_encode', $row_set);
//$encoded_rows[] = array_map(utf8_encode, $row_set);



$json = json_encode($row_set);

echo iconv("UTF-8", "UTF-8//IGNORE", $json);



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