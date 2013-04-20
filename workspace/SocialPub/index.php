<?php
/**
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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
</head>

<body>
<?php include('html/navbar.php'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3" id="leftContent">LEFT
        </div>
        <div class="span5" id="mainContent">
            <!--Notifications - If no notifications this is disappeared -->
            <div id="notification" class="alert fade" style="position: fixed">
                <span id="notificationMessage">No notifications</span>
            </div>
            <!--            A space element. TODO future change this-->
            <div><br><br><br>
            </div>
            <?php
            include('html/mainContent.php');
            ?>
        </div>
        <div class="span3" id="rightContent">RIGHT</div>
        <button type="button" id="jimtest" onclick="jimFunction()">put url</button>


    </div>
</div>
<!--Javascripts-->
<script src="js/mainJavascript.js"></script>
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
</body>
</html>
