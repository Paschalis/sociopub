<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/8/13
 * Time: 6:08 PM
 * To change this template use File | Settings | File Templates.
 */


//$url = "http://edition.cnn.com/2013/04/08/politics/thatcher-reagan/index.html?hpt=hp_c1";



// Create DOM from URL or file
$html = file_get_html('http://edition.cnn.com/2013/04/08/politics/thatcher-reagan/index.html?hpt=hp_c1');

// Find all images
foreach($html->find('img') as $element)
    echo $element->src . '<br>';

// Find all links
foreach($html->find('a') as $element)
    echo $element->href . '<br>';

/*

$str = file_get_contents($url);

echo get_the_title();

$title = str_get_html('<title></title>');
echo $title;

*/
//echo $str;
/*
$tok = strtok($str, "/index.html");


while ($tok !== false) {
    echo "$tok<br />";
    $tok = strtok("/index.html");
}*/

//print_r(parse_url($url));
/*parse_str($str);
echo $first;  // value
echo $arr[0]; // foo bar
echo $arr[1]; // baz

parse_str($str, $output);
echo $output['first'];  // value
echo $output['arr'][0]; // foo bar
echo $output['arr'][1]; // baz

*/
?>
