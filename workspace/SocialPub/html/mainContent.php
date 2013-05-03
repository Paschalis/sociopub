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



    <div class="row">
        <div id="container">
            <!--        New Post Box-->
            <div id="newArticle" class="span12">

                <div class="box newpost">
                    <div class="box-img">
                        <img/>
                    </div>
                    <div class="box-body">
                        <div class="input-append">
                            <label for="newArticleInput">Enter article: </label>
                            <input id="newArticleInput" type="text">
                            <button class="btn" type="button" onclick="previewArticle()">Preview</button>
                            <button id="postNewArticle" class="btn fade out" type="button"
                                    onclick="postArticle()">
                                Post
                            </button>
                        </div>
                        <h4></h4>

                        <p class="date" datetime="' + datum.added + '"></p>

                        <p></p>
                        <span class="articleID" style="display: none"></span>

                        <!-- Prev box data!-->
                        <div class="fade out" id="buttonsToolbar">
                            <img class="articleimg"/>
                            <h5 class="articletitle"></h5>

                            <p class="articledesc"></p>
                            <br>

                            <div class="badge badge-success">2</div>
                            <button class="label" id="acinema">Cinema</button>
                            <button class="label" id="aeconomy">Economy</button>
                            <button class="label" id="aentertainment">Entertainment</button>
                            <button class="label" id="ahealth">Health</button>
                            <button class="label" id="ahistory">History</button>
                            <button class="label" id="alifestyle">Lifestyle</button>
                            <button class="label" id="amusic">Music</button>
                            <button class="label" id="anews">News</button>
                            <button class="label" id="ascience">Science</button>
                            <button class="label" id="asports">Sports</button>
                            <button class="label" id="atechnology">Technology</button>
                            <button class="label" id="atravel">Travel</button>
                            <button class="label label-info" id="aother">Other</button>
                        </div>


                    </div>
                </div>
            </div>
            <!-- End of new post-->
        </div>
    </div>




    <script>

    $(document).ready(function () {

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

        $.Isotope.prototype._masonryResizeChanged = function () {
            var boxWidth;
            //Get width
            var curwidth = $('#newArticle').width();
            //Calculate new width
            //Smartphone size: full size!
            if (curwidth < 400) {
                //New hack
                //boxWidth = $('.box.newpost').width() + "px";
               boxWidth = ($(window).width() * 80) / 100 + "px";

            }
            //Phablet size, or portait big smartphones
            else if (curwidth >= 400 && curwidth < 650) {
                boxWidth = (curwidth / 2) - 40 + "px";

            }
            //Tablet size
            else if (curwidth >= 650 && curwidth < 900) {
                boxWidth = (curwidth / 3) - 30 + "px";

            }
            //Laptop size TODO ???????????
            else if (curwidth >= 900 && curwidth < 1300) {
                boxWidth = (curwidth / 4) - 30 + "px";

            }
            //Desktop size
            else if (curwidth >= 1300 && curwidth < 1600) {
                boxWidth = (curwidth / 5) - 20 + "px";

            }
            //Large size
            else if (curwidth >= 1600 && curwidth < 2000) {
                boxWidth = (curwidth / 6) - 30 + "px";

            }
            // Extra large screen size
            else {
                boxWidth = (curwidth / 8) - 30 + "px";

            }

            //Change the width
            $(".box.article").width(boxWidth);
                $(".box img").width(boxWidth);

            $('#container').isotope( 'reLayout'); //Force reLayout

            var prevColCount = this.masonry.cols;
            // get updated colCount
            this._getCenteredMasonryColumns();
            return ( this.masonry.cols !== prevColCount );
        };

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


        $(function () {


            var $container = $('#container');

            //Init width
            var curwidth = $container.width();

            var boxWidth = "";


            //Set width according to sizes
            // SMARTPHONE STATS:
            // NEXUS4: P 344, L 558


            //Smartphone size: full size!
            if (curwidth < 400) {
                //boxWidth =  $('.box.newpost').width() + "px";
                boxWidth = ($(window).width() * 80) / 100 + "px";

            }
            //Phablet size, or portait big smartphones
            else if (curwidth >= 400 && curwidth < 650) {
                boxWidth = (curwidth / 2) - 40 + "px";

            }
            //Tablet size
            else if (curwidth >= 650 && curwidth < 900) {
                boxWidth = (curwidth / 3) - 30 + "px";

            }
            //Laptop size TODO ???????????
            else if (curwidth >= 900 && curwidth < 1300) {
                boxWidth = (curwidth / 4) - 30 + "px";

            }
            //Desktop size
            else if (curwidth >= 1300 && curwidth < 1600) {
                boxWidth = (curwidth / 5) - 20 + "px";

            }
            //Large size
            else if (curwidth >= 1600 && curwidth < 2000) {
                boxWidth = (curwidth / 6) - 30 + "px";

            }
            // Extra large screen size
            else {
                boxWidth = (curwidth / 8) - 30 + "px";

            }


            $("#dsize").text("Size: " + curwidth); //TODO RM
            //When window is resized TODO RM
            $(window).resize(function () {
                $("#dsize").text("Size: " + curwidth); //TODO RM
            });


            $container.isotope({

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


            var $optionSets = $('#options .option-set'),
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
                    $container.isotope(options);
                }

                return false;
            });


            // Sites using Isotope markup
            var $sites = $('#sites'),
                $sitesTitle = $('<h2 class="loading"><img src="http://i.imgur.com/qkKy8.gif" />Loading sites using Isotope</h2>'),
                $sitesList = $('<ul class="clearfix"></ul>');

            $sites.append($sitesTitle).append($sitesList);


            var ajaxError = function () {
                $sitesTitle.removeClass('loading').addClass('error')
                    .text('Could not load sites using Isotope :(');
            };


            // dynamically load sites using Isotope from Zootool
            $.getJSON('./scripts/getUserArticles.php')
                .error(ajaxError)
                .success(function (data) {

                    // proceed only if we have data
                    if (!data || !data.length) {
                        ajaxError();
                        return;
                    }
                    var items = [],
                        item, datum;

                    for (var i = 0, len = data.length; i < len; i++) {
                        datum = data[i];


                        var filterClasses = "", filterTags = "";
                        ;

                        //Create classes for the filtering
                        for (var j = 0; j < datum.tags.length; j++) {
                            filterClasses += datum.tags[j] + " ";
                            filterTags += '<button class="category ' + datum.tags[j] + '">#' + datum.tags[j] + '</button>';
                        }


                        var likedClass = "";
                        var favedClass = "";


                        if (datum.like == 1) {
                            likedClass = " liked";
                        }
                        if (datum.favorite == 1) favedClass = " favorited";

                        var imgCode="";
                        if(datum.image!=""){
                            imgCode= '<img  class="articleimg" src="' + datum.image.replace('/l.', '/m.') + '" />';
                        }

                        //TODO ADD SITE NAME
                        item = '<div class="box article  ' + filterClasses + ' ">'
                            + '<div class="box-img">'
                            + imgCode
                            + '</div>'
                            + '<div class="box-body">'
                            + '<h4 class="articletitle">' + datum.title + '</h4>'
                            + '<p class="date" datetime="' + datum.added + '" >' + jQuery.timeago(new Date(datum.added * 1000)) + '</p>'
                            + '<p class="articledesc" >' + datum.description + '</p>'
                            + '<div class="readMore"><a href="' + datum.url + '" target="_blank">more...</a></div>'
                            + '<button class="badge likes' + likedClass + '">+' + datum.likes + '</button>'
                            + '<span class="badge shares" >Shares: ' + datum.shares + '</span>'
                            + '<span class="badge views" >Views: ' + datum.views + '</span>'
                            + '<span class="articleID" style="display: none">' + datum.uid + '</span>'
                            + '</div>'
                            + '<div class="categories" >' + filterTags + '</div>'
                            + '</div>';


                        items.push(item);
                    }

                    var $items = $(items.join(''));


                    //When images are loaded
                    $items.imagesLoaded(function () {
                        $container.append($items);


                        $items.each(function () {
                            var $this = $(this);

                            //Save box width
                            $this.width(boxWidth);
                            //Save box's image width
                            $this.find('img').width(boxWidth);
                        });

                        $container.isotope('insert', $items);
                    });

                });


        });
// TODO sadsd
$(".box .badge.likes").click(function(){$(this).parent().find('articleID').addClass("liked")});


    });


    </script>

<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}



/**  */