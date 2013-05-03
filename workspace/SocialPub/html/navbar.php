<?php

?>

<script src="js/jquery-1.7.1.min.js"></script>
<script src="jquery.isotope.min.js"></script>

<div class="navbar navbar-inverse"> <!-- TODO removed navbar-fixed-top-->
    <div class="navbar-inner">
        <div class="container">
            <!-- Menu button when navbar is collapsed-->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" <?php echo 'href="'._URL.'"'; ?>><?php echo _NAME; ?></a>

            <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>






                    <li><a href="#">Link 2</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu" >
                            <li ><a href="#"  >Sports</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>


                <!-- Right navigation-->
                <ul class="nav pull-center">
                    <form class="navbar-search pull-left" action="">
                        <input type="text" class="search-query span2" placeholder="Search">
                    </form>
                </ul>

                <!-- Right in navbar-->
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown"  <?php
                        //If user is logged in, make visible account tab
                        if($_SESSION['loggedin']==1){
                            echo 'style="display: inline"';
                        }
                    else{
                        echo 'style="display: none"';
                    }
                        ?> >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:logout()">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
<!--Filter for categories-->
    <li >

        <div id="options" class="clearfix" class="option-combo">

            <ul  id="filter" class="option-set clearfix" data-option-key="filter">
                <li><a href="#" data-option-value="*" class="selected">Everything</a></li>
                <li><a href="#" data-option-value=".cinema">Cinema</a></li>
                <li><a href="#" data-option-value=".economy">Economy</a></li>
                <li><a href="#" data-option-value=".entertainment">Entertainment</a></li>
                <li><a href="#" data-option-value=".health">Health</a></li>
                <li><a href="#" data-option-value=".history">History</a></li>
                <li><a href="#" data-option-value=".lifestyle">Lifestyle</a></li>
                <li><a href="#" data-option-value=".music">Music</a></li>
                <li><a href="#" data-option-value=".news">News</a></li>
                <li><a href="#" data-option-value=".science">Science</a></li>
                <li><a href="#" data-option-value=".sports">Sports</a></li>
                <li  ><a href="#" data-option-value=".technology">Technology</a></li>
                <li><a href="#" data-option-value=".travel">Travel</a></li>
                <li><a href="#" data-option-value=".other">Other</a></li>

            </ul>

        </div>
    </li>

    <!--Filter for structure-under construction--
    <li >

        <div id="options" class="clearfix" class="option-combo">

            <ul  id="layout" class="option-set clearfix" data-option-key="layoutMode">
                <li><a href="#masonry" data-option-value="masonry" class="selected">masonry</a></li>
                <li><a href="#fitRows" data-option-value="fitRows">fitRows</a></li>
                <li><a href="#straightDown" data-option-value="straightDown">straightDown</a></li>

            </ul>
        </div>
    </li>


</div>



<script>
    $(function () {

        var $container = $('#container');

        $container.isotope({
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

            // make option object dynamically, i.e. { filter: '.my-
            filter-class' }
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            // parse 'false' as false boolean
            value = value === 'false' ? false : value;
            options[ key ] = value;
            if (key === 'layoutMode' && typeof changeLayoutMode
                === 'function') {
                // changes in layout modes need extra logic
                changeLayoutMode($this, options)
            } else {
                // otherwise, apply new options
                $container.isotope(options);
            }

            return false;
        });


        // Sites using Isotope markup
        /*   var $sites = $('#sites'),
         $sitesTitle = $('<h2 class="loading"><img
         src="http://i.imgur.com/qkKy8.gif" />Loading sites using
         Isotope</h2>'),
         $sitesList = $('<ul class="clearfix"></ul>');

         $sites.append($sitesTitle).append($sitesList);

         $sitesList.isotope({
         layoutMode: 'cellsByRow',
         cellsByRow: {
         columnWidth: 290,
         rowHeight: 400
         }
         });
         */
        /*  var ajaxError = function () {
         $sitesTitle.removeClass('loading').addClass('error')
         .text('Could not load sites using Isotope :(');
         };


         $.getJSON('../scripts/getUserArticles.php')
         .error(ajaxError)
         .success(function (data) {
         */

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
                $('<div class="box span4 ' + filterClasses + ' " >'
                    +
                    '<img src="' + datai.image.replace('/l.', '/m.') +
                    '" />'
                    + '<div style="display: none">' + datai.uid +
                    '</div>'
                    + '<h3>' + datai.title + '</h3>'
                    + '<h4>' + datai.description + '</h4>'
                    + '<p>' + datai.url + '</p>'
                    + '<p class="added">' + datai.added + '</p>'
                    + '<span class="views" >' + datai.views +
                    '</span>'
                    + '<span class="likes">' + datai.likes + '</span>'
                    + '</div>');

            //Save box in boxes
            boxes[i] = box;


        }

        debugger;


        $(boxes).imagesLoaded(function () {
            //test
            $(boxes).each(function () {
                debugger;

                //TODO AVOE ADD DATA-NUMBER
                ////                    $(this).attr('data-number', ~~(
                Math.random() * 100 + 15 ));

                //                   $container.isotope('insert', this);
            });
        });



    });


    });
</script>