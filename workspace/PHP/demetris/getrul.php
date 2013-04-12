<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dimitros
 * Date: 12/4/2013
 * Time: 8:15 μμ
 * To change this template use File | Settings | File Templates.
 */

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<script>
    function geturl(){

       /* var newURL = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
        var pathArray = window.location.pathname.split( '/' );
        var secondLevelLocation = pathArray[0];
        alert(pathArray[0] );
*/

        alert(document.URL);

    }


</script>

<h4>GET URL</h4>

<form id="myform" action="geturl.asp">
    Insert URL <input type="text" name="url"><br>

    <input type="submit" value="Submit">
</form>




<button type="button" onclick="geturl()">GET URL</button>
</body>
</html>