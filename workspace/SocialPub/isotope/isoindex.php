<!doctype html>
<html lang="en">
<head>
  
  <meta charset="utf-8" />
  <title>Isotope</title>
  
  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endi`f]-->
  
  <link rel="stylesheet" href="css/style.css" />
  
  <!-- scripts at bottom of page -->

</head>
<body class="homepage ">
  

  
  <section id="content">
    

      <section id="options" class="clearfix">
    <div class="option-combo">
      <h2>Filter:</h2>
      <ul id="filter" class="option-set clearfix" data-option-key="filter">
        <li><a href="#show-all" data-option-value="*" class="selected">show all</a></li>
        <li><a href="#sports" data-option-value=".sports">sports</a></li>
        <li><a href="#tech" data-option-value=".tech">tech</a></li>
        <li><a href="#news" data-option-value=".news">news</a></li>
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
    
      
          
    <div class="news">
        <div class="thumbnail">

            <img src="http://www.sigmalive.com/application/cache/default/images/news/615x340/proedr.jpg" alt="">

            <h5>Thumbnail label</h5>

            <p>Thumbnail caption...</p>
        </div>
    </div>
    
      
          
    <div class="tech">
        <div class="thumbnail">
            <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

            <h5>Thumbnail label</h5>

            <p>Thumbnail caption...</p>
        </div>
    </div>
    
      
          
    <div class="sports">
        <div class="thumbnail">
            <img src="http://imageshack.us/a/img198/8008/sports5newt.jpg" alt="">

            <h5>Thumbnail label</h5>

            <p>Thumbnail caption...</p>
        </div>
    </div>
    
      
          
    <div class="thumbnails">
        <div class="thumbnail">
            <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

            <h5>Thumbnail label</h5>

            <p>Thumbnail caption...</p>
        </div>
    </div>
    
      
          
    <div class="thumbnails" data-symbol="B" data-category="metalloid">
        <div class="thumbnail">
            <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

            <h5>Thumbnail label</h5>

            <p>Thumbnail caption...</p>
        </div>
    </div>
    
      
          
    <div class="thumbnails" data-symbol="Fe" data-category="transition">
        <div class="thumbnail">
            <img src="http://www.wired.com/images_blogs/underwire/2013/04/Slide12-300x150.jpg" alt="">

            <h5>Thumbnail label</h5>

            <p>Thumbnail caption...</p>
        </div>
    </div>
    


  </div>


  
  
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="jquery.isotope.min.js"></script>
  <script>
    $(function(){
    
      var $container = $('#container');
    
      $container.isotope({
        masonry: {
          columnWidth: 120
        },
        sortBy: 'number',
        getSortData: {
          number: function( $elem ) {
            var number = $elem.hasClass('element') ? 
              $elem.find('.number').text() :
              $elem.attr('data-number');
            return parseInt( number, 10 );
          },
          alphabetical: function( $elem ) {
            var name = $elem.find('.name'),
                itemText = name.length ? name : $elem;
            return itemText.text();
          }
        }
      });
    
      
      var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
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
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });


    
      // Sites using Isotope markup
      var $sites = $('#sites'),
          $sitesTitle = $('<h2 class="loading"><img src="http://i.imgur.com/qkKy8.gif" />Loading sites using Isotope</h2>'),
          $sitesList = $('<ul class="clearfix"></ul>');

      //$sites.append( $sitesTitle ).append( $sitesList );

      $sitesList.isotope({
        layoutMode: 'cellsByRow',
        cellsByRow: {
          columnWidth: 290,
          rowHeight: 400
        }
      });

      var ajaxError = function(){
        $sitesTitle.removeClass('loading').addClass('error')
          .text('Could not load sites using Isotope :(');
      };

      // dynamically load sites using Isotope from Zootool
      $.getJSON('http://zootool.com/api/users/items/?username=desandro' +
          '&apikey=8b604e5d4841c2cd976241dd90d319d7' +
          '&tag=bestofisotope&callback=?')
        .error( ajaxError )
        .success(function( data ){

          // proceed only if we have data
          if ( !data || !data.length ) {
            ajaxError();
            return;
          }
          var items = [],
              item, datum;

          for ( var i=0, len = data.length; i < len; i++ ) {
            datum = data[i];
            item = '<li><a href="' + datum.url + '">'
              + '<img src="' + datum.image.replace('/l.', '/m.') + '" />'
              + '<b>' + datum.title + '</b>'
              + '</a></li>';
            items.push( item );
          }

          var $items = $( items.join('') )
            .addClass('example');

          // set random number for each item
          $items.each(function(){
            $(this).attr('data-number', ~~( Math.random() * 100 + 15 ));
          });

          $items.imagesLoaded(function(){
            $sitesTitle.removeClass('loading').text('Sites using Isotope');
            $container.append( $items );
            $items.each(function(){
              var $this = $(this),
                  itemHeight = Math.ceil( $this.height() / 120 ) * 120 - 10;
              $this.height( itemHeight );
            });
            $container.isotope( 'insert', $items );
          });

        });


    });
  </script>

    
    <footer>
      Isotope by <a href="http://desandro.com">David DeSandro</a> / <a href="http://metafizzy.co">Metafizzy</a>
    </footer>
    
  </section> <!-- #content -->

  <!--Javascripts-->
  <script src="js/mainJavascript.js"></script>
  <script src="js/bootstrap-transition.js"></script>
  <script src="js/bootstrap-alert.js"></script>
  <script src="js/bootstrap-modal.js"></script>
  <script src="js/bootstrap-dropdown.js"></script>
  <script src="js/bootstrap-scrollspy.js"></script>
  <script src="js/bootstrap-tab.js"></script>
  <script src="js/bootstrap-tooltip.js"></script>
  <script src="js/bootstrap-popover.js"></script>
  <script src="js/bootstrap-button.js"></script>
  <script src="js/bootstrap-collapse.js"></script>
  <script src="js/bootstrap-carousel.js"></script>
  <script src="js/bootstrap-typeahead.js"></script>

</body>
</html>