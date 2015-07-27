<?php
/**
 * Modifying the default searchform to match the design.
 *
 * @package nano-progga
 */
?>
<form role="search" method="get" class="search-form form-group" action="<?php echo home_url( '/' ); ?>">
	<label for="search-field" class="sr-only"><?php echo _x( 'Search for:', 'label', 'nano-progga' ) ?></label>
	<input type="search" id="search-field" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'nano-progga' ) ?>" />
	<button class="btn btn-link search-btn"><span class="np-search"></span></button>
</form>