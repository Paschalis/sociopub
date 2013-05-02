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




    <script>
        $(document).ready(function () {


            $(function () {

                var $container = $('#container');

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

//            $sitesList.isotope({
//                layoutMode: 'cellsByRow',
//                cellsByRow: {
//                    columnWidth: 270,
//                    rowHeight: 400
//                }
//            });

                var ajaxError = function () {
                    $sitesTitle.removeClass('loading').addClass('error')
                        .text('Could not load sites using Isotope :(');
                };


                // dynamically load sites using Isotope from Zootool
                $.getJSON('../scripts/getUserArticles.php')
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


                            var filterClasses = "";

                            //Create classes for the filtering
                            for (var j = 0; j < datum.tags.length; j++) {
                                filterClasses += datum.tags[j] + " ";
                            }


                            item = '<div class="box  ' + filterClasses + ' " >'
                                + '<div class="box-img">'
                                + '<img src="' + datum.image.replace('/l.', '/m.') + '" />'
                                + '</div>'
                                + '<div class="box-body">'
                                + '<h4>' + datum.title + '</h4>'
                                + '<div class="articleID" style="display: none">' + datum.uid + '</div>'

                                + '<time class="date timeago" datetime="' + datum.added + '" >' + jQuery.timeago(new Date(datum.added * 1000)) + '</time>'
                                + '<p>' + datum.description + '</p>'


                                + '<div class="readMore"><a href="' + datum.url + '" target="_blank">more...</a></div>'
                            + '<span class="badge badge-info likes">+' + datum.likes + '</span>'
                                + '<span class="badge shares" >Shares: ' + datum.shares + '</span>'
                                + '<span class="badge views" >Views: ' + datum.views + '</span>'

                                + '</div>'
                                + '</div>';


                            items.push(item);
                        }

                        var $items = $(items.join(''));


                        $items.imagesLoaded(function () {
                            $container.append($items);
//                        $items.each(function(){
//                            var $this = $(this),
//                                itemHeight = Math.ceil( $this.height() / 120 ) * 120 - 10;
//                            $this.height( itemHeight );
//                        });
                            $container.isotope('insert', $items);
                        });

                    });


            });
        });


    </script>

<?php
} // if user is not logged in
else {
    include("loginScreen.php");

}



/**  */