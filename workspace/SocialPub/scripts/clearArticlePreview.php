<?php
/**

Copyright 2013, Internet Technologies course Team, at Computer Science Dept., University of Cyprus,

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




 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 5/6/13
 * Time: 3:32 AM
 * To change this template use File | Settings | File Templates.
 */

header('Content-type: text/html; charset=UTF-8');

// Assume that article is not valid
$_SESSION['valid_article']=0;


include("initializeSession.php");


// Clear article preview data
$_SESSION['article_valid']=0;
$_SESSION['article_title']="";
$_SESSION['article_image']="";
$_SESSION['article_siteName']="";
$_SESSION['article_url']="";

// Print results
$result = array(
    "code" => 1,
    "message" => "Article cleared",
);


echo json_encode($result);


die();


?>