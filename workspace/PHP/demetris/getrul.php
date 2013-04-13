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
    function getcategory(){

       /* var newURL = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
        var pathArray = window.location.pathname.split( '/' );
        var secondLevelLocation = pathArray[0];
        alert(pathArray[0] );
*/
var url=document.getElementsByName("url")[0].value;
    var home=url.split('/');
        //alert(url);
        //alert(home[1]);
var possible_category=home[3];
        alert("possible category is " + possible_category);

    }

function gettitle(){
    var url=document.getElementsByName("title")[0].value;

    // htmlcode=document.documentElement.outerHTML;
    //alert(htmlcode);

    var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false );
    xmlHttp.send( null );
    //return xmlHttp.responseText;
    var message="kokos";
    message=xmlHttp.responseText;
    alert(message);

}

</script>

<h4>GET URL</h4>


    Insert URL to get CATEGORY<input type="text" name="url"><br>

    <input type="submit" value="Submit" onclick="getcategory()">

Insert URL to get TITLE <input type="text" name="title"><br>

<br>
<button type="button"  onclick="gettitle()">GET TITLE</button>



<!--<button type="button" onclick="geturl()">GET URL</button>-->
</body>
</html>