<?php
/**
*	SHORTCODES
*	@nanodesigns
*	
*	Set all the shortcodes here in this file
*	 and require the file in the functions.php
*	 to let the user use them flowlessly
*/

/**-------------------------------------------------------------------------------------
*	PROGRESS BAR
*	to show a progress bar showing a specific feature (default 80%)
*	
*	Usage:
*	 [progress_bar]
*	 [progress_bar percent="90" text="HTML&CSS"]
*-------------------------------------------------------------------------------------*/

function nanodesigns_progress_bar( $atts ) {	
	$atts = shortcode_atts( array(
				'percent' => '80',
				'text' => 'Loving Bangladesh'
			), $atts );

	ob_start(); ?>
		<div class="nano-progress-bar">
			<div class="progress-bar-highlight" style="width:<?php echo $atts['percent'] .'%'; ?>">
				<span class="progress-bar-title"><?php echo $atts['text']; ?></span>
				<span class="progress-bar-percent"><?php echo $atts['percent'] .'%'; ?></span>
			</div> <!-- .progress-bar-title -->
			<div class="clearfix"></div>
		</div> <!-- .nano-progress-bar -->
	<?php
	return ob_get_clean();
}
add_shortcode( 'progress_bar', 'nanodesigns_progress_bar' );


/**-------------------------------------------------------------------------------------
*	ACCORDION
*	to show a collection of toggle-able boxes
*	
*	Usage:
*	 [accordion]
*		[acc_item title="TITLE HERE"]CONTENT HERE[/acc_item]
*		[acc_item title="TITLE HERE"]CONTENT HERE[/acc_item]
*	 [/accordion]
*-------------------------------------------------------------------------------------*/

function nanodesigns_accordion_item( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'title' => 'Dummy Title',
			), $atts );
	ob_start(); ?>
		<h3 class="accordion-title">
			<span class="accordion-icon np-right"></span>
			<?php echo $atts['title'] ?>
		</h3>
		<div class="accordion-content"><?php echo $content; ?></div>		
	<?php
	return ob_get_clean();
}
add_shortcode( 'acc_item', 'nanodesigns_accordion_item' );


function nanodesigns_accordion( $atts, $content ) {
	ob_start(); ?>
		<div class="nano-accordion">
			<?php echo do_shortcode( $content ); ?>
		</div> <!-- .nano-accordion -->
		<script type="text/javascript">
		jQuery('.nano-accordion h3').click(function() {
		    jQuery(this).toggleClass('active').find('span').toggleClass('np-right np-down')
		           .closest('h3').siblings('h3')
		           .removeClass('active').find('span')
		           .removeClass('np-down').addClass('np-right');

		    jQuery(this).next('.accordion-content').slideToggle().removeClass('inactive').addClass('active')
		                .siblings('.accordion-content').slideUp();  
		});
		jQuery('.accordion-content').hide().addClass('inactive');
		</script>		
	<?php
	return ob_get_clean();
}
add_shortcode( 'accordion', 'nanodesigns_accordion' );


/**-------------------------------------------------------------------------------------
*	BUTTONS
*	to show buttons in a different manner with ease
*	
*	Usage:
*	 [button size="" link="#" color="#333" background="#ededed" window=""]Button Text[/button]
*-------------------------------------------------------------------------------------*/

function bs_buttons( $atts, $content ) {
	$atts = shortcode_atts( array(
				'type'		=> 'default',
				'size'		=> 'md',
				'link'		=> '#',
				'target'	=> '_self',
				'inactive'	=> 'no'
			), $atts );

	if( $atts['size'] === 'md' ) {
		$size = '';
	} elseif( $atts['size'] === 'sm' ) {
		$size = ' btn-sm';
	} elseif( $atts['size'] === 'lg' ) {
		$size = ' btn-lg';
	} elseif( $atts['size'] === 'xs' ) {
		$size = ' btn-xs';
	}

	if( $atts['type'] === 'default' ) {
		$type = ' btn-default';
	} elseif( $atts['type'] === 'primary' ) {
		$type = ' btn-primary';
	} elseif( $atts['type'] === 'warning' ) {
		$type = ' btn-warning';
	} elseif( $atts['type'] === 'danger' ) {
		$type = ' btn-danger';
	} elseif( $atts['type'] === 'info' ) {
		$type = ' btn-info';
	} elseif( $atts['type'] === 'success' ) {
		$type = ' btn-success';
	}

	ob_start(); ?>
		<a href="<?php echo $atts['link']; ?>" target="<?php echo $atts['target']; ?>" class="btn <?php echo $type, $size; ?>" <?php if( $atts['inactive'] == 'yes' ) echo 'disabled="disabled"'; ?> ><?php echo $content; ?></a>
	<?php
	return ob_get_clean();
}
add_shortcode( 'button', 'bs_buttons' );

/**-------------------------------------------------------------------------------------
*	INFO BOX
*	to show some information in a different looking box
*	
*	Usage:
*	 [info]Info texts in the middle[/info]
*	 [info align="right" title="Information"]Info texts to the right[/info]
*	 [info align="left"]Info texts to the left[/info]
*-------------------------------------------------------------------------------------*/

function nanodesigns_info( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'align' => '',
				'title' => ''
			), $atts );

	if( $atts['align'] == 'left' ) {
		$class = 'left-info-box';
	} else if( $atts['align'] == 'right' ) {
		$class = 'right-info-box';
	} else {
		$class = '';
	}

	ob_start(); ?>
		<div class="nano-info <?php echo $class; ?>">
			<?php if( $atts['title'] != '' ) { ?>
				<h4><?php echo $atts['title']; ?></h4>
			<?php } ?>
			<div class="info-content">
				<?php echo $content; ?>
			</div>
		</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'info', 'nanodesigns_info' );



/**-------------------------------------------------------------------------------------
*	DROPCAP
*	to show a highlighted large letter/word at the beginning of a text region
*	
*	Defaults:
*	 Type = nil
*	 Text Color = #333
*	 Background Color = #fff
*
*	Usage:
*	 [dropcap]S[/dropcap]ome text here
*	 [dropcap type="circle" color="#fff" background="#333"]S[/dropcap]ome text here
*-------------------------------------------------------------------------------------*/

function nanodesigns_dropcap( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'type' => '',
				'color' => '#333',
				'background' => '#fff',
			), $atts );

	ob_start();	?>
		<span class="dropcap <?php if( $atts['type'] != '' ) echo 'dropcap-' . $atts['type']; ?>" style="color: <?php echo $atts['color']; ?>; background-color: <?php echo $atts['background']; ?>;">
			<?php echo $content; ?>
		</span>
	<?php
	return ob_get_clean();
}
add_shortcode( 'dropcap', 'nanodesigns_dropcap' );


/**-------------------------------------------------------------------------------------
*	EMPHASIZE
*	to show some special texts emphatically
*	
*	Usage:
*	 [emphasize]Text to emphasize[/emphasize]
*-------------------------------------------------------------------------------------*/

function nanodesigns_emphasize( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'color' => '',
			), $atts );

	$color = $atts['color'];

	ob_start();	?>
		<div class="emphasize" <?php echo !empty($color) ? 'style="color: '. $color .'"' : ''; ?>>
			<?php echo $content; ?>
		</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'emphasize', 'nanodesigns_emphasize' );


/**-------------------------------------------------------------------------------------
*	HIGHLIGHT
*	to highlight a text portion with a color in the background
*
*	Usage:
*	 [highlight]Some text to highlight with yellow[/highlight]
*	 [highlight color="ash"]Some text to highlight with ash[/highlight]
*	 [highlight color="red"]Some text to highlight with red[/highlight]
*	 [highlight color="green"]Some text to highlight with green[/highlight]
*-------------------------------------------------------------------------------------*/

function nanodesigns_highlight( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'color' => '',
			), $atts );

	$highlight_color = $atts['color'];

	ob_start();	?>
		<span class="highlight-text <?php echo !empty($highlight_color) ? 'highlight-text-'. $highlight_color : ''; ?>"><?php echo $content; ?></span>
	<?php
	return ob_get_clean();
}
add_shortcode( 'highlight', 'nanodesigns_highlight' );


/**-------------------------------------------------------------------------------------
*	NOTICE
*	to show a notice box with a message
*	
*	Usage:
*	 [notice]The Notice Text here with some lorem ipsum[/notice]
*	 [notice title="Notice Title"]The Notice Text here with some lorem ipsum[/notice]
*	 [notice type="normal" title="Notice Title"]The Notice Text here with some lorem ipsum[/notice]
*	 [notice type="alert" title="Notice Title"]The Notice Text here with some lorem ipsum[/notice]
*	 [notice type="green" title="Notice Title"]The Notice Text here with some lorem ipsum[/notice]
*-------------------------------------------------------------------------------------*/

function nanodesigns_notice( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'title' => '',
				'type' => 'normal'
			), $atts );

	ob_start();	?>
		<div class="notice <?php echo 'notice-'. $atts['type']; ?>">
				<?php
				if( $atts['type'] == 'alert' ) {
					echo '<span class="notice-icon np-unlike"></span>';
				} else if( $atts['type'] == 'green' ) {
					echo '<span class="notice-icon np-like"></span>';
				} else {
					echo '<span class="notice-icon np-info"></span>';
				}
				?>
				<?php if( $atts['title'] != '' ) { ?>
					<div class="notice-head"><?php echo $atts['title']; ?></div>
				<?php } ?>
				<div class="notice-body"><?php echo $content; ?></div>
			<div class="clearfix"></div>
		</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'notice', 'nanodesigns_notice' );


/**-------------------------------------------------------------------------------------
*	QUOTATION
*	to show a quotation in a smart manner than the typical <blockquote>
*	
*	Usage:
*	 [quote]Quotation to show[/quote]
*	 [quote type="left"]Quotation to show[/quote]
*-------------------------------------------------------------------------------------*/

function nanodesigns_quotation( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'type' => ''
			), $atts );

	if( $atts['type'] == 'left' ) {
		$class = ' quote-left';
	} else if ( $atts['type'] == 'right' ) {
		$class = ' quote-right';
	} else {
		$class = '';
	}

	ob_start();	?>
		<div class="quotation<?php echo $class !== '' ? $class : ''; ?>">
			<div class="quotation-icon-left"><span class="np-quote-left"></span></div>
			<div class="quotation-body"><?php echo $content; ?></div>
			<div class="clearfix"></div>
		</div> <!-- .quotation -->
	<?php
	return ob_get_clean();
}
add_shortcode( 'quote', 'nanodesigns_quotation' );


/**-------------------------------------------------------------------------------------
*	ICONS
*	to show a font-awesome icon anywhere
*	
*	Usage:
*	 [nano_icon]
*	 [nano_icon type="ion-android-alert" color="#333" size="16px"]
*	 [nano_icon_bullet type="ion-android-alert" color="#333"]
*-------------------------------------------------------------------------------------*/

function nanodesigns_icons( $atts ) {	
	$atts = shortcode_atts( array(
				'type' => 'ion-android-alert',
				'color' => '#333',
				'size' => '1rem'
			), $atts );

	ob_start();	?>
		<span class="nano-icon <?php echo $atts['type']; ?>" style="color: <?php echo $atts['color']; ?>; font-size: <?php echo $atts['size']; ?>;"></span>
	<?php
	return ob_get_clean();
}
add_shortcode( 'nano_icon', 'nanodesigns_icons' );

function nanodesigns_icons_bullet( $atts ) {
	$atts = shortcode_atts( array(
				'type'		=> 'ion-android-alert',
				'color'		=> '#fff',
				'bgcolor'	=> '#004a80'
			), $atts );

	ob_start();	?>
		<span class="nano-icon-bullet <?php echo $atts['type']; ?>" style="color: <?php echo $atts['color']; ?>; background-color: <?php echo $atts['bgcolor']; ?>;"></span>
	<?php
	return ob_get_clean();
}
add_shortcode( 'nano_icon_bullet', 'nanodesigns_icons_bullet' );


/**-------------------------------------------------------------------------------------
*	BOOTSTRAP ROW-COLUMS SHORTCODE
*	to show bootstrap columns anywhere
*	
*	Usage:
*	 [row][/row]
*	 [row][twothird][/twothird][/row]
*-------------------------------------------------------------------------------------*/
function nanodesigns_bs_row( $attr, $content = null ) {
    $data = "<div class='row'>";
    	$data .= do_shortcode($content);
    $data .= "</div>";
    $data = str_replace("<br>", "", $data);
    return $data;
}
add_shortcode( 'row', 'nanodesigns_bs_row' );

function nanodesigns_bs_twothird( $attr, $content = null ) {
    $data = "<div class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>";
    	$data .= do_shortcode($content);
    $data .= "</div>";
    return $data;
}
add_shortcode( 'twothird', 'nanodesigns_bs_twothird' );

function nanodesigns_bs_onethird( $attr, $content = null ) {
    $data = "<div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>";
    	$data .= do_shortcode($content);
    $data .= "</div>";
    return $data;
}
add_shortcode( 'onethird', 'nanodesigns_bs_onethird' );

function nanodesigns_bs_half( $attr, $content = null ) {
    $data = "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>";
    	$data .= do_shortcode($content);
    $data .= "</div>";
    return $data;
}
add_shortcode( 'half', 'nanodesigns_bs_half' );

function nanodesigns_bs_threequarter( $attr, $content = null ) {
    $data = "<div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>";
    	$data .= do_shortcode($content);
    $data .= "</div>";
    return $data;
}
add_shortcode( 'threequarter', 'nanodesigns_bs_threequarter' );

function nanodesigns_bs_quarter( $attr, $content = null ) {
    $data = "<div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>";
    	$data .= do_shortcode($content);
    $data .= "</div>";
    return $data;
}
add_shortcode( 'quarter', 'nanodesigns_bs_quarter' );

function nanodesigns_bs_full( $attr, $content = null ) {
    $data = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
    	$data .= do_shortcode($content);
    $data .= "</div>";
    return $data;
}
add_shortcode( 'full', 'nanodesigns_bs_full' );


/**-------------------------------------------------------------------------------------
*	INNER TITLE
*	to show special type of title
*	
*	Usage:
*	 [inner_title type="h4"]Inner Title[/inner_title]
*-------------------------------------------------------------------------------------*/

function nanodesigns_inner_title( $atts, $content ) {	
	$atts = shortcode_atts( array(
				'type' => 'h4',
			), $atts );

	$type = $atts['type'];

	$output = '<'. $type .' class="inner-title">';
	$output .= '<span>';
	$output .= $content;
	$output .= '</span>';
	$output .= '</'. $type .'>';

	return $output;
}
add_shortcode( 'inner_title', 'nanodesigns_inner_title' );



/**-------------------------------------------------------------------------------------
*	NOTES
*	to show some special notes within texts
*	
*	Usage:
*	 [notes]Text to show as a note[/notes]
*-------------------------------------------------------------------------------------*/

function nanodesigns_note( $atts, $content ) {	
	$atts = shortcode_atts( array(), $atts );

	ob_start();	?>
		<div class="nano-notes">
			<?php echo $content; ?>
		</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'notes', 'nanodesigns_note' );