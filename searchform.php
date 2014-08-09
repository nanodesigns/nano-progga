<?php
/**
*	Search Form
*	@theme: nano progga
*/
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    	<label for="s" class="screen-reader-text sr-only"><?php _e( 'Search', 'nano-progga' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'nano-progga' ); ?>" value="<?php the_search_query(); ?>" />
		<button type="submit" class="submit" id="searchsubmit">
			<span class="fa fa-search"></span>
		</button>
	</form>
