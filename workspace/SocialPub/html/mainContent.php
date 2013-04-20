<?php
/**
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/11/13
 * Time: 1:34 AM
 * To change this template use File | Settings | File Templates.
 */

//If user is logged in
if ($_SESSION["loggedin"] == 1) {
    ?>
    <div>
        <label for="newActicle">Enter new article: </label>
        <input type="text" id="newActicle">
        <button id="newActicleButton" onclick="saveArticle()">Submit</button>
        <div id="articleResult"></div>

        <div class="row-fluid">
            <div class="span6">
                Fluid 6
                <div class="row-fluid">
                    <div class="span6">Fluid 6</div>
                    <div class="span6">Fluid 6</div>
                </div>
            </div>
        </div>

    </div>


<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}



/**  */