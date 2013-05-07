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
            'lifestyle music news science sports technology travel other " style="width: ' + window.boxWidth + '">'
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


    function showBoxesAndFilters($items,siteFiltersDivs) {

        //Show items on webpage
        window.container.append($items);

        $items.each(function () {
            var $this = $(this);

            //Save box width
            $this.width(window.boxWidth);
            //Save box's image width
            $this.find('img').width(window.boxWidth);
        });

        window.container.isotope('insert', $items);


        //Show site filters on right content bar
        for (var i = 0; i < siteFiltersDivs.length; i++) {
            $('#filter ul').append(siteFiltersDivs[i]);

        }

        setFilterFunctionality();
    }


    function setFilterFunctionality() {
        var $optionSets = $('#filters .option-set'),
            $optionLinks = $optionSets.find('a');

        $optionLinks.click(function () {

            var $this = $(this);

            window.currentFilter=$this;


            var $optionSet = $this.parents('.option-set');
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');

            // make option object dynamically, i.e. { filter: '.my-filter-class' }
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            // parse 'false' as false boolean
            value = value === 'false' ? false : value;
            options[ key ] = value;
            if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
                // changes in layout modes need extra logic
                changeLayoutMode($this, options)
            } else {
                // otherwise, apply new options
                window.container.isotope(options);
            }

            return false;
        });

    }

    </script>

<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}