<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8"/>
    <title>Isotope</title>

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <link rel="stylesheet" href="css/style.css"/>

    <!-- scripts at bottom of page -->

</head>
<body class="homepage ">

<!--<nav id="site-nav">-->
<!--    <h1><a href="index.html">Isotope</a></h1>-->
<!---->
<!--    <h2>Docs</h2>-->
<!---->
<!--    <ul>-->
<!---->
<!---->
<!--        <li><a href="./docs/introduction.html">Introduction</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/options.html">Options</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/methods.html">Methods</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/layout-modes.html">Layout modes</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/filtering.html">Filtering</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/sorting.html">Sorting</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/animating.html">Animating</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/adding-items.html">Adding items</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/extending-isotope.html">Extending Isotope</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/hash-history-jquery-bbq.html">Hash history with jQuery BBQ</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/help.html">Help</a>-->
<!---->
<!---->
<!--        <li><a href="./docs/license.html">License</a>-->
<!---->
<!---->
<!--    </ul>-->
<!---->
<!--    <h2>Demos</h2>-->
<!---->
<!--    <ul>-->
<!---->
<!---->
<!--        <li><a href="./demos/basic.html">Basic</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/elements-complete.html">Elements Complete</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/elements-partial.html">Elements Partial</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/layout-modes.html">Layout modes</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/filtering.html">Filtering</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/sorting.html">Sorting</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/relayout.html">reLayout</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/adding-items.html">Adding items</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/infinite-scroll.html">Infinite Scroll</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/images.html">Images</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/combination-filters.html">Combination filters</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/hash-history.html">Hash history</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/fluid-responsive.html">Fluid / responsive</a>-->
<!---->
<!---->
<!--        <li><a href="./demos/removing.html">Removing</a>-->
<!---->
<!---->
<!--    </ul>-->
<!---->
<!--    <h2>Custom layout modes</h2>-->
<!---->
<!--    <ul>-->
<!---->
<!---->
<!--        <li><a href="./custom-layout-modes/centered-masonry.html">Centered Masonry</a>-->
<!---->
<!---->
<!--        <li><a href="./custom-layout-modes/category-rows.html">Category rows</a>-->
<!---->
<!---->
<!--        <li><a href="./custom-layout-modes/masonry-corner-stamp.html">Masonry corner stamp</a>-->
<!---->
<!---->
<!--        <li><a href="./custom-layout-modes/masonry-gutters.html">Masonry gutters</a>-->
<!---->
<!---->
<!--        <li><a href="./custom-layout-modes/spine-align.html">Spine align</a>-->
<!---->
<!---->
<!--        <li><a href="./custom-layout-modes/big-graph.html">BIG Graph</a>-->
<!---->
<!---->
<!--        <li><a href="./custom-layout-modes/masonry-column-shift.html">Masonry Column Shift</a>-->
<!---->
<!---->
<!--    </ul>-->
<!---->
<!--    <h2><a href="tests/index.html">Tests</a></h2>-->
<!---->
<!--</nav>-->
<!--<!-- #site-nav -->

<section id="content">

<section id="options" class="clearfix">
    <div class="option-combo">
        <h2>Filter:</h2>
        <ul id="filter" class="option-set clearfix" data-option-key="filter">
            <li><a href="#show-all" data-option-value="*" class="selected">show all</a></li>
            <li><a href="#elements" data-option-value=".element:not(.feature)">elements</a></li>
            <li><a href="#features" data-option-value=".feature">features</a></li>
            <li><a href="#examples" data-option-value=".example">examples</a></li>
        </ul>
    </div>
    <div class="option-combo">
        <h2>Sort:</h2>
        <ul id="sort" class="option-set clearfix" data-option-key="sortBy">
            <li><a href="#mixed" data-option-value="number" class="selected">mixed</a></li>
            <li><a href="#original" data-option-value="original-order">original</a></li>
            <li><a href="#alphabetical" data-option-value="alphabetical">alphabetical</a></li>
        </ul>
    </div>
    <div class="option-combo">
        <h2>Layout: </h2>
        <ul id="layouts" class="option-set clearfix" data-option-key="layoutMode">
            <li><a href="#masonry" data-option-value="masonry" class="selected">masonry</a></li>
            <li><a href="#fitRows" data-option-value="fitRows">fitRows</a></li>
            <li><a href="#straightDown" data-option-value="straightDown">straightDown</a></li>
        </ul>
    </div>
</section>

<div id="container" class="super-list variable-sizes clearfix">


    <div class="element alkaline-earth metal   " data-symbol="Mg" data-category="alkaline-earth">
        <p class="number">12</p>

        <h3 class="symbol">Mg</h3>

        <h2 class="name">Magnesium</h2>

        <p class="weight">24.305</p>
    </div>


    <div class="element actinoid metal inner-transition   " data-symbol="U" data-category="actinoid">
        <p class="number">92</p>

        <h3 class="symbol">U</h3>

        <h2 class="name">Uranium</h2>

        <p class="weight">238.02891</p>
    </div>


    <div class="element lanthanoid metal inner-transition   " data-symbol="Gd" data-category="lanthanoid">
        <p class="number">64</p>

        <h3 class="symbol">Gd</h3>

        <h2 class="name">Gadolinium</h2>

        <p class="weight">157.25</p>
    </div>


    <div class="element transition metal   " data-symbol="Y" data-category="transition">
        <p class="number">39</p>

        <h3 class="symbol">Y</h3>

        <h2 class="name">Yttrium</h2>

        <p class="weight">88.90585</p>
    </div>


    <div class="element metalloid   " data-symbol="B" data-category="metalloid">
        <p class="number">5</p>

        <h3 class="symbol">B</h3>

        <h2 class="name">Boron</h2>

        <p class="weight">10.811</p>
    </div>


    <div class="element transition metal   " data-symbol="Fe" data-category="transition">
        <p class="number">26</p>

        <h3 class="symbol">Fe</h3>

        <h2 class="name">Iron</h2>

        <p class="weight">55.845</p>
    </div>


    <div class="link" data-number="5"><a href="jquery.isotope.min.js">Down&#8203;load jquery&#8203;.isotope&#8203;.min.js</a>
    </div>
    <div class="link" data-number="13"><a href="http://meta.metafizzy.co/files/isotope-site.zip">Down&#8203;load this
            project</a></div>
    <div class="link away" data-number="35"><a href="http://github.com/desandro/isotope">Isotope on GitHub</a></div>
</div>

<div id="sites"></div>


<script src="js/jquery-1.7.1.min.js"></script>
<script src="jquery.isotope.min.js"></script>
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

            // make option object dynamically, i.e. { filter: '.my-filter-class' }
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option            value = value === 'false' ? false : value;
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

        // dynamically load sites using Isotope from Zootool
        $.getJSON('http://zootool.com/api/users/items/?username=desandro' +
                '&apikey=8b604e5d4841c2cd976241dd90d319d7' +
                '&tag=bestofisotope&callback=?')
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
                    item = '<li><a href="' + datum.url + '">'
                        + '<img src="' + datum.image.replace('/l.', '/m.') + '" />'
                        + '<b>' + datum.title + '</b>'
                        + '</a></li>';
                    items.push(item);
                }

                var $items = $(items.join(''))
                    .addClass('example');

                // set random number for each item
                $items.each(function () {
                    $(this).attr('data-number', ~~( Math.random() * 100 + 15 ));
                });

                $items.imagesLoaded(function () {
                    $sitesTitle.removeClass('loading').text('Sites using Isotope');
                    $container.append($items);
                    $items.each(function () {
                        var $this = $(this),
                            itemHeight = Math.ceil($this.height() / 120) * 120 - 10;
                        $this.height(itemHeight);
                    });
                    $container.isotope('insert', $items);
                });

            });


    });
</script>


<footer>
    Isotope by <a href="http://desandro.com">David DeSandro</a> / <a href="http://metafizzy.co">Metafizzy</a>
</footer>

</section>
<!-- #content -->


</body>
</html>