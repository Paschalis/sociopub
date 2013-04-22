<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/8/13
 * Time: 8:30 PM
 * To change this template use File | Settings | File Templates.
 */


class Database
{

    public $errorMessage;

    /*
    Connect to Database
     */
    public function connect()
    {


        //Include cretentials
        require_once("demetrisconfig.php");


        //If already connected
        if ($_SESSION['dbconnection'] != "") {

            //Try to ping previous connection
            if (!mysql_ping($_SESSION['dbconnection'])) {

                echo "cached connection<br>";

                return $this->connectToDatabase();
            }

        } else {
            return $this->connectToDatabase();

        }

        //return faluire code
        return 0;

    }

    function connectToDatabase()
    {

        $loginError = 0;

        // Connect & Select database
        $dbconnect = mysql_pconnect(DB_HOST, DB_USER, DB_PASSWORD) or $this->saveError(mysql_error());
        $_SESSION['dbconnection'] = $dbconnect; //Save connection to Session

        if (!$loginError) {
            //Select Database
            mysql_select_db(DB_NAME, $_SESSION['dbconnection']) or $this->saveError(mysql_error());
            return 1; //return success code
        }

        return 0;
    }


    /*
     * Save error message
     * */
    function saveError($message)
    {
        $errorMessage = $message;
    }


    /*
     * Print error message
     * */
    function printError($message)
    {
        echo "Error occured:<br>" . $message;
    }


}

