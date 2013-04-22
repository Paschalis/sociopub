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
    <div id="newArticle">
        <div class="input-append span12">
            <label for="newArticleInput">Enter article: </label>
            <input class="span10" id="newArticleInput" type="text">
            <button class="btn" type="button" onclick="saveArticle()">Preview</button>
            <button id="postNewArticle" class="btn success  fade out" type="button" onclick="postArticle()">Post</button>
            <div class="badge-success">77</div>
            <div class="btn-toolbar">
            <div class="btn-group">
                <button class="btn-info">Left</button>
                <button class="btn-success">Middle</button>
                <button class="btn-warning">Right</button>
            </div>
            <div class="btn-group">
                <button class="btn-danger">POUKATW</button>
            </div>
                <div class="btn-group">
                    <button class="btn-inverse">ALLO</button>
                </div>
        </div>

        </div>
        <div class="thumbnail fade out">
            <img class="articleimg"/>
            <h5 class="articletitle"></h5>
            <p class="articledesc"></p>

        </div>
        <!--2nd time-->
        <div class="btn-toolbar fade out" id="buttonsToolbar">
            <div class="btn-group">
                <button class="btn-info">Left</button>
                <button class="btn-success">Middle</button>
                <button class="btn-warning">Right</button>
            </div>
            <div class="btn-group">
                <button class="btn-danger">POUKATW</button>
            </div>
            <div class="btn-group">
                <button class="btn-inverse">ALLO</button>
            </div>
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