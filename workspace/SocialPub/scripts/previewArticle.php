<?php

/**

Copyright 2013, Internet Technologies course (code epl425) Team, at Computer Science Dept., University of Cyprus,

Members:
Dr. Marios Dikaiakos,
Dimitris Christofi, Paschalis Mpeis, Pampos Charalambous.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.



 */

header('Content-type: text/html; charset=UTF-8');

// Assume that article is not valid
$_SESSION['valid_article'] = 0;


include("initializeSession.php");
include_once('articles/simple_html_dom.php');


$URL = $_POST['url'];

// TODO DIMITRI REANBLE THIS FOR DEBUG DEBUG
//$URL = "http://www.news.gr/kosmos/evroph/article/63078/protomagia-me-epeisodia-synthhmata-kai-ekatommy.html"; //TODO RM
//$URL = 'http://www.livenews.com.cy/cgibin/hweb?-A=16408&-V=news';

//$URL = 'http://www.ant1iwo.com/oikonomia/2013/05/07/sthn-ep-oikonomikwn-toy-eyrwkoinonoylioy/';

//$URL = 'http://www.bbc.co.uk/news/world-us-canada-22438417';

if ($URL == "") {
    printMessage(0, "Articles URL cant be emtpy");
}




$html = file_get_html($URL);

//Find charset of webpage
preg_match('~charset=([-a-z0-9_]+)~i',$html,$charset);

$charset= str_replace("charset=", "", $charset);
$charset =  strtolower ($charset[0]);


$title = "";
$description = "";
$image = "";
$siteName = "";


$ret = $html->find('meta[property$=title], meta[property$=description], meta[property$=image], meta[property$=site_name]');


foreach ($ret as $element) {

    //Found the title
    if (strpos($element->property, 'title') !== false) {
        if ($title == "") {
            $title = $element->content;
        }
    } //Found the description
    else if (strpos($element->property, 'description') !== false) {
        if ($description == "")
            $description = $element->content;
    } //Found the image
    else if (strpos($element->property, 'image') !== false) {
        if ($image == "")
            $image = $element->content;
    } //Found the image
    else if (strpos($element->property, 'site_name') !== false) {
        if ($siteName == "")
            $siteName = $element->content;
    }

}


// WORKAROUND: convert charset 1253 to UTF8
$ret = $html->find('meta[http-equiv=content-type]');

foreach ($ret as $element) {

    if (strpos($element->content, 'windows-1253') !== false) {

        $title = iconv("windows-1253", "UTF-8", $title);
        $description = iconv("windows-1253", "UTF-8", $description);
    }
}
//// CHECK THIS UNIVERSAL PATTCH THAT DONT WORKS!
//if ($charset !="utf-8") {
//$title = utf8_encode($title);
//    $description = utf8_encode($description);
//
////    $title = iconv($charset, "utf-8", $title);
////    $description = iconv($charset, "utf-8", $description);
//}



// ########################### Remove bloat from Titles (like Title title - superwebpage.com)
// Ant1-iWO stupidness patch
//ant1wo hack (ant1iwo dont know how to do meta tags!!!!)
if ((strpos($URL, 'ant1iwo.com') !== false) ||(strpos($URL, 'news.gr') !== false) ) { //Ant iWO
    $title = explode(' - ', $title);
    $title = $title[0];
} else if (strpos($URL, 'politis-news.com') !== false) { // politis news
    $title = explode(' - ', $title);
    $title = $title[1];
} else if (strpos($URL, 'sigmalive.com') !== false) { // sigma live
    $title = explode('|', $title);
    $title = $title[0];
}
else if (strpos($URL, 'sigmalive.com') !== false) { // sigma live
    $title = explode('|', $title);
    $title = $title[0];
}
else if (strpos($URL, 'livenews.com.cy') !== false) { // livenews workaround
    $title = explode(' - ', $title);
    $title = $title[1];
}
else if (strpos($URL, '24h.com.cy') !== false) { // livenews workaround
    $title = str_replace("www.24h.com.cy -  ", "", $title);
}




// Make another try to fetch results
// Refetch title
if ($title == "") {

    //Try with meta tag, name property
    $ret = $html->find('meta[name$=title]');

    foreach ($ret as $element) {

        echo $element->content;

        //Found the title
        if (strpos($element->name, 'title') !== false) {
            $title = $element->content;
        }

    }

}
// Refetch description
if ($description == "") {

    //Try with meta tag, name property
    $ret = $html->find('meta[name$=description]');

    foreach ($ret as $element) {

        //Found the description
        if (strpos($element->name, 'description') !== false) {
            $description = $element->content;
        }

    }

}
// Refetch image
if ($image == "") {

    //Try with meta tag, name property
    $ret = $html->find('meta[name$=image]');

    foreach ($ret as $element) {

        //Found the image
        if (strpos($element->name, 'image') !== false) {
            $image = $element->content;
        } //Found the image

    }
}
// Refetch site name
if ($siteName == "") {

    //Try with meta tag, name property
    $ret = $html->find('meta[name$=site_name]');

    foreach ($ret as $element) {

        //Found the site name
        if (strpos($element->name, 'site_name') !== false) {
            $siteName = $element->content;
        }
    }
}


//Clear memory
$html->clear();
unset($html);

// Webpage not supported
if ($title == "" && $description == "") {
    printMessage(0, "Webpage not supported.");
}


//Find site name if dont exists
if ($siteName == "") {
    $siteName = $URL;
//    $pSiteName = str_replace("http://", "", $URL);
//    $result = preg_replace('/([a-zA-Z0-9]+)(\.)([a-zA-Z0-9]+)(\.?)([a-zA-Z0-9]*)(.*)/', '$1$2$3$4$5', $result);
//    $siteName = $pSiteName;
}

//// remove http
//if (strpos($siteName, 'http.') !== false) {
//    $siteName = str_replace("www.", "", $siteName);
//    $result = preg_replace('/([a-zA-Z0-9]+)(\.)([a-zA-Z0-9]+)(\.?)([a-zA-Z0-9]*)(.*)/', '$1$2$3$4$5', $result);
//}
//
//
//// Site name patch
//if (strpos($siteName, 'www.') !== false) {
//    $siteName = str_replace("www.", "", $siteName);
//    $result = preg_replace('/([a-zA-Z0-9]+)(\.)([a-zA-Z0-9]+)(\.?)([a-zA-Z0-9]*)(.*)/', '$1$2$3$4$5', $result);
//}
//


//Remove unneseccary parts of title
$title = preg_replace('/\(.*\)$/', '', $title);

//Remove unneseccary parts of url/site name
$siteName = preg_replace('/^https?:\/\//', '', $siteName);
$siteName = preg_replace('/^www\./', '', $siteName);
$siteName = preg_replace('/([a-zA-Z0-9]+)(\.)([a-zA-Z0-9]+)(\.?)([a-zA-Z0-9]*)(.*)/', '$1$2$3$4$5', $siteName);



include('Encoding.php');


//$title = Encoding::toUTF8($title);
//$description = Encoding::toUTF8($description);

$title = Encoding::toUTF8($title);
$description = Encoding::toUTF8($description);


//TODO Dimitri: an prokipsoun alla null, kame ta replace mesw toutou tou pinaka okay?
// se touti tin selida: http://www.degraeve.com/reference/specialcharacters.php

// CHECK THAT GR SITE AND TRY AGAIN!
////Modify data to be more compatible - DIMITRI CHECK, &#039; is the > ' < character (single quotes)
// Change single quote character
//$title = str_replace("'", "&#039;", $title);
//$description = str_replace("'", "&#039;", $description);
//
////// Change '-' character
//$title = str_replace("-", ".", $title); //&#45;
//$description = str_replace("-", ". ", $description);
//
//// :
//$title = str_replace(":", "&#58;", $title);
//$description = str_replace(":", "&#58;", $description);
//
//
//$title = str_replace("«", "&#171;", $title);
//$description = str_replace("«", "&#171;", $description);
//
//$title = str_replace("»", "&#187;", $title);
//$description = str_replace("»", "&#187;", $description);

//$title = str_replace("60 ", "", $title);// TODO RM

//$title = iconv("UTF-8", "UTF-8", $title);

//$title = mb_convert_encoding($title, "utf-8", "UTF-16BE");

//Save article results
// Article is valid
$_SESSION['article_valid'] = 1;
$_SESSION['article_title'] = $title;
$_SESSION['article_description'] = $description;
$image = doImageHack($image);
$_SESSION['article_image'] = $image;
$_SESSION['article_siteName'] = $siteName;
$_SESSION['article_url'] = $URL;

// Print results
$result = array(
    "code" => 1,
    "title" => $title,
    "description" => $description,
    "image" => $image,
    "siteName" => $siteName
);


echo json_encode($result);


die();


/*
 * Tries to fetch bigger image, if the deaulf is small!
 * */
function doImageHack($imgUrl)
{

    // XS stands for extra small
    if (strpos($imgUrl, "XS") !== false) {


        $result = str_replace("XS", "M", $imgUrl);

        //If Medium image exists, return it
        if (checkRemoteFile($result))
            return $result;


    }


    //Try with small image
    if (strpos($imgUrl, "S") !== false) {
        $result = str_replace("S", "M", $imgUrl);

        //If Medium image exists, return it
        if (checkRemoteFile($result))
            return $result;
    }

    //nothing happened. return image as was
    return $imgUrl;
}


?>