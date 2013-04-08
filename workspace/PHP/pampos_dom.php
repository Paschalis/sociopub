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
?>