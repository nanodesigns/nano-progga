/* JavaScripts for nano-progga Front-end Common Tweaks */
jQuery(window).on('load', function($){
	var grid_container = jQuery('#infinite-scroll-holder');
	if( grid_container.length > 0 ) {
		var g_cont = grid_container.masonry({
			// options
			itemSelector: '.col-sm-4',
			columnWidth: '.col-sm-4',
			//percentPosition: true
		});

		g_cont.imagesLoaded(function(){
			grid_container.masonry('layout');
	    });
    
	}
});

jQuery(document).ready(function($) {
	
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