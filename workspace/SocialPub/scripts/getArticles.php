<?php

header('Content-type: text/html; charset=UTF-8');


include("initializeSession.php");


$username = $_SESSION['username'];

$username = "pampos";

$getArticles = "CALL get_articles('" . $username . "')";


$result = mysql_query($getArticles) or handleGetArticlesError(mysql_error());


while ($row = mysql_fetch_assoc($result)) {


    $tmpRow = $row;


    $renamedRow['uid'] = $row['idARTICLE'];
    $renamedRow['title'] = $row['TITLE'];
    $renamedRow['url'] = $row['URL'];
    $renamedRow['added'] = strtotime($row['TIME']);
//    $renamedRow['type'] = "page";
    $renamedRow['views'] = $row['WATCHES'];
    $renamedRow['likes'] = $row['LIKES'];
//    $renamedRow['comments'] = "";
//    $renamedRow['permalink'] = "";
//    $renamedRow['tinyurl'] = "";

//    $renamedRow['thumbnail'] = "";

    if($row['IMG_URL']!=""){
        $renamedRow['image'] = $row['IMG_URL'];
    }
    else{
    $renamedRow['image'] = "../img/default.png";
    }


    $renamedRow['referer'] = "";
    $renamedRow['description'] = $row['DESCRIPTION'];



//    $renamedRow['siteName'] = $row['SITE_NAME'];
//    $renamedRow['favorites'] = $row['FAVORITES'];
//    $renamedRow['shares'] = $row['SHARES'];


    $categoriesTables = explode(',', $row['CATEGORY']);

    $renamedRow['tags'] = $categoriesTables;

    $renamedRow['inthezoo'] = false;
    $renamedRow['public'] = true;

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