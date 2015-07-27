<?php
/**
 * Maintain a series of Posts
 *  with Custom Taxonomy
 *  and showing them before Single Template Content.
 *  
 * @package nano progga
 * ------------------------------------------------------------------------------
 */


/**
 * To maintain the Post Series declared a Custom Taxonomy (slug 'series').
 * @return void
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
 * @param  string $content Post Content.
 * @return string          Series Content + Post Content.
 * ------------------------------------------------------------------------------
 */
function nano_progga_show_series( $content ) {

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
        'post_type' => 'post',                                
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'date',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'series',
                'terms' => $term_id
            )
        )
      );
        
      $series_posts = get_posts( $series_args );
      if( !empty( $series_posts ) ) {

          ob_start();
          ?>
          <div class="posts-series">
            <h4>
              <?php _e( 'Series: ', 'nano-progga' ); ?>
              <a href="<?php echo get_term_link( $term_id, 'series' ); ?>" target="_blank"><strong><?php echo $term_name; ?></strong></a>
              <?php _e( '&mdash; a part of the series', 'nano-progga' ); ?>
            </h4>
            <ul class="series-list"><?php
            foreach ($series_posts as $posts) {
                if( $posts->ID == get_the_id() ) {
                  echo '<li>'. $posts->post_title .'</li>';
                } else {
                  echo '<li><a href="'. get_the_permalink( $posts->ID ) .'">'. $posts->post_title .'</a></li>';
                }
            } ?>
            </ul>
          </div> <!-- .posts-series -->
          <?php
          $the_series_content = ob_get_clean();
      }
    } //endif( $post_terms )

    if( is_single() && !empty( $the_series_content ) ) {
      return $the_series_content . $content;
    } else {
      return $content;
    }

}

add_filter( 'the_content', 'nano_progga_show_series', 10 );

function nano_progga_remove_hooks() {
  remove_filter( 'the_content', 'nano_progga_show_series', PHP_INT_MAX  );
  remove_action( current_filter(), __FUNCTION__  );
}
add_action( 'loop_end', 'nano_progga_remove_hooks' );



/**
 * ADDING IMAGES TO SERIES TAXONOMY
 *
 * @inspired from "Category Images" plugin
 * @author Muhammad Said El Zahlan
 * @link http://zahlan.net/blog/2012/06/categories-images/
 * ------------------------------------------------------------------------------
 */

define('NP_IMAGE_PLACEHOLDER', get_template_directory_uri() ."/images/placeholder.png");



function nano_progga_add_style() {
    echo '<style type="text/css" media="screen">
        th.column-thumb {width:60px;}
        .form-field img.taxonomy-image {border:1px solid #eee;max-width:300px;max-height:300px;}
        .inline-edit-row fieldset .thumb label span.title {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
        .column-thumb span {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
        .inline-edit-row fieldset .thumb img,.column-thumb img {width:48px;height:48px;}
    </style>';
}

// add image field in add form
function nano_progga_add_taxonomy_field() {
    if (get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }
    
    echo '<div class="form-field">
        <label for="taxonomy_image">' . __('Image', 'nano-progga') . '</label>
        <input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
        <br/>
        <button class="np_upload_image_button button">' . __('Upload/Add image', 'nano-progga') . '</button>
    </div>'.nano_progga_script();
}

add_action('series_add_form_fields', 'nano_progga_add_taxonomy_field');


// add image field in edit form
function nano_progga_edit_taxonomy_field( $taxonomy ) {
    if (get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }
    
    if (nano_progga_series_image_url( $taxonomy->term_id, null, true ) == NP_IMAGE_PLACEHOLDER) 
        $image_text = "";
    else
        $image_text = nano_progga_series_image_url( $taxonomy->term_id, null, true );
    echo '<tr class="form-field">
        <th scope="row" valign="top"><label for="taxonomy_image">' . __('Image', 'nano-progga') . '</label></th>
        <td><img class="taxonomy-image" src="' . nano_progga_series_image_url( $taxonomy->term_id, null, true ) . '"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_text.'" /><br />
        <button class="np_upload_image_button button">' . __('Upload/Add image', 'nano-progga') . '</button>
        <button class="np_remove_image_button button">' . __('Remove image', 'nano-progga') . '</button>
        </td>
    </tr>'.nano_progga_script();
}

add_action('series_edit_form_fields', 'nano_progga_edit_taxonomy_field');


// upload using wordpress upload
function nano_progga_script() {
    return '<script type="text/javascript">
        jQuery(document).ready(function($) {
            var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
            $(".np_upload_image_button").click(function(event) {
                upload_button = $(this);
                var frame;
                if (wordpress_ver >= "3.5") {
                    event.preventDefault();
                    if (frame) {
                        frame.open();
                        return;
                    }
                    frame = wp.media();
                    frame.on( "select", function() {
                        // Grab the selected attachment.
                        var attachment = frame.state().get("selection").first();
                        frame.close();
                        if (upload_button.parent().prev().children().hasClass("tax_list")) {
                            upload_button.parent().prev().children().val(attachment.attributes.url);
                            upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
                        }
                        else
                            $("#taxonomy_image").val(attachment.attributes.url);
                    });
                    frame.open();
                }
                else {
                    tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
                    return false;
                }
            });
            
            $(".np_remove_image_button").click(function() {
                $("#taxonomy_image").val("");
                $(this).parent().siblings(".title").children("img").attr("src","' . NP_IMAGE_PLACEHOLDER . '");
                $(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
                return false;
            });
            
            if (wordpress_ver < "3.5") {
                window.send_to_editor = function(html) {
                    imgurl = $("img",html).attr("src");
                    if (upload_button.parent().prev().children().hasClass("tax_list")) {
                        upload_button.parent().prev().children().val(imgurl);
                        upload_button.parent().prev().prev().children().attr("src", imgurl);
                    }
                    else
                        $("#taxonomy_image").val(imgurl);
                    tb_remove();
                }
            }
            
            $(".editinline").live("click", function(){  
                var tax_id = $(this).parents("tr").attr("id").substr(4);
                var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");
                if (thumb != "' . NP_IMAGE_PLACEHOLDER . '") {
                    $(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
                } else {
                    $(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
                }
                $(".inline-edit-col .title img").attr("src",thumb);
                return false;  
            });  
        });
    </script>';
}

// save our taxonomy image while edit or save term

function nano_progga_save_taxonomy_image( $term_id ) {
    if(isset($_POST['taxonomy_image']))
        update_option('nano_progga_series_image'.$term_id, $_POST['taxonomy_image']);
}

add_action('edit_term','nano_progga_save_taxonomy_image');
add_action('create_term','nano_progga_save_taxonomy_image');

/**
 * Get image ID from full source path.
 * @link https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
 * @link http://codex.wordpress.org/Function_Reference/url_to_postid
 * 
 * @param  string $image_src full source path of an image
 * @return integer            attachment ID of the image
 * --------------------------------------------------------------------------
 */
function nano_progga_get_attachment_id_by_url( $image_src ) {
  global $wpdb;
  if( $image_src ) {
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_src ));
    return $attachment[0];
  } else {
    return null;
  }
}

// get taxonomy image url for the given term_id (Place holder image by default)
function nano_progga_series_image_url($term_id = null, $size = null, $return_placeholder = false) {
    if (!$term_id) {
        if (is_category())
            $term_id = get_query_var('cat');
        elseif (is_tax()) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }
    
    $taxonomy_image_url = get_option('nano_progga_series_image'.$term_id);

    if(!empty($taxonomy_image_url)) {
        $attachment_id = nano_progga_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id)) {
            if (empty($size))
                $size = 'full';
            $taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
            $taxonomy_image_url = $taxonomy_image_url[0];
        }
    }

    if ($return_placeholder)
        return ($taxonomy_image_url != '') ? $taxonomy_image_url : NP_IMAGE_PLACEHOLDER;
    else
        return $taxonomy_image_url;
}

function nano_progga_quick_edit_custom_box($column_name, $screen, $name) {
    if ($column_name == 'thumb') 
        echo '<fieldset>
        <div class="thumb inline-edit-col">
            <label>
                <span class="title"><img src="" alt="Thumbnail"/></span>
                <span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
                <span class="input-text-wrap">
                    <button class="np_upload_image_button button">' . __('Upload/Add image', 'nano-progga') . '</button>
                    <button class="np_remove_image_button button">' . __('Remove image', 'nano-progga') . '</button>
                </span>
            </label>
        </div>
    </fieldset>';
}

/**
 * Thumbnail column added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */
function nano_progga_taxonomy_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumb'] = __('Image', 'nano-progga');

    unset( $columns['cb'] );

    return array_merge( $new_columns, $columns );
}
add_filter( 'manage_edit-series_columns', 'nano_progga_taxonomy_columns' );
add_filter( 'manage_series_custom_column', 'nano_progga_taxonomy_column', 10, 3 );

/**
 * Thumbnail column value added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */
function nano_progga_taxonomy_column( $columns, $column, $id ) {
    if ( $column == 'thumb' )
        $columns = '<span><img src="' . nano_progga_series_image_url($id, null, true) . '" alt="' . __('Thumbnail', 'nano-progga') . '" class="wp-post-image" /></span>';
    
    return $columns;
}

// change 'insert into post' to 'use this image'
function nano_progga_change_insert_button_text($safe_text, $text) {
    return str_replace("Insert into Post", "Use this image", $text);
}

// style the image in category list
if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 ) {
    add_action( 'admin_head', 'nano_progga_add_style' );
    add_action( 'quick_edit_custom_box', 'nano_progga_quick_edit_custom_box', 10, 3);
    add_filter( 'attribute_escape', 'nano_progga_change_insert_button_text', 10, 2);
}


/**
 * Making the Series ASCending order for good UX
 * @param  object $query WordPress' default query object.
 * @return object        modified as per design.
 */
function nano_progga_series_archive_order( $query ) {
    if( $query->is_main_query() && !is_admin() && is_tax('series') ) {
        $query->set('order', 'ASC');
    }
}
add_action( 'pre_get_posts', 'nano_progga_series_archive_order' );