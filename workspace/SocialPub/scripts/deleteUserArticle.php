<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/22/13
 * Time: 10:49 PM
 * To change this template use File | Settings | File Templates.
 */

include('initializeSession.php');

// Get Article
$idArticle = $_POST['articleID'];
// Get username
$username = $_SESSION['username'];



$deleteArticleSrt = "SELECT delete_users_article('".$username ."',".$idArticle.");";

$result = mysql_query($deleteArticleSrt) or handlePostArticleError(mysql_error());

//Query runned successfully
if ($result) {

    // Get result code
    $resultCode = mysql_result($result,0,0);

    switch($resultCode){
        case 1:
            // Print result code
            printMessage(1,"Article successfully deleted");
            break;
        case -1:
            // Print result code
            printMessage(0,"Something went wrong. User doesnt exist!");
            break;
        case -2:
            // Print result code
            printMessage(0,"Article doesnt exists");
            break;
        case -3:
            // Print result code
            printMessage(0,"Article already deleted");
            break;
    }
}
 else{
        // Print result code
        printMessage(0,"Something went wrong!");
        }







/*
 * Handle postArticle error from mySQL database
 *
 * */

function handlePostArticleError($errorMsg){
    echo "Error: " . $errorMsg.'<br>';
    die();
}


