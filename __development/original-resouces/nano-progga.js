/* JavaScripts for nano-progga Front-end Common Tweaks */
jQuery(window).on('load', function($){
	var grid_container = jQuery('#infinite-scroll-holder');
	if( grid_container.length > 0 ) {
		grid_container.masonry({
			// options
			itemSelector: '.col-sm-4',
			columnWidth: '.col-sm-4',
			//percentPosition: true
		});
		grid_container.masonry('layout');
	}
});

jQuery(document).ready(function($) {


	/**

	// Count number of times infinte scroll is triggered
	infinite_count = 0;
    
	// Triggers re-layout on infinite scroll
	// post-load triggers when infinite scroll is called
	jQuery(document.body).on('post-load', function() {

		// select container holding masonry posts
		grid_container = $('#infinite-scroll-holder');

		// initialize container with masonry
		grid_container.masonry({
			columnWidth: '.col-md-4',
			itemSelector: '.grid-item'
		});

		// increment count by 1
		infinite_count = infinite_count + 1;

		// select container holding new posts via infinte scroll
		selector = jQuery('#infinite-view-' + infinite_count);

		// find posts within infinite scroll container
		elements = selector.find('.article-holder');

		// append the new posts to the container
		grid_container.append(elements);

		// hide the new posts
		elements.hide();

		// reload the entire container with proper layout
		grid_container.masonry( 'reloadItems' );

		// fade in the new elements
		elements.fadeIn();
	});
	*/

	/*var grid_container = $('#infinite-scroll-holder');
	if( grid_container.length > 0 ) {
		grid_container.masonry({
			itemSelector: '.grid-item',
			columnWidth: '.col-md-4',
			//percentPosition: true
		});

		grid_container.infinitescroll({
			navSelector		: '.posts-navigation',
			nextSelector	: '.posts-navigation .nav-previous a',
			itemSelector	: '.grid-item',
			loading			: {
				finishedMsg	: 'no more posts to load',
				img			: np.theme_path + '/images/ajax-loader.gif'
			}
		},
		//trigger masonry as a callback
		function ( newElements ) {
			//hide new elements while they are loading
			var newElems = $( newElements ).css({ opacity: 0 });

			//ensure that images load before adding to masonry layout
			newElems.imagesLoaded(function(){
				//show elements now, they're ready
				newElems.animate({ opacity: 1 });
				grid_container.masonry( 'appended', newElems, true );
			})
		});
	}*/

	/*var $container = $('#infinite-scroll-holder');
    
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: '.grid-item',
        columnWidth: '.col-md-4'
      });
    });
    
    $container.infinitescroll({
      navSelector  : '.posts-navigation',    // selector for the paged navigation 
      nextSelector : '.posts-navigation .nav-previous a',  // selector for the NEXT link (to page 2)
      itemSelector : '.grid-item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
          img: np.theme_path + '/images/ajax-loader.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
      }
    );*/

	/*===========================================================*/
	/*	02. Scroll to Top
	/* 		@scope: footer.php
	/*===========================================================*/	
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#to-top, #backtotop').fadeIn();	
		} else {
			$('#to-top, #backtotop').fadeOut();
		}
	});
	$('#to-top').click(function() {
		$('body, html').animate({scrollTop:0},800);
	});

	/* ----------------------------------------------------------- */
	/*  03. Series Post Name collapse
	/* 		@scope: inc/functions-series.php
	/* ----------------------------------------------------------- */

	$('.posts-series h4').append('<button class="series-handle np-circle-up pull-right"></button>');

	var toggleHandle = $("button.series-handle");
	var upClass = 'np-circle-up';
	var downClass = 'np-circle-down';

    $("button.series-handle").click(function(){
		$("ul.series-list").toggle(400);
		toggleHandle.toggleClass( downClass, upClass );
		if( toggleHandle.hasClass( downClass ) ) {
			toggleHandle.removeClass( upClass );
		} else {
			toggleHandle.addClass( upClass );
		}
	});


	/*----------------------------------------------------------*/
	/*	04. Social Media Control on Footer
	/* 		@scope: footer.php
	/*----------------------------------------------------------*/
	var social_handle = $( '.social-handle' );
	social_handle.css( 'display', 'inline-block' );
	social_handle.click(function() {
	  $( ".socials" ).toggle( "slow" );
	});


	/*----------------------------------------------------------*/
	/*	05. Equal Height
	/* 		@scope: header.php
	/*----------------------------------------------------------*/
	var series_imgs = $( '.series-block img' );
	if( series_imgs.length > 0 ) {
		series_imgs.matchHeight();
	}

});