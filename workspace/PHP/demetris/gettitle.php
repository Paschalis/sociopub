<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dimitros
 * Date: 12/4/2013
 * Time: 9:48 μμ
 * To change this template use File | Settings | File Templates.
 */
?>

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


        var xmlHttp = null;

        function GetCustomerInfo()
        {
            var CustomerNumber = document.getElementById( "TextBoxCustomerNumber" ).value;
            var Url = "GetCustomerInfoAsJson.aspx?number=" + CustomerNumber;

            xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = ProcessRequest;
            xmlHttp.open( "GET", Url, true );
            xmlHttp.send( null );
        }

        function ProcessRequest()
        {
            if ( xmlHttp.readyState == 4 && xmlHttp.status == 200 )
            {
                if ( xmlHttp.responseText == "Not found" )
                {
                    document.getElementById( "TextBoxCustomerName"    ).value = "Not found";
                    document.getElementById( "TextBoxCustomerAddress" ).value = "";
                }
                else
                {
                    var info = eval ( "(" + xmlHttp.responseText + ")" );

                    // No parsing necessary with JSON!
                    document.getElementById( "TextBoxCustomerName"    ).value = info.jsonData[ 0 ].cmname;
                    document.getElementById( "TextBoxCustomerAddress" ).value = info.jsonData[ 0 ].cmaddr1;
                }
            }
        }


</script>

<h4>GET TITLE</h4>

Insert URL to get TITLE <input type="text" name="title"><br>

<br>
<button type="button"  onclick="gettitle()">GET TITLE</button>



<!--<button type="button" onclick="geturl()">GET URL</button>-->
</body>
</html>