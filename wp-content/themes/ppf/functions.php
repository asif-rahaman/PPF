<?php

$development = 1;

if($development){
	/* Display Errors on Development */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
} else {
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
}

//* Child theme Definitions
define( 'CHILD_THEME_NAME', __( 'Seibase', 'Seibase' ) );
define( 'CHILD_THEME_URL', 'http://sharperedge.net/' );
define( 'CHILD_THEME_VERSION', ( ( $development == 0 ) ? '1.0.2' : time() ) );
define( 'READ_MORE_TEXT', 'Find Out More' );

//* Load the Genesis core files
include_once( get_template_directory() . '/lib/init.php' );
include_once( 'lib/base_functions.php' );




add_image_size( 'thumbnails', 150, 150, true );
add_image_size( 'medium', 300, 'auto', true );
add_image_size( 'large', 650, 'auto', true );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'sei_enqueue_scripts_styles' );
function sei_enqueue_scripts_styles() {
	
	global $wp_scripts;
	
	wp_enqueue_script( 'libraries-js', get_stylesheet_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
	wp_enqueue_script( 'responsive-js', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), CHILD_THEME_VERSION );
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.js');
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom-scripts.js', array( 'jquery' ), CHILD_THEME_VERSION );
	

	$wp_scripts->add_data( 'modernizr', 'conditional', 'IE' );
	
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts','https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i' );
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/vendors/font-awesome/css/font-awesome.min.css', array(),  CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 70,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-section-1',
	'name'        => __( 'Home Section 1', 'parallax' ),
	'description' => __( 'This is the home section 1 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-2',
	'name'        => __( 'Home Section 2', 'parallax' ),
	'description' => __( 'This is the home section 2 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-3',
	'name'        => __( 'Home Section 3', 'parallax' ),
	'description' => __( 'This is the home section 3 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-4',
	'name'        => __( 'Home Section 4', 'parallax' ),
	'description' => __( 'This is the home section 4 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-5',
	'name'        => __( 'Home Section 5', 'parallax' ),
	'description' => __( 'This is the home section 5 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-6',
	'name'        => __( 'Home Section 6', 'parallax' ),
	'description' => __( 'This is the home section 6 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'parallax' ),
	'description' => __( 'This is the after entry widget area.', 'parallax' ),
) );

genesis_register_sidebar( array(
	'id'          => 'footer-entry-1',
	'name'        => __( 'Footer 1', 'parallax' ),
	'description' => __( 'This is the footer 1 widget  area.', 'parallax' ),
) );

genesis_register_sidebar( array(
	'id'          => 'footer-entry-2',
	'name'        => __( 'Footer 2', 'parallax' ),
	'description' => __( 'This is the footer 2 widget  area.', 'parallax' ),
) );


genesis_register_sidebar( array(
	'id'          => 'footer-entry-3',
	'name'        => __( 'Footer 3', 'parallax' ),
	'description' => __( 'This is the footer 3 widget  area.', 'parallax' ),
) );

//Site Header Customization

function sei_custom_header($atts) {
	
	$phone_type = ( isset( $atts['phone_type'] ) ? $atts['phone_type'] : 'phone' );
?>	
	<div class="site-header-elements">
		<div class="col-xs-12 col-sm-3 col-md-3 align-left"><?php echo do_shortcode("[sei_get_logo]"); ?></div>
		<div class="col-xs-12 col-sm-6 col-md-6 align-left site-banner-text mobile-display-none tablet-display-none">Tracey Chandler - <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uncovering The Most Exclusive Luxury Properties In Sydney</div>
		<div id="header-phone-container" class="col-xs-12 col-sm-6 col-md-3 alignright tablet-right"><?php echo do_shortcode("[sei_telnum_link label='header' type='".$phone_type."']"); ?>
			<a class="header-email" href="mailto:tracey@ppf-sydney.com.au">tracey@ppf-sydney.com.au</a>
		</div>
	</div>
<?php
}

//* Nav Menu Paralax Effect
function after_nav_paralax_effect(){
	echo '<div class="paralax-border-effect"></div>';
}
add_action('genesis_after_header','after_nav_paralax_effect' );


//Copyright_custom

function sei_custom_copyright_func($atts, $content) {

	$html = "<span class='copyright'>Copyright  &copy; ".date("Y")."  |  ".get_bloginfo('name');

	if( is_front_page() ) {
		$html .= "<span class='sei'>  |  Web Development by <a href='http://sharperedge.net/' target='_blank' title='Sharper Edge International'>Sharper Edge International</a></span>";
	}
	
	$html .="</span>";
	// $html .= '<a href="#" class="scroll-to-bottom"><i class="fa fa-arrow-down"></i><span>Scroll Down</span></a>';
	// $html .= '<a href="#" class="back-to-top"><i class="fa fa-arrow-up"></i><span>Back To Top</span></a>';

	return $html;
}

//Copyright-Footer
function add_sei_copyright(){
	echo "<div class='sei-copyright-container'>".do_shortcode('[sei_copyright]')."</div>";
}
add_action('genesis_footer','add_sei_copyright',30 );



/* ============================================ Start of Remove Actions ====================================================  */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
/* ============================================ End of Remove Actions ====================================================  */


/* ============================================ Start of Filter Actions ====================================================  */

add_filter('widget_text', 'do_shortcode');
add_filter('genesis_footer_output', 'sixteen_nine_custom_footer');
add_filter('get_the_content_more_link', 'custom_read_more_link');
add_filter('the_content_more_link', 'custom_read_more_link');
add_filter('genesis_term_meta_headline', 'be_default_category_title', 10, 2); 
add_filter('genesis_next_link_text' , 'sp_next_page_link');
add_filter('genesis_prev_link_text' , 'sp_previous_page_link');
add_filter('body_class', 'remove_a_body_class', 20, 2);
//add_filter('gform_submit_button', 'sei_form_submit_button', 10, 2);
add_filter('gform_confirmation_anchor', '__return_true');
add_filter('gform_field_content', 'gform_column_splits', 100, 5);
add_filter('genesis_post_meta', 'sp_post_meta_filter');
add_filter('genesis_theme_settings_defaults', 'sei_theme_options_defaults' );
add_filter('the_content', 'wpautop' , 12);
add_filter('genesis_pre_load_favicon', 'sei_custom_favicon' );
/* ============================================ End of Filter Actions ====================================================  */

/* ============================================ Start of Add Actions ====================================================  */

add_action('genesis_footer', 'sei_custom_footer');
add_action('genesis_entry_content', 'sei_blog_list_featured_image', 6);
add_action('genesis_before_content', 'sei_blog_list_title', 20 );
add_action('genesis_after_entry', 'sei_parallax_after_entry', 5 );
add_action('wp_head', 'sei_favicon',10 );
add_action('wp_head', 'sei_custom_inline_scripts');
add_action('genesis_entry_content', 'sei_blog_list_featured_image', 6);
add_action('genesis_theme_settings_metaboxes', 'sei_register_theme_settings_box');
add_action('genesis_settings_sanitizer_init', 'sei_register_social_sanitization_filters');
add_action('loop_start', 'sei_remove_titles_all_single_posts' );
add_action('sei_before_entry_content', 'sei_social_share', 20);
add_action('genesis_after_header', 'sei_entry_background' );
/* ============================================ End of Add Actions ====================================================  */

/* ============================================ Start of Custom Shortcodes ====================================================  */
add_shortcode('sei_get_logo', 'sei_get_logo_func');
add_shortcode('sei_telnum_link', 'sei_telnumber');
add_shortcode('sei_copyright', 'sei_custom_copyright_func');
add_shortcode('sei_social_links', 'sei_social');
add_shortcode('sei_custom_header', 'sei_custom_header');
add_shortcode('sei_tweetable', 'sei_tweetable');
add_shortcode('wrapper', 'sei_wrapper_func');
add_shortcode('div', 'sei_editor_div');
add_shortcode('row', 'sei_editor_row');
add_shortcode('section', 'sei_editor_section');
add_shortcode('block', 'sei_editor_block');

/* ============================================ End of Custom Shortcodes ====================================================  */