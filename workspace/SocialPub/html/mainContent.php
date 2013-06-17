<?php
/**
 *

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

 *
 * Created by JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/11/13
 * Time: 1:34 AM
 * To change this template use File | Settings | File Templates.
 */

//If user is logged in
if ($_SESSION["loggedin"] == 1) {
    ?>

    <!--        New Post Box-->
    <!--    <div id="newArticle" class="span12">-->
    <!--    Isotope-->
    <!--    <div class="row">-->


    <!--    </div>-->
    <!-- End of new post-->
    <div id="container">
    </div>
    <script>

        //Calculate box width
        calculateBoxWidth();

        var $container = $('#container');


        var newpost = '<div class="box newpost article cinema economy entertainment history health ' +
            'lifestyle music news science sports technology travel other liked readLater viewed " style="width: ' + window.boxWidth + '">'
            + getNewPostHtml()
            + '</div>';

        $container.append(newpost);


    </script>

    <!--  TODO RM if not needed:  <script src="../js/hirestext.js"></script>-->
    <script>

    $(document).ready(function () {


        window.container = $('#container');


        /*
         $.Isotope.prototype._getCenteredMasonryColumns = function () {
         this.width = this.element.width();

         var parentWidth = this.element.parent().width();

         // i.e. options.masonry && options.masonry.columnWidth
         var colW = this.options.masonry && this.options.masonry.columnWidth ||
         // or use the size of the first item
         this.$filteredAtoms.outerWidth(true) ||
         // if there's no items, use size of container
         parentWidth;

         var cols = Math.floor(parentWidth / colW);
         cols = Math.max(cols, 1);

         // i.e. this.masonry.cols = ....
         this.masonry.cols = cols;
         // i.e. this.masonry.columnWidth = ...
         this.masonry.columnWidth = colW;
         };

         $.Isotope.prototype._masonryReset = function () {
         // layout-specific props
         this.masonry = {};
         // FIXME shouldn't have to call this again
         this._getCenteredMasonryColumns();
         var i = this.masonry.cols;
         this.masonry.colYs = [];
         while (i--) {
         this.masonry.colYs.push(0);
         }
         };

         */
        $.Isotope.prototype._masonryResizeChanged = function () {

            //re-Calculate box width
            calculateBoxWidth();

            //Update width
            $(".box.article").width(window.boxWidth);
            $(".box img").width(window.boxWidth);

            $('#container').isotope('reLayout'); //Force reLayout


            /*
             var prevColCount = this.masonry.cols;
             // get updated colCount
             this._getCenteredMasonryColumns();
             return ( this.masonry.cols !== prevColCount );
             */
        };


        /*
         $.Isotope.prototype._masonryGetContainerSize = function () {
         var unusedCols = 0,
         i = this.masonry.cols;
         // count unused columns
         while (--i) {
         if (this.masonry.colYs[i] !== 0) {
         break;
         }
         unusedCols++;
         }

         return {
         height: Math.max.apply(Math, this.masonry.colYs),
         // fit container to columns that have been used;
         width: (this.masonry.cols - unusedCols) * this.masonry.columnWidth
         };

         };
         */

          //Load articles
          loadArticles();



    });



    </script>

<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}