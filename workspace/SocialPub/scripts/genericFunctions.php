<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/9/13
 * Time: 12:38 AM
 * To change this template use File | Settings | File Templates.
 */



/*
 * Print code and a message
 * */
function printMessage($code, $msg)
{
    $result = array(
        "code" => $code,
        "message" => $msg
    );

    echo json_encode($result);
    die();

}



/* Database Error
*/
function dbError($pError)
{

    $result = array(
        "code" => "0",
        "message" => "Database Error :("
    );
    //Hide other info

    $_SESSION['registerErrors'] = 0;
    echo json_encode($result);
    die();

}


/*
 * Checks if a remove url exists
 * */
function checkRemoteFile($url)
{


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}
