<html>
<body>
<br>
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sonyvaio
 * Date: 8/4/2013
 * Time: 7:53 μμ
 * To change this template use File | Settings | File Templates.
 */$keywords = array();
$domain = array('https://www.google.com.cy/');
$doc = new DOMDocument;
$doc->preserveWhiteSpace = FALSE;
foreach ($domain as $key => $value) {
    @$doc->loadHTMLFile($value);
    $anchor_tags = $doc->getElementsByTagName('a');
foreach ($anchor_tags as $tag) {
    $keywords[] = strtolower($tag->nodeValue);
}
}
//testing something



$x=5; // global scope

function myTest($x)
{
    $y=6;
    $z=7;

    echo "Tha tipwsw to x+y+z: </br> Do3asi: ";
    echo $x+$y+$z; // local scope
    echo "</br> $x+$y+$z";
}

myTest($x);
?>
</body>
</html>