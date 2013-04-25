<?php
/**
 * Created by JetBrains PhpStorm.
 * User: pampos
 * Date: 4/22/13
 * Time: 10:49 PM
 * To change this template use File | Settings | File Templates.
 */

include('initializeSession.php');


// Username
$username = $_SESSION['username'];

// Get articles categories
$articleID = $_POST['articleID'];

// TODO CHANGE THIS LATER
$username = "pampos";
$articleID = "20";
$like = "0";






$likeArticleSrt = "SELECT like_article('".$articleID."','".$username."','".$like."')";


echo $postArticleSrt;

$result = mysql_query($likeArticleSrt) or handleLikeArticleError(mysql_error());

//Query runned successfully
if ($result) {

    // Get result code
    $resultCode = mysql_result($result,0,0);

    // Print result code
    printMessage($resultCode,"");
    // -2: Article NOT exists
    // -1: User NOT exissts
    //  0: User_Article NOT exists
    //  1: OK
}

/*
 * Handle likeArticle error from mySQL database
 *
 * */

function handleLikeArticleError($errorMsg){
    echo "Error: " . $errorMsg.'<br>';
    die();
}






