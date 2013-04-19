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
        "result" => $code,
        "message" => $msg
    );
    //Hide other info

    $_SESSION['registerErrors'] = 0;

    echo json_encode($result);
    die();

}



/* Database Error
*/
function dbError($pError)
{

    $result = array(
        "result" => "0",
        "message" => "Database Error :("
    );
    //Hide other info

    $_SESSION['registerErrors'] = 0;
    echo json_encode($result);
    die();

}
