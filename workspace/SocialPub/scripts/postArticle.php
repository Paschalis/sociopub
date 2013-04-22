<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/22/13
 * Time: 10:49 PM
 * To change this template use File | Settings | File Templates.
 */

include('initializeSession.php');


// Article is valid
if ($_SESSION['article_valid'] != 1) {
    printMessage(0, 'Something went wrong. Article isn\'t saved');
}

// Get articles categories
$categoriesStr = $_POST['categories'];

//Set article invalid
$_SESSION['article_valid'] =0; // TODO CHECK

// Get data from session
$title = $_SESSION['article_title'];
$description = $_SESSION['article_description'];
$image = $_SESSION['article_image'];
$siteName = $_SESSION['article_siteName'];
$url = $_SESSION['article_url'];

$username = $_SESSION['username'];

// Get categories
$categories = explode(":", $categoriesStr);




