<?php
/**
 * Maintain a series of Posts
 *  with Custom Taxonomy
 *  and showing them before Single Template the_content().
 *  
 * @package nano progga
 * ------------------------------------------------------------------------------
 */


/**
 * To maintain the Post Series declared a Custom Taxonomy (slug 'series').
 *
 * @since  2.0.1
 * ------------------------------------------------------------------------------
 */
function nano_progga_post_series() {
	$labels_series = array(
        'name'              => __( 'Series', 'nano-progga' ),
        'singular_name'     => __( 'Series', 'nano-progga' ),
        'search_items'      => __( 'Search Series', 'nano-progga' ),
        'all_items'         => __( 'All Series', 'nano-progga' ),
        'parent_item'       => __( 'Parent Series', 'nano-progga' ),
        'parent_item_colon' => __( 'Parent Series:', 'nano-progga' ),
        'edit_item'         => __( 'Edit Series', 'nano-progga' ),
        'update_item'       => __( 'Update Series', 'nano-progga' ),
        'add_new_item'      => __( 'Add New Series', 'nano-progga' ),
        'new_item_name'     => __( 'New Series Name', 'nano-progga' ),
        'menu_name'         => __( 'Series', 'nano-progga' ),
    );

    $args_series = array(
        'hierarchical'      => true,
        'labels'            => $labels_series,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'series' ),
    );

    register_taxonomy( 'series', array( 'post' ), $args_series );
}

add_action( 'init', 'nano_progga_post_series', 0 );


/**
 * Showing the List of Series Posts before Content in Single Template only.
 * 
 * @since 2.0.1
 * 
 * @param  string $content Post Content.
 * @return string          Series Content + Post Content.
 * ------------------------------------------------------------------------------
 */
function nano_progga_show_series( $content ) {

    if( !is_single() )
        return $content;

    global $post;

    $post_terms = get_the_terms( $post->ID, 'series' );

    $the_series_content = '';
    if( $post_terms ) {
      foreach ($post_terms as $the_terms) {
          if( $the_terms->taxonomy === 'series' ) {
              $term_id = $the_terms->term_id;
              $term_name = $the_terms->name;
          }
      }

      $series_args = array(
        'post_type'         => 'post',                                
        'post_status'       => 'publish',
        'order'             => 'ASC',
        'orderby'           => 'date',
        'posts_per_page'    => -1,
        'tax_query'         => array(
                                array(
                                    'taxonomy' => 'series',
                                    'terms' => intval( $term_id )
                                )
                            )
                        );
        
      $series_posts = get_posts( $series_args );
      if( !empty( $series_posts ) ) {

          ob_start();
          ?>
          <div class="posts-series">
            <h4>
                <?php _e( 'Series:&nbsp;', 'nano-progga' ); ?>
                <a href="<?php echo esc_url( get_term_link( (int) $term_id, 'series' ) ); ?>" target="_blank">
                    <strong><?php echo $term_name; ?></strong>
                </a>
                <?php _e( '&mdash; a part of the series', 'nano-progga' ); ?>
            </h4>
            <ul class="series-list">
                <?php
                foreach( $series_posts as $posts ) :
                    if( $posts->ID == get_the_id() )
                        echo '<li>'. esc_html( $posts->post_title ) .'</li>';
                    else
                        echo '<li><a href="'. esc_url( get_the_permalink( $posts->ID ) ) .'">'. esc_html( $posts->post_title ) .'</a></li>';
                endforeach;
                ?>
            </ul>
          </div> <!-- .posts-series -->
          <?php
          $the_series_content = ob_get_clean();
      }
    } //endif( $post_terms )

    if( !empty( $the_series_content ) )
        return $the_series_content . $content;
    else
        return $content;

}
add_filter( 'the_content', 'nano_progga_show_series', 10 );

function nano_progga_remove_hooks() {
  remove_filter( 'the_content', 'nano_progga_show_series', PHP_INT_MAX  );
  remove_action( current_filter(), __FUNCTION__  );
}
add_action( 'loop_end', 'nano_progga_remove_hooks' );



/**
 * Adding images to series taxonomy.
 *
 * @since 3.0.0
 *
 * @link http://tuts.nanodesignsbd.com/wordpress-taxonomy-meta-complete-guide/
 * ------------------------------------------------------------------------------
 */

function enqueue_scripts_for_series() {
    $current_screen = get_current_screen();
    
   if( $current_screen->base === 'edit-tags' && $current_screen->id === 'edit-series' ) {

        wp_enqueue_style( 'admin-styles', get_template_directory_uri() .'/admin/css/np-admin.css' );

        // Load WordPress media uploader to the back-end with backward compatibility
        if ( get_bloginfo('version') >= 3.5 )
            wp_enqueue_media();
        else {
            wp_enqueue_style('thickbox');
            wp_enqueue_script('thickbox');
        }

        wp_enqueue_script( 'admin-scripts', get_template_directory_uri() .'/admin/js/np-admin.js', array('jquery'), THEME_VERSION, true );
    }
}
add_action( 'admin_enqueue_scripts', 'enqueue_scripts_for_series' );


/**
 * Get Taxonomy Meta Field.
 *
 * @since 3.0.0
 * 
 * @param  mixed  $term_id  Term ID or Term Object.
 * @param  string $meta_key Meta Key to retrieve its data.
 * @return mixed            Meta value as string or as array.
 * ------------------------------------------------------------------------------
 */
function nano_get_tax_meta( $term_id, $meta_key = false ){
    $_term_id = ( is_object( $term_id ) ) ? $term_id->term_id : $term_id;
    $saved_meta = get_option( "tax_meta{$_term_id}" );
    if( $meta_key ) {
        if( isset( $saved_meta[$meta_key] ) )
            return $saved_meta[$meta_key];
        else
            return '';
    } else {
        return $saved_meta;
    }
}

/**
 * Get taxonomy meta data.
 *
 * @since 3.0.0
 * 
 * @param  mixed $term_id   Term ID or Term Object.
 * @param  string $meta_key Meta Key to retrieve its data.
 * @param  string $size     Image size: medium, thumbnail, large, full or custom size.
 * @return string           Image URL only.
 * ------------------------------------------------------------------------------
 */
function nano_get_tax_meta_img_src( $term_id, $meta_key, $size = 'thumbnail' ) {
    $img_meta = nano_get_tax_meta( $term_id, $meta_key );
    if( !empty($img_meta) )
        $img_url = wp_get_attachment_image_src( absint( $img_meta ), $size );
    if( $img_url )
        return $img_url[0];
    else
        return '';
}


/**
 * Series Cover Image Field (add form).
 *
 * @since 3.0.0
 * 
 * @param string $taxonomy Taxonomy slug.
 * ------------------------------------------------------------------------------
 */
function taxonomy_series_add_cover_image_field( $taxonomy ) { ?>

    <div class="form-field series-cover-input-wrap">
        <label for="text"><?php _e( 'Series Cover Image', 'nano-progga' ); ?></label>
        <div id="series-cover-preview" class="img-holder">
            <i><span class="dashicons dashicons-no"></span></i>
            <img src="" alt="<?php esc_attr_e( 'Series cover image', 'nano-progga' ); ?>" width="auto" height="60">
        </div>
        <input type="hidden" name="series_cover" id="series-cover" size="40"><br>
        <button id="series-cover-btn" class="button"><?php _e('Upload Image', 'nano-progga'); ?></button>
        <p><?php _e( 'Add/Choose an image for the cover of the Series term', 'nano-progga' ); ?></p>
    </div>

<?php
}
add_action( 'series_add_form_fields', 'taxonomy_series_add_cover_image_field' );


/**
 * Series Cover Image Field (edit form).
 * 
 * @since 3.0.0
 * 
 * @param  object $taxonomy Taxonomy object.
 * ------------------------------------------------------------------------------
 */
function taxonomy_series_edit_cover_image_field( $taxonomy ) { ?>

    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="series-cover"><?php _e( 'Series Cover Image', 'nano-progga' ); ?></label>
        </th>
        <td class="series-cover-edit-wrap">
            <?php $show = empty($saved_meta['series_cover']) ? 'hide-item' : 'show-item'; ?>
            <div id="series-cover-preview" class="img-holder <?php echo $show; ?>">
                <i><span class="dashicons dashicons-no"></span></i>
                <?php
                $db_value = nano_get_tax_meta( $taxonomy->term_id, $meta_key = 'series_cover' );
                $img_src = nano_get_tax_meta_img_src( $taxonomy->term_id, 'series_cover', $size = 'large' );
                $img_src = $img_src ? $img_src : get_template_directory_uri() .'/images/no-image.jpg';
                ?>
                <img src="<?php echo esc_url($img_src); ?>" alt="Series cover image" width="auto" height="60">
            </div>
            <input type="hidden" name="series_cover" id="series-cover" size="40" value="<?php if( $db_value ) echo $db_value; ?>"><br>
            <button id="series-cover-btn" class="button"><?php _e('Upload Image', 'nano-progga'); ?></button>
            <p class="description"><?php _e( 'Add/Choose an image for the cover of the Series term', 'nano-progga' ); ?></p>
        </td>
    </tr>

<?php
}
add_action( 'series_edit_form_fields', 'taxonomy_series_edit_cover_image_field' );


/**
 * Get image ID from full URL.
 *
 * @since 3.0.0
 * 
 * @link https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
 * @link http://codex.wordpress.org/Function_Reference/url_to_postid
 * 
 * @param  string $image_url Full URL of an image.
 * @return integer           Attachment ID of the image.
 * ------------------------------------------------------------------------------
 */
function nanodesigns_get_image_id( $image_url ) {
    global $wpdb;
    if( $image_url ) {
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
    } else {
        return '';
    }
}


/**
 * Saving Series Cover Image Field.
 *
 * @since 3.0.0
 * 
 * @param  integer $term_id  Term ID.
 * @param  integer $tt_id    Term Taxonomy ID.
 * @param  string  $taxonomy Taxonomy slug.
 * ------------------------------------------------------------------------------
 */
function taxonomy_series_save_cover_image_field( $term_id, $tt_id, $taxonomy ) {
    if( $taxonomy === 'series' ) {
        $series_meta_array = array();
        if( isset($_POST['series_cover']) ) {
            $cover_img_id = nanodesigns_get_image_id( sanitize_text_field( $_POST['series_cover'] ) );
            $series_meta_array['series_cover'] = absint( $cover_img_id );
        }
        update_option( "tax_meta{$term_id}", $series_meta_array );
    }
}
add_action( 'edit_term',    'taxonomy_series_save_cover_image_field', 10, 3 );
add_action( 'create_term',  'taxonomy_series_save_cover_image_field', 10, 3 );



/**
 * Cover Image column added to Series.
 *
 * @since 3.0.0
 * 
 * @param  array $columns Default columns.
 * @return array          New columns.
 * ------------------------------------------------------------------------------
 */
function taxonomy_series_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['cover'] = __('Cover', 'nano-progga');

    unset( $columns['cb'] );

    return array_merge( $new_columns, $columns );
}
add_filter( 'manage_edit-series_columns', 'taxonomy_series_columns' );


/**
 * Cover Image column content.
 *
 * @since 3.0.0
 * 
 * @param  array $columns  Default columns.
 * @param  string $column  Individual column.
 * @param  integer $id     Term ID.
 * @return array           Column content.
 * ------------------------------------------------------------------------------
 */
function taxonomy_series_column_content( $columns, $column, $id ) {
    if ( $column == 'cover' ) {
        $img_src = nano_get_tax_meta_img_src( $id, 'series_cover', $size = 'thumbnail' );
        $img_src = $img_src ? $img_src : get_template_directory_uri() .'/images/no-image.jpg';
        $columns = '<span><img src="'. esc_url($img_src) .'" alt="'. esc_attr__( 'Cover Image', 'nano-progga' ) .'" class="wp-post-image" width="50" height="50"></span>';
    }
    
    return $columns;
}
add_filter( 'manage_series_custom_column', 'taxonomy_series_column_content', 10, 3 );


/**
 * Making the Series ASCending order for good UX.
 * 
 * @since  3.0.0
 * 
 * @param  object $query WordPress' default query object.
 * @return object        modified as per design.
 * ------------------------------------------------------------------------------
 */
function nano_progga_series_archive_order( $query ) {
    if( $query->is_main_query() && !is_admin() && is_tax('series') )
        $query->set('order', 'ASC');
}
add_action( 'pre_get_posts', 'nano_progga_series_archive_order' );