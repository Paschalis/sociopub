<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Paschalis
 * Date: 4/20/13
 * Time: 12:07 PM
 * To change this template use File | Settings | File Templates.
 */

$url = "http://stackoverflow.com/questions/3062050/how-to-download-a-webpage-in-php";
$dom = new DOMDocument();
$dom->load($url);