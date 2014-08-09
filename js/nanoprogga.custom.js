// noConflict Wrapper for jQuery loads
jQuery(function($){



	/* ----------------------------------------------------------- */
	/*  1. jQuery : Make the right sidebar height equal to the content
	/* ----------------------------------------------------------- */

	/*$(document).ready(function() {
		$("#right-sidebar").height(Math.max($(".content").height(),$("#right-sidebar").height()));
	});*/


	/* ----------------------------------------------------------- */
	/*  2. TinyNav for Site Menu into Mobile
	/* ----------------------------------------------------------- */

	/* main-menu */
    $(".main-menu").tinyNav({
		active: 'selected', // String: Set the "active" class
		header: 'Navigate Pages', // String: Specify text for "header" and show header instead of the active item
		indent: '- ', // String: Specify text for indenting sub-items
		label: '' // String: Sets the <label> text for the <select> (if not set, no label will be added
    });



	/* ----------------------------------------------------------- */
	/*  3. Scroll to Content
	/* ----------------------------------------------------------- */

    $("a.skip-link").click(function() {
		$("html, body").animate({ scrollTop: $("#site-content").offset().top + 10 }, "slow");
		return false;
	});



	/* ----------------------------------------------------------- */
	/*  4. Scroll to Top
	/* ----------------------------------------------------------- */

    $("a.scroll-to-top").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
	


});