
<!--

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

-->
<div class="navbar navbar-inverse"> <!-- TODO removed navbar-fixed-top-->
    <div class="navbar-inner">
        <div class="container">
            <!-- Menu button when navbar is collapsed-->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse.topnavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" <?php echo 'href="' . _URL . '"'; ?>><?php echo _NAME; ?></a>


            <div class="nav-collapse collapse navbar-responsive-collapse topnavbar">

                <?php
                //If user is logged in, show search bar
                if ($_SESSION['loggedin'] == 1) {
                ?>
                <form id="searchForm" class="navbar-search pull-left" onsubmit="return false;">
                    <div class="input-prepend">
                        <button id="boxsearchClear" type="button" class="add-on">x</button>
                        <input id="boxsearch" type="text" class="search-query span5" placeholder="Search">
                        <input id="boxSubmitButton" type="submit" onclick="submitForm();" style="opacity:0;"/>
                    </div>
                </form>
                <?php } ?>
                <!--                <ul class="nav">-->
                <!--                    <li class="active"><a href="#">Home</a></li>-->
                <!--                </ul>-->
                <!--                    DropDown Comment out-->
                <!--                    <li class="dropdown">-->
                <!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>-->
                <!--                        <ul class="dropdown-menu">-->
                <!--                            <li><a href="#">Sports</a></li>-->
                <!--                            <li class="divider"></li>-->
                <!--                            <li class="nav-header">Nav header</li>-->
                <!--                        </ul>-->
                <!--                    </li>--

                <!-- Right in navbar-->
                <ul class="nav pull-right">

                    <li class="divider-vertical"></li>
                    <?php
                    //If user is logged in, show user panel
                    if ($_SESSION['loggedin'] == 1) {
                        ?>


                        <li class="dropdown" style="display: inline">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:logout()">Logout</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
</div>
