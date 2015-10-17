<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package nano-progga
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'nano-progga' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><span class="np-left"></span> <?php next_posts_link( esc_html__( 'Older posts', 'nano-progga' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'nano-progga' ) ); ?> <span class="np-right"></span></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'nano-progga' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous"><span class="np-left"></span> %link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( ! function_exists( 'nano_progga_pagination' ) ) :
function nano_progga_pagination( $query = null ) {
	  
    if( is_attachment() ) { ?>

	    <nav class="navigation post-navigation small" role="navigation">
	        <div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav np-left"></span> Older Image', 'nano-progga' ) ) ?></div>
	        <div class="nav-next"><?php next_image_link( false, __( 'Latest Image <span class="meta-nav np-right"></span>', 'nano-progga' ) ) ?></div>  
	        <div class="clearfix"></div>  
	    </nav>

    <?php } else if ( is_single() ) {
	    // Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>

		<nav class="navigation post-navigation small" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'nano-progga' ); ?></h2>
			<?php
				previous_post_link( '<div class="nav-previous"><span class="np-left"></span> %link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link <span class="np-right"></span></div>', '%title' );
			?>
    	</nav>

    <?php } else {

    	/**
		 * Paginate_links enabled with Bootstrap Pagination.
		 *
		 * @author  Erik Larsson
		 * @link http://www.ordinarycoder.com/paginate_links-class-ul-li-bootstrap/
		 * 
		 * @param  object $query the query where the pagination is called.
		 */

        global $wp_query;
		$query = $query ? $query : $wp_query;

        echo '<nav class="nano-progga-pagination">';
			$big = 999999999; // need an unlikely integer
			$total = $query->max_num_pages;
			if( $total > 1 ) {
				$pages = paginate_links( array(
						'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'	=> '?paged=%#%',
						'show_all'	=> false,
						'prev_next'	=> true,
							'prev_text'	=> '&laquo;',
							'next_text'	=> '&raquo;',
						'current'	=> max( 1, get_query_var('paged') ),
						'total'		=> $total,
						'type'		=> 'array'
					) );

				if( $pages ) {
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					echo '<ul class="pagination">';
					foreach ( $pages as $page ) {
						echo '<li>'. $page .'</li>';
					}
					echo '</ul>';
				}
			}
		echo '</nav>';
  
    } //endif( is_attachment() )
}
endif;


if ( ! function_exists( 'nano_progga_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function nano_progga_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		is_home() || is_archive() ? esc_html( get_the_date( 'j-n-Y' ) ) : esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$author = '<span class="author vcard"><a class="url fn n" href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. esc_html( get_the_author() ) .'</a></span>';
	
	$posted_on = '<a href="'. esc_url( get_permalink() ) .'" rel="bookmark"><span class="np-time"></span> '. $time_string .'</a>';


	echo '<span class="byline"> <span class="np-author"></span> '. $author .'</span> | <span class="posted-on">'. $posted_on .'</span>'; // WPCS: XSS OK.
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo ' | <span class="comments-link"><span class="np-comment"></span> ';
		comments_popup_link( esc_html__( '0', 'nano-progga' ), esc_html__( '1', 'nano-progga' ), esc_html__( '%', 'nano-progga' ), '', esc_html__( 'Closed', 'nano-progga' ) );
		echo '</span>';
	}

	if( !is_home() && !is_archive() )
		edit_post_link( esc_html__( 'Edit', 'nano-progga' ), ' | <span class="edit-link"><span class="np-edit"></span> ', '</span>' );

}
endif;

if ( ! function_exists( 'nano_progga_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function nano_progga_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html( ' ' ) );
		if ( $categories_list && nano_progga_categorized_blog() ) {
			printf( '<div class="cat-links"><span class="np-categories" title="Categories"></span> %1$s</div>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html( ' ' ) );
		if ( $tags_list ) {
			printf( '<div class="tag-links"><span class="np-tags" title="Tags"></span> %1$s</div>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'nano-progga' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'nano-progga' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'nano-progga' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'nano-progga' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'nano-progga' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'nano-progga' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'nano-progga' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'nano-progga' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'nano-progga' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'nano-progga' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'nano-progga' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'nano-progga' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'nano-progga' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'nano-progga' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function nano_progga_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'nano_progga_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'nano_progga_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so nano_progga_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so nano_progga_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in nano_progga_categorized_blog.
 */
function nano_progga_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'nano_progga_categories' );
}
add_action( 'edit_category', 'nano_progga_category_transient_flusher' );
add_action( 'save_post',     'nano_progga_category_transient_flusher' );