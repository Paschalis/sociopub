<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/11/13
 * Time: 1:34 AM
 * To change this template use File | Settings | File Templates.
 */

if ($_SESSION["loggedIn"] == 1) {
    echo "Hooray! User is logged in!<br>";
} else {
    include("loginScreen.php");

}



/**  */