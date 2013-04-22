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

    <!--        TODO CHANGE WHERE THE ARTICLE TEMPORARILY LOADS-->
    <div>

        <div class="input-append span12">
                <label for="newArticleInput">Enter article: </label>
                <input class="span10" id="newArticleInput" type="text">
                <button class="btn" type="button" onclick="saveArticle()">Submit</button>
        </div>

        <div id="newArticle" class="thumbnail fade out">
            <img src/>

            <h5></h5>

            <p></p>
        </div>
    </div>
    <br><br><br>
    <!--     A row of 4 thumbnails-->
    <ul class="thumbnails">
        <li class="span4">
            <div class="thumbnail">
                <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

                <h5>Thumbnail label</h5>

                <p>Thumbnail caption...</p>
            </div>
        </li>
        <li class="span4">
            <div class="thumbnail">
                <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

                <h5>Thumbnail label</h5>

                <p>Thumbnail caption...</p>
            </div>
        </li>
        <li class="span4">
            <div class="thumbnail">
                <img src="http://www.sigmalive.com/application/cache/default/images/news/615x340/proedr.jpg" alt="">

                <h5>Thumbnail label</h5>

                <p>Thumbnail caption...</p>
            </div>
        </li>
    </ul>
    <ul class="thumbnails">
        <li class="span4">
            <div class="thumbnail">
                <img data-src="js/holder/holder.js/300x200" alt="">

                <h5>Thumbnail label</h5>

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