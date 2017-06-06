<?php

function sei_theme_options_defaults( $defaults ) {
	$defaults['twitter_url']    = '';
	$defaults['facebook_url']   = '';
	$defaults['linkedin_url']   = '';
	$defaults['googleplus_url'] = '';
	$defaults['phone_number']   = '';
	$defaults['fax_number']     = '';
	$defaults['mobile_number']  = '';
	$defaults['blog_default_image']  = '';
	$defaults['blog_default_alt_image']  = '';

	return $defaults;
}

function sei_register_social_sanitization_filters() {
	
	genesis_add_option_filter( 
		'no_html', 
		GENESIS_SETTINGS_FIELD,
		array(
			'twitter_url',
			'facebook_url',
			'linkedin_url',
			'googleplus_url',
			'phone_number',
			'fax_number',
			'mobile_number',
			'blog_default_image',
			'blog_default_alt_image'
		) 
	);
}


function sei_register_theme_settings_box( $_genesis_theme_settings_pagehook ) {
	add_meta_box( 'sei-theme-settings', 'Theme Settings', 'sei_theme_settings', $_genesis_theme_settings_pagehook, 'main', 'high' );
}

function sei_theme_settings() {
	?>
	<h4>Social Media</h4>
	<p><?php _e( 'Twitter URL:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[twitter_url]" value="<?php echo esc_url( genesis_get_option('twitter_url') ); ?>" size="50" /></p>

	<p><?php _e( 'Facebook URL:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[facebook_url]" value="<?php echo esc_url( genesis_get_option('facebook_url') ); ?>" size="50" /></p>
	
	<p><?php _e( 'LinkedIn URL:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[linkedin_url]" value="<?php echo esc_url( genesis_get_option('linkedin_url') ); ?>" size="50" /></p>
	
	<p><?php _e( 'Google Plus URL:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[googleplus_url]" value="<?php echo esc_url( genesis_get_option('googleplus_url') ); ?>" size="50" /></p>
	
	<h4>Contact Numbers</h4>
	<p><?php _e( 'Phone Number:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[phone_number]" value="<?php echo genesis_get_option('phone_number'); ?>" size="50" /></p>
	<p><?php _e( 'Fax Number:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[fax_number]" value="<?php echo genesis_get_option('fax_number'); ?>" size="50" /></p>
	<p><?php _e( 'Mobile Number:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[mobile_number]" value="<?php echo genesis_get_option('mobile_number'); ?>" size="50" /></p>
	
	<h4>Blog</h4>
	<p><?php _e( 'Blog Page Title:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[blog_page_title]" value="<?php echo genesis_get_option('blog_page_title'); ?>" size="50" /></p>
	
	<h4>Single Post Default Featured Image</h4>
	<p><?php _e( 'Single Post Default Featured Image:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[blog_default_image]" value="<?php echo genesis_get_option('blog_default_image'); ?>" size="50" /></p>
	
	<h4>Single Post Default Featured Image Alt Tag</h4>
	<p><?php _e( 'Single Post Default Featured Image Alt Tag:', 'be-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[blog_default_alt_image]" value="<?php echo genesis_get_option('blog_default_alt_image'); ?>" size="50" /></p>
	
	<?php
}

function sei_parallax_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
		) );

}

/* ============================================ End of Custom Theme Settings ====================================================  */


function sixteen_nine_custom_footer( $output ) {
	return null;
}

function custom_read_more_link() {
	return '<div class="read-more-container"><a class="button more-link" href="' . get_permalink() . '">'.READ_MORE_TEXT.'</a></div></p>';
}


function be_default_category_title( $headline, $term ) {
	if( ( is_category() || is_tag() || is_tax() ) && empty( $headline ) ) {
		$headline = $term->name;
	} 
	return $headline;
}


function sp_next_page_link ( $text ) {
	return 'OLDER ARTICLES &#x000BB;';
}

function sp_previous_page_link ( $text ) {
	return '&#x000AB; NEWER ARTICLES';
}

function remove_a_body_class($wp_classes) {
    if(  !is_front_page()   ) :
        $wp_classes[] ="inner-page";
    endif;
    return $wp_classes;
}

function sei_form_submit_button( $button, $form ) {
    return "<button class='button hvr-shutter-out-horizontal gform_button button' id='gform_submit_button_{$form['id']}'><span>".$form['button']['text']."</span></button>";
}

function gform_column_splits($content, $field, $value, $lead_id, $form_id) {
	if(!is_admin()) { // only perform on the front end
		if($field['type'] == 'section') {
			$form = RGFormsModel::get_form_meta($form_id, true);

			// check for the presence of multi-column form classes
			$form_class = explode(' ', $form['cssClass']);
			$form_class_matches = array_intersect($form_class, array('two-column', 'three-column'));

			// check for the presence of section break column classes
			$field_class = explode(' ', $field['cssClass']);
			$field_class_matches = array_intersect($field_class, array('gform_column'));

			// if field is a column break in a multi-column form, perform the list split
			if(!empty($form_class_matches) && !empty($field_class_matches)) { // make sure to target only multi-column forms

				// retrieve the form's field list classes for consistency
				$form = RGFormsModel::add_default_properties($form);
				$description_class = rgar($form, 'descriptionPlacement') == 'above' ? 'description_above' : 'description_below';

				// close current field's li and ul and begin a new list with the same form field list classes
				return '</li></ul><ul class="gform_fields '.$form['labelPlacement'].' '.$description_class.' '.$field['cssClass'].'"><li class="gfield gsection empty">';

			}
		}
	}

	return $content;
}

function sp_post_meta_filter($post_meta) {
	if ( !is_page() ) {
		$post_meta = '[post_tags before="Tagged: "]';
		return $post_meta;
	}
}


function sei_custom_footer() {
	genesis_widget_area( 'footer-entry-1', array(
		'before' => '<div class="footer col-xs-12 col-md-4 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'footer-entry-2', array(
		'before' => '<div class="footer col-xs-12 col-md-4 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'footer-entry-3', array(
		'before' => '<div class="footer col-xs-12 col-md-4 widget-area text-align-right"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

function sei_social_share(){
	
	global $post;
	
	$content = "";
	if ( is_single() || is_archive() || is_home() ){
					// Get current page URL 
		$pageLink = get_permalink();
 
		// Get current page title
		$pageTitle = str_replace( ' ', '%20', get_the_title());
		
		// Get Post Thumbnail for pinterest
		$crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
		// Construct sharing URL without using any script
		
		$short_url  = sei_make_bitly_url($pageLink);
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$pageTitle.'&amp;url='.$short_url;

		/* Start of New Buttons */
		$pageLink  = urlencode( get_permalink() );
		$pageTitle = $pageTitle;
		
		/* http://petragregorova.com/articles/social-share-buttons-with-custom-icons/ */
		$content .= '<div class="sei-social-share">';
		$content .= '<div class="sei-link"><a title="Share on Facebook" class="facebook" href="http://www.facebook.com/share.php?u='.$pageLink.'&title='.$pageTitle.'"><i class="fa fa-facebook" aria-hidden="true"></i> share</a></div>';
		$content .= '<div class="sei-link"><a title="Share on Google+" class="googleplus" href="https://plus.google.com/share?url='.$pageLink.'"><i class="fa fa-google-plus" aria-hidden="true"></i> share</a></div>';
		$content .= '<div class="sei-link"><a title="Share on LinkedIn" class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url='.$pageLink.'&title='.$pageTitle.'&source='.esc_url( home_url( '/' ) ).'"><i class="fa fa-linkedin" aria-hidden="true"></i> share</a></div>';
		$content .= '<div class="sei-link"><a title="Tweet this post" class="twitter" href="'.$twitterURL.'"><i class="fa fa-twitter" aria-hidden="true"></i> tweet</a></div>';
		$content .= '</div>';

		echo $content;
		
	}
}


function sei_blog_list_featured_image() {
	global $post;
	if( !is_page() && ( !is_single() || is_archive() ) ) {
		ob_start();
		the_post_thumbnail('post-image'); // set the size here
		$image = ob_get_clean();
		echo "<div class='post-featured-image'>".$image."</div>";
		
	}
}


function sei_custom_inline_scripts(){ 
?>
	<script type="text/javascript">
	 jQuery(document).ready( function(){	  		
		 jQuery(".tagcloud a").each(function(){
			var txt = jQuery(this).html();
			jQuery(this).html('<span data-hover="'+txt+'" >' + txt + '</span>' );
		 });
		 
		 jQuery(".math-capcha .gfield_label").append('<span class="gfield_required">*</span>');
	 });
	 
	 	/* Because IE is annoying */
	 if (window.ActiveXObject || "ActiveXObject" in window){
	  <!--
	  document.write('<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/modernizr.js"></script>');
	  -->
	 }
	 
	</script>
	<?php
}

function sei_blog_list_title() {
	if( is_home() ) {
		?><h1 class="post-title"><?php echo genesis_get_option('blog_page_title'); ?></h1><?php
	} else {
		if( is_category() || is_tag() || is_archive() || is_author() ) {
			echo '<h1 class="post-title">'.ucwords(  get_the_archive_title().' Archives' ).'</h1>'; 
		} 

	}
}

function sei_get_logo_func() {
	return '<div itemprop="headline" id="site-title"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img id="site-logo" src="'. get_header_image().'" alt="'.get_bloginfo( 'title' ).'" /></a></div>';
}


function sei_telnumber($atts, $content="") {
	
	if( isset( $atts['label'] ) ) {
		$label = $atts['label'];
	} else {
		$label = "";
		if( !is_front_page() && is_page() ) {
			$label = "Content Page";
		} else {
			$label = "Home";
		}
	}

	if ( !empty( $atts['number'] ) ) {
		$html = "<a onmousedown=\"ga('send', 'event', 'Phone', 'Call', '".$label."');\" class='call-phone ".$atts['class']."' href=\"tel:" . $atts['number'] . "\">" . ( !empty($content) ? $content : $atts['number']  ). "</a>";
	} else {
		$number = "";
		switch( $atts['type'] ) {
			case "phone":
			$number = genesis_get_option('phone_number');
			break;
			
			case "fax":
			$number = genesis_get_option('fax_number');
			
			case "mobile":
			$number = genesis_get_option('mobile_number');
			break;
			
			default:
			$number = genesis_get_option('phone_number');
			break;
		}
		
		$html   = "<a onmousedown=\"ga('send', 'event', 'Phone', 'Call', '".$label."');\" class='call-phone' href=\"tel:" . ( !empty($number) ? str_replace(" ", "", $number ) : str_replace(" ", "", $content ) ) . "\">" . ( !empty($number) ? $number : $content ) . "</a>";
	}

	return $html;
}

function sei_copyright_func($atts, $content) {

	$html = "<span class='copyright'>Copyright  &copy; ".date("Y")." ".get_bloginfo('name').". All Rights Reserved.</span>";

	if( is_front_page() ) {
		$html .= "<span class='sei'>Web Development by <a href='http://sharperedge.net/' target='_blank' title='Sharper Edge International'>Sharper Edge International</a></span>";
	}
	
	$html .= '<a href="#" class="scroll-to-bottom"><i class="fa fa-arrow-down"></i><span>Scroll Down</span></a>';
	$html .= '<a href="#" class="back-to-top"><i class="fa fa-arrow-up"></i><span>Back To Top</span></a>';

	return $html;
}

function sei_social() {
	
	$social = "";
	$facebook   = genesis_get_option('twitter_url');
	$twitter    = genesis_get_option('facebook_url');
	$linkedin   = genesis_get_option('linkedin_url');
	$googleplus = genesis_get_option('googleplus_url');
	
	if(!empty($facebook)) {
		$social .="<li class='sei-social-facebook'><a href='".esc_url($facebook)."' title='Facebook' target='_blank' class='faa-parent animated-hover'><i class='fa fa-facebook'></i></a></li>";
	}
	
	if(!empty($twitter)) {
		$social .="<li class='sei-social-twitter'><a href='".esc_url($twitter)."' title='Twitter' target='_blank' class='faa-parent animated-hover'><i class='fa fa-twitter'></i></a></li>";
	}
	
	if(!empty($linkedin)) {
		$social .="<li class='sei-social-linkedin'><a href='".esc_url($linkedin)."' title='LinkedIn' target='_blank' class='faa-parent animated-hover'><i class='fa fa-linkedin'></i></a></li>";
	}
	
	if(!empty($googleplus)) {
		$social .="<li class='sei-social-googleplus'><a href='".esc_url($googleplus)."' title='Google+' target='_blank' class='faa-parent animated-hover'><i class='fa fa-google-plus'></i></a></li>";
	}
	
	return "<ul class='sei-social-links'>".$social."</ul>";
	
}

function sei_header($atts) {
	
	$phone_type = ( isset( $atts['phone_type'] ) ? $atts['phone_type'] : 'phone' );
?>	
	<div class="site-header-elements">
		<div class="col-xs-12 col-sm-4 col-md-4 align-left"><?php echo do_shortcode("[sei_get_logo]"); ?></div>
		<div class="col-xs-12 col-sm-4 col-md-4 text-center"><?php echo get_bloginfo ( 'description' ); ?></div>
		<div class="col-xs-12 col-sm-4 col-md-4 alignright"><?php echo do_shortcode("[sei_telnum_link label='header' type='".$phone_type."']"); ?></div>
	</div>
<?php
}

function sei_wrapper_func($atts, $content) {
	if( !is_front_page() ) {
		return trim( do_shortcode( '<div class="wrapper-dev '.( isset($atts['class']) ? $atts['class']: '' ).'"><div class="wrap">'.$content.'</div></div><div style="clear:both"></div>') );
	} else {
		return $content;
	}
}

function sei_make_bitly_url($url,$format = 'xml',$version = '2.0.1') {

	 //Set up account info
	 $bitly_login = 'o_tc72kt4co';
	 $bitly_api = 'R_fdc444c9cf2f418a8e4686212e71fed4';
	 
	 //create the URL
	 $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$bitly_login.'&apiKey='.$bitly_api.'&format='.$format;
	 
	 //get the url
	 $response = file_get_contents($bitly);

	 //parse depending on desired format
	 if(strtolower($format) == 'json')
	 {
		 $json = @json_decode($response,true);
		 return $json['results'][$url]['shortUrl'];
	 } else {
		 $xml = simplexml_load_string($response);
		 return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
	 }
}


function sei_tweetable( $atts, $content) {

	$output = '';
	$pageLink  = get_permalink();
	$short_url = sei_make_bitly_url($pageLink);

	$pull_quote_atts = shortcode_atts( array(
	  'dispay_quote' => '',
	  'hashtag' => '',
	  'author' => '',
	  'tweet' => '',
	  ), $atts );

	if(empty( $pull_quote_atts[ 'tweet' ] ) ) {
		$tweet_text =  strip_tags ( $content ); // remove html
		$display_text = $content ;
	} else {
		$tweet_text =  $pull_quote_atts[ 'tweet' ];
		$display_text = $content ;
	} 

	$twiURL  = 'https://twitter.com/intent/tweet?text='.urlencode( $tweet_text.' '.$short_url ); 
	$output .= '<div class="pullquote">';
	$output .=  '<p class="tweet-quote">'.$display_text.'</p>';
	$output .= '<a class="attribution" href="'.$twiURL.'"  target="_blank"><span><i class="fa fa-twitter" aria-hidden="true"></i>Click to tweet</span></a>';  
	$output .= '</div>';

	return $output;
}

/*Single Post Featured Image Display*/
function sei_entry_background() {
	if ( is_singular( 'post' ) )   { ?>
	    <div class="single-hero-container">
            <div class="gsps-outer">
                <div class="gsps-inner">
                    <div class="single-post-float-box">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $posttags = get_the_tags();
                        $thumbnail_id = get_post_thumbnail_id( $post->ID );
						$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);                   
                        $count=0;
                        if ($posttags) {
                          foreach($posttags as $tag) {
                            $count++;
                            if (1 == $count) {
							  echo '<div class="post-tag-cont"><div class="post-tag">';
                              echo $tag->name;
							  echo '</div></div>';
                            }
                          }
                        } ?>
						<?php
							ob_start();
							the_time(get_option('date_format'));
							$time = ob_get_clean();

							if ( has_post_thumbnail() ) {
								$thumb_id = get_post_thumbnail_id();
								$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
								$thumb_url = $thumb_url_array[0];
							} else {
								$thumb_url = genesis_get_option('blog_default_image');
								$alt = genesis_get_option('blog_default_alt_image');
							} 


						?>
                        <h1><?php the_title(); ?></h1>
                        <p>By: <?php the_author_posts_link(); ?> &nbsp;&nbsp;&bull;&nbsp;&nbsp; <?php echo $time; ?> </p>
                    </div>
				</div>
			</div>
		<?php endwhile; endif; ?>
		<?php
			echo '<div class="entry-background"><div class="full-featured-bg"><img class="original-featured-image" src="'.$thumb_url.'" alt="'.$alt.'"></div></div>';
		?>
		</div>
		<?php
	}
}

function sei_custom_favicon( $favicon_url ) {

	if( empty($favicon_url) ) {
		if( file_exists( get_stylesheet_directory().'/images/favicon/favicon.ico') ) {
		 	$favicon_url = get_stylesheet_directory_uri()."/images/favicon/favicon.ico";
		}
	}

	return $favicon_url;
	
}

function sei_favicon() {

	/**** You can generate favivon images here http://www.favicon-generator.org/ ****/
	
	if ( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-57x57.png') ) {
		?><link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-57x57.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-60x60.png') ) {
	?><link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-60x60.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-72x72.png') ) {
	?><link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-72x72.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-76x76.png') ) {
	?><link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-76x76.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-114x114.png') ) {
	?><link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-114x114.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-120x120.png') ) {
	?><link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-120x120.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-144x144.png') ) {
	?><link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-144x144.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-152x152.png') ) {
	?><link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-152x152.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/apple-icon-180x180.png') ) {
	?><link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-icon-180x180.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/android-icon-192x192.png') ) {
	?><link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/android-icon-192x192.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/favicon-32x32.png') ) {
	?><link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-32x32.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/favicon-96x96.png') ) {
	?><link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-96x96.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/favicon-16x16.png') ) {
	?><link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-16x16.png"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/favicon.ico') ) {
	?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon.ico" type="image/x-icon"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/favicon.ico') ) {
	?><link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon.ico" type="image/x-icon"><?php
	}
	
	if( file_exists( get_stylesheet_directory().'/images/favicon/manifest.json') ) {
	?><link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/manifest.json"><?php
	}
	
	
	?><meta name="msapplication-TileColor" content="#ffffff"><?php
	if( file_exists( get_stylesheet_directory().'/images/favicon/ms-icon-144x144.png') ) {
		?><meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/ms-icon-144x144.png"><?php
	}
	
	?><meta name="theme-color" content="#ffffff"><?php
}

function sei_remove_titles_all_single_posts() {
    if ( is_singular('post') ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}

function sei_editor_div($atts, $content = null) {
	extract( shortcode_atts( array('class' => null ), $atts) );
	return '<div class="'.$class.'">'.do_shortcode($content).'</div>';
}

function sei_editor_section($atts, $content = null) {
	extract( shortcode_atts( array('class' => null ), $atts) );
	return '<div class="section '.$class.'">'.do_shortcode($content).'</div>';
}

function sei_editor_block($atts, $content = null) {
	extract( shortcode_atts( array('class' => null ), $atts) );
	return '<div class="block '.$class.'">'.do_shortcode($content).'</div>';
}

function sei_editor_row($atts, $content = null) {
	extract( shortcode_atts( array('class' => null ), $atts) );
	return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
}

