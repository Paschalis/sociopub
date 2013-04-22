<?php


header('Content-type: text/html; charset=UTF-8');


include("initializeSession.php");
include_once('articles/simple_html_dom.php');


$URL = $_POST['url'];


if ($URL == "") {
    printMessage(0, "Articles URL cant be emtpy");
}


$html = file_get_html($URL);



// Get all meta data with property og:*

//$ret = $html->find('meta[property^=og:]');

$ret = $html->find('meta[property$=title], meta[property$=description], meta[property$=image], meta[property$=site_name]');


//[attribute$=value]


$title = "";
$description = "";
$image = "";
$siteName = "";

foreach ($ret as $element) {


    //Found the title
    if (strpos($element->property, 'title') !== false) {
        $title = $element->content;
    } //Found the description
    else if (strpos($element->property, 'description') !== false) {
        $description = $element->content;
    } //Found the image
    else if (strpos($element->property, 'image') !== false) {
        $image = $element->content;
    } //Found the image
    else if (strpos($element->property, 'site_name') !== false) {
        $siteName = $element->content;
    }

}





// Make another try to fetch results
if ($title == "" && $description == "") {

    //Try with meta tag, name property
    $ret = $html->find('meta[name$=title], meta[name$=description], meta[name$=image], meta[name$=site_name]');

    foreach ($ret as $element) {

        //Found the title
        if (strpos($element->name, 'title') !== false) {
            $title = $element->content;
        } //Found the description
        else if (strpos($element->name, 'description') !== false) {
            $description = $element->content;
        } //Found the image
        else if (strpos($element->name, 'image') !== false) {
            $image = $element->content;
        } //Found the image
        else if (strpos($element->name, 'site_name') !== false) {
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

    $pSiteName = str_replace("http://", "", $URL);
    $pSiteName = str_replace("www.", "", $pSiteName);
    $pSiteName = preg_replace('/\.[^.]+$/', '', $pSiteName);
    // $pSiteName = preg_replace('~\s+\S+$~', '', $pSiteName)

    $siteName = $pSiteName;
}


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


?>