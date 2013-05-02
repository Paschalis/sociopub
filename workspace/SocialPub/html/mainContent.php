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
                        <button class="btn" type="button" onclick="previewArticle()">Preview</button>
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
            <!-- End of new post-->
        </div>

    </div>
    <div class="row">
        <div id="container">
        </div>
    </div>
    <script src="isotope/jquery.isotope.min.js"></script>
    <script src="js/jquery.timeago.js"></script>


    <script>


        $(function () {




            var $container = $('#container');

            $container.isotope({
                containerClass: 'isotope',
                animationOptions: 'best-available',
//                animationOptions: {
//                    duration: 750,
//                    easing: 'linear',
//                    queue: false
//                },
                masonry: {
                    columnWidth: 120
                },
                sortBy: 'number',
                getSortData: {
                    number: function ($elem) {
                        var number = $elem.hasClass('element') ?
                            $elem.find('.number').text() :
                            $elem.attr('data-number');
                        return parseInt(number, 10);
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

            $sitesList.isotope({
                layoutMode: 'cellsByRow',
                cellsByRow: {
                    columnWidth: 290,
                    rowHeight: 400
                }
            });

            var ajaxError = function () {
                $sitesTitle.removeClass('loading').addClass('error')
                    .text('Could not load sites using Isotope :(');
            };


            $.getJSON('../scripts/getUserArticles.php')
                .error(ajaxError)
                .success(function (data) {


                    var boxes = [],
                        box, datai;


                    // Save fetched elements
                    for (var i = 0; i < data.length; i++) {

                        datai = data[i];


                        var filterClasses = "";

                        //Create classes for the filtering
                        for (var j = 0; j < datai.tags.length; j++) {
                            filterClasses += datai.tags[j] + " ";
                        }

                        box =
                            $('<div class="box  '  + filterClasses + ' " >' +
                                '<img src="' + datai.image.replace('/l.', '/m.') + '" />'
                                + '<div style="display: none">' + datai.uid + '</div>'
                                + '<h4>' + datai.title + '</h4>'
                                + '<p class="timeago">' + datai.added + '</p>'
                                + '<p>' + datai.description + '</p>'
                                + '<a href="'+datai.url +'" target="_blank">more...</a>'

                                + '<span class="badge badge-info likes">+' + datai.likes + '</span>'
                                + '<span class="badge shares" >Shares: ' + datai.shares + '</span>'
                                + '<span class="badge views" >Views: ' + datai.views + '</span>'
                                + '<abbr class="timeago" title="'+ datai.added +'"></abbr>'
                                + '</div>');

                        //Save box in boxes
                        boxes[i] = box;


                    }


                    $(boxes).imagesLoaded(function () {
                        $(boxes).each(function () {

                            //TODO AVOE ADD DATA-NUMBER
                            ////                    $(this).attr('data-number', ~~( Math.random() * 100 + 15 ));

                            $container.isotope('insert', this);
                        });
                    });


                });


        });
    </script>

    <!--       Example box-->
    <!--    <div class="span4 box">-->
    <!--        <img data-src="js/holder/holder.js/300x200" alt="">-->
    <!---->
    <!--        <h5>Thumbnail label</h5>-->
    <!--        <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">-->
    <!---->
    <!--        <p>Thumbnail caption...</p>-->
    <!--    </div>-->

<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}



/**  */