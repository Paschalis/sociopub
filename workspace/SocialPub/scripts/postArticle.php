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


$categories = $_POST['categories'];

// Get data from session
$title = $_SESSION['article_title'];
$description = $_SESSION['article_description'];
$image = $_SESSION['article_image'];
$siteName = $_SESSION['article_siteName'];
$url = $_SESSION['article_url'];
$username = $_SESSION['username'];

//Escape arguments
$title = mysql_real_escape_string($title);
$description = mysql_real_escape_string($description);
$image = mysql_real_escape_string($image);
$siteName = mysql_real_escape_string($siteName);
$url = mysql_real_escape_string($url);
$username = mysql_real_escape_string($username);


$postArticleSrt = "CALL post_users_article(\"".$title."\",\"".$description."\",\"".$image."\",\"".$siteName."\",\"".$url."\",\"".$username."\",\"".$categories."\")";


$result = mysql_query($postArticleSrt) or handleGetArticlesError(mysql_error());

$row = mysql_fetch_assoc($result); // get the results

$resultCode = $row['RESULT'];


//  RESULT:  1: Successfully added
//  RESULT:  2: article already exists, but dont exists for current user

    switch($resultCode){
        case 2:
        case 1:
            printArticleData($resultCode, $row, $postArticleSrt);
            break;
        case -1:
            // Print result code
            printMessage(0,"Something went wrong. User doesnt exists!");
            break;
        case -2:
            // Print result code
            printMessage(0,"Article already exists");
            break;
    }

/*
 * Print result code + article data
 * code: 1 article added
 * code: 2 article existed for other users and just added for current user
 *
 * */
function printArticleData($resultCode, $row, $postArticleSrt){
    $renamedRow['code'] = $resultCode;
    $renamedRow['uid'] = $row['idARTICLE'];
    $renamedRow['title'] = $row['TITLE'];
    $renamedRow['url'] = $row['URL'];
    $renamedRow['added'] = strtotime($row['TIME']);
    $renamedRow['views'] = $row['VIEWS'];
    $renamedRow['shares'] = $row['SHARES'];
    $renamedRow['site'] =  substr($row['SITE_NAME'], 0, 20);

    //Save like
    $renamedRow['likes'] = $row['LIKES'];

    $renamedRow['like'] = $row['LIKED'];
    $renamedRow['viewed'] = $row['VIEWED'];
    $renamedRow['readLater'] = $row['READ_LATER'];


    if($row['IMG_URL']!=""){
        $renamedRow['image'] = $row['IMG_URL'];
    }
    else{
        $renamedRow['image'] = "";
    }

    $renamedRow['description'] = $row['DESCRIPTION'];
    $renamedRow['query'] =  $postArticleSrt;

    $categoriesTables = explode(',', $row['CATEGORY']);

    $renamedRow['tags'] = $categoriesTables;

    echo json_encode($renamedRow);

    die();

}

/*
 * Handle postArticle error from mySQL database
 *
 * */

function handleGetArticlesError($errorMsg)
{
    echo "Error: " . $errorMsg . '<br>';
    die();
}









//Set article invalid
$_SESSION['article_valid'] =0; // TODO CHECK




