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

    <!--        New Post row-->
    <div class="row">

        <div class="span12">
            <div id="newArticle" class="span12">
                <div class="thumbnail">
                    <div class="input-append">
                        <label for="newArticleInput">Enter article: </label>
                        <input class="span12" id="newArticleInput" name="n" type="text">
                        <button class="btn" type="button" onclick="saveArticle()">Preview</button>
                        <button id="postNewArticle" class="btn success fade out" type="button" onclick="postArticle()">
                            Post
                        </button>
                    </div>
                    <div class="fade out" id="buttonsToolbar">
                        <img class="articleimg"/>
                        <h5 class="articletitle"></h5>
                        <p class="articledesc"></p>

                        <br>
                        <div class="badge badge-success">2</div>
                        <button class="label">Cinema</button>
                        <button class="label">Economy</button>
                        <button class="label">Entertainment</button>
                        <button class="label">Health</button>
                        <button class="label">History</button>
                        <button class="label">Lifestyle</button>
                        <button class="label">Music</button>
                        <button class="label">News</button>
                        <button class="label">Science</button>
                        <button class="label">Sports</button>
                        <button class="label">Technology</button>
                        <button class="label">Travel</button>
                        <button class="label">Other</button>
                    </div>
                </div>

            </div>
            <!-- End of new post-->
        </div>

    </div>
    <!--        Rest of the posts -->
    <div class="row">

        <div class="span12">
            <!--     A row of 4 thumbnails-->
            <ul class="thumbnails">
                <li class="span4">
                    <div class="thumbnail">
                        <img src="http://www.sigmalive.com/application/cache/default/images/news/615x340/proedr.jpg"
                             alt="">

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
                        <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

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
        </div>
    </div>








<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}



/**  */