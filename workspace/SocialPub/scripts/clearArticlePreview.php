<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 5/6/13
 * Time: 3:32 AM
 * To change this template use File | Settings | File Templates.
 */

header('Content-type: text/html; charset=UTF-8');

// Assume that article is not valid
$_SESSION['valid_article']=0;


include("initializeSession.php");


// Clear article preview data
$_SESSION['article_valid']=0;
$_SESSION['article_title']="";
$_SESSION['article_image']="";
$_SESSION['article_siteName']="";
$_SESSION['article_url']="";

// Print results
$result = array(
    "code" => 1,
    "message" => "Article cleared",
);


echo json_encode($result);


die();


?>