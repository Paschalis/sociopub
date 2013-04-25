<?php

header('Content-type: text/html; charset=UTF-8');


include("initializeSession.php");

$getArticles = "CALL get_articles()";

$result = mysql_query($getArticles) or handleGetArticlesError(mysql_error());


while ($row = mysql_fetch_assoc($result)) {


    $tmpRow = $row;


    $renamedRow['uid'] = $row['idARTICLE'];
    $renamedRow['url'] = $row['URL'];
    $renamedRow['title'] = $row['TITLE'];
    $renamedRow['added'] = $row['TIME'];
    $renamedRow['image'] = $row['IMG_URL'];
    $renamedRow['description'] = $row['DESCRIPTION'];
    $renamedRow['siteName'] = $row['SITE_NAME'];
    $renamedRow['likes'] = $row['LIKES'];
    $renamedRow['views'] = $row['WATCHES'];
    $renamedRow['favorites'] = $row['FAVORITES'];
    $renamedRow['shares'] = $row['SHARES'];
    $renamedRow['shares'] = $row['SHARES'];


    $categoriesTables = explode( ',', $row['CATEGORY']);

    $renamedRow['tags'] = $categoriesTables;

    $row_set[] = $renamedRow;
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