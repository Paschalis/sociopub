<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sonyvaio
 * Date: 8/4/2013
 * Time: 7:47 μμ
 * To change this template use File | Settings | File Templates.
 */
/* gets the data from a URL */
function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


$returned_content = get_data('http://davidwalsh.name');
?>