<?php
/**
 * Created by JetBrains PhpStorm.
 * User: demetris
 * Date: 4/11/13
 * Time: 1:34 AM
 * To change this template use File | Settings | File Templates.
 */

//If user is logged in
if ($_SESSION["loggedin"] == 1) {
    ?>

    <div>
        <div class="input-append span12">
            <label for="newArticle">Enter new article: </label>
            <input class="span10" id="newArticle" type="text">
            <button class="btn" type="button" onclick="saveArticle()">Submit</button>
        </div>

        <!--        TODO CHANGE WHERE THE ARTICLE TEMPORARILY LOADS-->
        <div id="articleResult"></div>

    </div>
    <div class="row-fluid">
        <div class="span6">
            Fluid 6
            <div class="row-fluid">
                <div class="span6">Fluid 6</div>
                <div class="span6">Fluid 6</div>
            </div>
        </div>
    </div>
    <br><br>
    <br>
    <!--     A row of 4 thumbnails-->
    <ul class="thumbnails">
        <li class="span4">
            <div class="thumbnail">
                <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

                <h3>Thumbnail label</h3>

                <p>Thumbnail caption...</p>
            </div>
        </li>
        <li class="span4">
            <div class="thumbnail">
                <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

                <h3>Thumbnail label</h3>

                <p>Thumbnail caption...</p>
            </div>
        </li>
        <li class="span4">
            <div class="thumbnail">
                <img src="http://www.sigmalive.com/application/cache/default/images/news/615x340/proedr.jpg" alt="">

                <h3>Thumbnail label</h3>

                <p>Thumbnail caption...</p>
            </div>
        </li>
    </ul>
    <ul class="thumbnails">
        <li class="span4">
            <div class="thumbnail">
                <img data-src="js/holder/holder.js/300x200" alt="">

                <h3>Thumbnail label</h3>

                <p>Thumbnail caption...</p>
            </div>
        </li>
    </ul>


<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}



/**  */