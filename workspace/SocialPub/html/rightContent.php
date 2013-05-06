<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/20/13
 * Time: 3:18 PM
 * To change this template use File | Settings | File Templates.
 */

if($_SESSION['loggedin']==1){
?>
<h4>Filters</h4>

<div class="container">
    <!-- Menu button when navbar is collapsed-->
    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse.rightbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="container">
        <div class="nav-collapse collapse navbar-responsive-collapse rightbar">
            <h5>Categories</h5>
            <ul class="nav">
                <li><a href="#" data-option-value="*" class="selected">Everything</a></li>
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
            </ul>


        <h5>Sites</h5>
        <div class="container">
            <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                    <li><a href="#" data-option-value="*" class="selected">gen w JQ</a></li>
                </ul>
            </div>
        </div>
        </div>
    </div>
</div>
<?php
}
    ?>