<?php
/**

Copyright 2013 Paschalis Mpeis

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
 * Date: 4/10/13
 * Time: 10:00 PM
 * To change this template use File | Settings | File Templates.
 */

include("scripts/initializeSession.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SocialPub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php  include('scripts/mobileHeader.php'); ?>

    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="js/mainJavascript.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-41093411-1', 'sociopub.paschalis.mp');
        ga('send', 'pageview');

    </script>

    <!-- CSS -->
    <link href="css/isotope.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="css/ourstyle.css" rel="stylesheet">

    <!-- Obsolete web browsers -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<?php include('html/navbar.php'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span1 visible-desktop" id="leftContent">
            <?php include('html/leftContent.php'); ?>
        </div>
        <div class="span10" id="mainContent">
            <!--Notifications - If no notifications this is disappeared -->
            <div class="notifications" >
                <div  class="alert fade" id="notification">
                <span id="notificationMessage">No notifications</span>
                </div>
            </div>
            <?php
            include('html/mainContent.php');
            ?>
        </div>
        <div class="span1" id="rightContent">
            <?php include('html/rightContent.php'); ?>
        </div>
    </div>
</div>
<!--Javascripts-->
<script src="js/bootstrap-transition.js"></script>
<script src="js/bootstrap-alert.js"></script>
<script src="js/bootstrap-modal.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-scrollspy.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/bootstrap-tooltip.js"></script>
<script src="js/bootstrap-popover.js"></script>
<script src="js/bootstrap-button.js"></script>
<script src="js/bootstrap-collapse.js"></script>
<script src="js/bootstrap-carousel.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<script src="isotope/jquery.isotope.min.js"></script>
<script src="js/jquery.timeago.js"></script>
</body>
</html>
