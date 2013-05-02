<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dimitros
 * Date: 23/4/2013
 * Time: 4:27 πμ
 * To change this template use File | Settings | File Templates.
 */

$username = $_SESSION['username'];

$query = "SELECT * FROM USER_ARTICLE WHERE USERNAME = '$username' AND PASSWORD = '$password'  LIMIT 1";


//QUEry till now
/*SELECT A.URL
FROM paschal_socialpub.ARTICLE A
WHERE A.IDARTICLE =
    (SELECT A1.IDUSER
FROM paschal_socialpub.USER_ARTICLE A1
WHERE A1.IDUSER = 11);

*/
?>