<?php

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