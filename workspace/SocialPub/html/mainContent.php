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
    <div id="container">
    </div>

    <script>

    $(document).ready(function () {

        debugger;

        //Calculate box width
        calculateBoxWidth();

        window.container = $('#container');


        var newpost = '<div class="box newpost article cinema economy entertainment history health ' +
            'lifestyle music news science sports technology travel other " style="width: ' + window.boxWidth + '">'
            + getNewPostHtml()
            + '</div>';

        window.container.append(newpost);


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


        var ajaxError = function () {
            makeShowNotification(0, "Failed to load articles", DELAY_MEDIUM);
        };

        $(function () {

            debugger;

            var curwidth = window.container.width();

            $("#dsize").text("Size: " + curwidth); //TODO RM
            //When window is resized TODO RM
            $(window).resize(function () {
                $("#dsize").text("Size: " + curwidth); //TODO RM
            });


            window.container.isotope({
                sortBy: 'date',
                sortAscending: false,
                getSortData: {
                    date: function ($elem) {
                        return new Date($elem.find('.date').attr('datetime') * 1000);

                    },
                    alphabetical: function ($elem) {
                        var name = $elem.find('.name'),
                            itemText = name.length ? name : $elem;
                        return itemText.text();
                    }
                }
            });

// TODO CHECK AND FULL REMOVE
//            // Sites using Isotope markup
//            var $sites = $('#sites'),
//                $sitesTitle = $('<h2 class="loading"><img src="http://i.imgur.com/qkKy8.gif" />Loading sites using Isotope</h2>'),
//                $sitesList = $('<ul class="clearfix"></ul>');
//
//            $sites.append($sitesTitle).append($sitesList);
//
//



            // dynamically load sites using Isotope from Zootool
            $.getJSON('./scripts/getUserArticles.php')
                .error(ajaxError)
                .success(function (data) {

                    debugger;

                    // proceed only if we have data
                    if (!data || !data.length) {
                        ajaxError();

                        return;
                    }
                    var items = [], siteFiltersDivs = [], siteFilters = [],
                        item, article;

                    for (var i = 0, len = data.length; i < len; i++) {
                        article = data[i];


                        var filterClasses = "", filterTags = "";


                        //Create classes for the filtering
                        for (var j = 0; j < article.tags.length; j++) {
                            filterClasses += article.tags[j] + " ";
                            filterTags += '<button class="category ' + article.tags[j] + '">#' + article.tags[j] + '</button>';
                        }

                        var newSiteFilter = article.site.replace(/[ .//]/ig, '').toLowerCase();

                        filterClasses += newSiteFilter;


                        var likedClass = "";
                        var favedClass = "";


                        if (article.like == 1) {
                            likedClass = " liked";
                        }
                        if (article.favorite == 1) favedClass = " favorited";

                        var imgCode = "";
                        if (article.image != "") {
                            imgCode = '<img  class="articleimg" src="' + article.image.replace('/l.', '/m.') + '" />';
                        }

                        //TODO ADD SITE NAME
                        item = '<div class="box article  ' + filterClasses + ' ">'
                            + '<div class="box-img">'
                            + imgCode
                            + '</div>'
                            + '<div class="box-body">'
                            + '<h4 class="articletitle">' + article.title + '</h4>'
                            + '<button class="btn closebox" onclick="deleteArticle(($(event.target).parent()).parent())">x</button>'
                            + '<p class="date" datetime="' + article.added + '" >' + jQuery.timeago(new Date(article.added * 1000)) + '</p>'
                            + '<p class="articledesc" >' + article.description + '</p>'
                            + '<div class="readMore" ><a href="' + article.url + '" target="_blank">continue @' + article.site + '</a></div>'
                            + '<button class="badge likes' + likedClass + '">+' + article.likes + '</button>'
                            + '<span class="badge shares" >Shares: ' + article.shares + '</span>'
                            + '<span class="badge views" >Views: ' + article.views + '</span>'
                            + '<span class="articleID" style="display: none">' + article.uid + '</span>'
                            + '</div>'
                            + '<div class="categories" >' + filterTags + '</div>'
                            + '</div>';


                        items.push(item);


                        // Find out if sitename is unique
                        var isUnique = 1;


                        for (var sf = 0; sf < siteFilters.length; sf++) {

                            if (siteFilters[sf] == newSiteFilter) {
                                isUnique = 0;
                                break;
                            }
                        }

                        //if sitename is unique, add it
                        if (isUnique == 1) {
                            siteFilters.push(newSiteFilter);
                            siteFiltersDivs.push('<li><a href="#" data-option-value=".' + newSiteFilter + '">' + article.site + '</a></li>');
                        }

                    }

                    var $items = $(items.join(''));


                    //When images are loaded
                    $items.imagesLoaded(function () {
                        window.container.append($items);

                        debugger;


                        $items.each(function () {
                            var $this = $(this);

                            //Save box width
                            $this.width(window.boxWidth);

                            if (window.boxWidth.indexOf("px") !== -1) {

                                //Save box's image width
                                $this.find('img').width(window.boxWidth);
                            }
                            else {
                                $this.find('img').width("100%");
                            }
                        });


                        window.container.isotope('insert', $items);


                        //Show site filters on right content bar
                        for (var i = 0; i < siteFiltersDivs.length; i++) {
                            $('#filter ul').append(siteFiltersDivs[i]);

                        }
                        debugger;


                        setFilterFunctionality();
                    });

                });


        });


    });

    function setFilterFunctionality() {
        var $optionSets = $('#filters .option-set'),
            $optionLinks = $optionSets.find('a');

        $optionLinks.click(function () {
            var $this = $(this);
            // don't proceed if already selected
            if ($this.hasClass('selected')) {
                return false;
            }
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
