<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/22/13
 * Time: 10:49 PM
 * To change this template use File | Settings | File Templates.
 */

include('initializeSession.php');

$categories = $_POST['categories'];

//REMOVE WHEN DONE!
$categories = "news:sports";

// Get data from session
$title = $_SESSION['article_title'];
$description = $_SESSION['article_description'];
$image = $_SESSION['article_image'];
$siteName = $_SESSION['article_siteName'];
$url = $_SESSION['article_url'];



$title = "title";
$description = "desc";
$image = "url";
$siteName ="books" ;
$url = "face.www.twit";
$username = "demetris";

//Escape arguments
$title = mysql_real_escape_string($title);
$description = mysql_real_escape_string($description);
$image = mysql_real_escape_string($image);
$siteName = mysql_real_escape_string($siteName);
$url = mysql_real_escape_string($url);
$username = mysql_real_escape_string($username);


$postArticleSrt = "SELECT post_article('".$title."','".$description."','".$image."','".$siteName."','".$url."','".$username."','".$categories."')";

$result = mysql_query($postArticleSrt) or handlePostArticleError(mysql_error());

//Query runned successfully
if ($result) {

    // Get result code
    $resultCode = mysql_result($result,0,0);

     // Print result code
    printMessage($resultCode,"");

}




die(); // TODO RE ENABLE



/*
 * Handle postArticle error from mySQL database
 *
 * */

function handlePostArticleError($errorMsg){
    echo "Error: " . $errorMsg.'<br>';
    die();
}


// Article is valid
if ($_SESSION['article_valid'] != 1) {
    printMessage(0, 'Something went wrong. Article isn\'t saved');
}

// Get articles categories


//Set article invalid
$_SESSION['article_valid'] =0; // TODO CHECK




