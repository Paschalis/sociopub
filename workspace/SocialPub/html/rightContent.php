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
 * Date: 4/20/13
 * Time: 3:18 PM
 * To change this template use File | Settings | File Templates.
 */

if ($_SESSION['loggedin'] == 1) {
    ?>
    <h4>Filters</h4>
    <!--    <div class="container">-->
    <!-- Menu button when navbar is collapsed-->
    <!--        <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse.rightbar">-->
    <!--            <span class="icon-bar"></span>-->
    <!--            <span class="icon-bar"></span>-->
    <!--            <span class="icon-bar"></span>-->
    <!--        </a>-->
    <div id="filters">
        <div id="filter" class="rightbar">
            <ul class="filterclass option-set" data-option-key="filter">
                <li><a href="#" data-option-value="*" class="selected">No Filters</a></li>
                <li></li>
                <li><h4>Personal</h4></li>
                <li><a href="#" data-option-value=".liked">Like</a></li>
                <li><a href="#" data-option-value=".viewed">View</a></li>
                <li><a href="#" data-option-value=".readLater">Read Later</a></li>
                <li><h4>Categories</h4></li>
                <li><a href="#" data-option-value=".cinema">Cinema</a></li>
                <li><a href="#" data-option-value=".economy">Economy</a></li>
                <li><a href="#" data-option-value=".entertainment">Entertainment</a></li>
                <li><a href="#" data-option-value=".health">Health</a></li>
                <li><a href="#" data-option-value=".history">History</a></li>
                <li><a href="#" data-option-value=".lifestyle">Lifestyle</a></li>
                <li><a href="#" data-option-value=".music">Music</a></li>
                <li><a href="#" data-option-value=".news">News</a></li>
                <li><a href="#" data-option-value=".science">Science</a></li>
                <li><a href="#" data-option-value=".sports">Sports</a></li>
                <li><a href="#" data-option-value=".technology">Technology</a></li>
                <li><a href="#" data-option-value=".travel">Travel</a></li>
                <li><a href="#" data-option-value=".other">Other</a></li>
                <span id="sitefilters"></span>
            </ul>
        </div>
    </div>
    <!--    </div>-->
<?php
}
?>