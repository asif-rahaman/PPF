<?php
/**
 * This file adds the Home Page to the Exodus Theme.
 *
 * @author Maiden Miquiabas
 * @package Exodus
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'exodus_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function exodus_home_genesis_meta() {

	if ( is_active_sidebar( 'home-section-1' ) || is_active_sidebar( 'home-section-2' ) || is_active_sidebar( 'home-section-3' ) || is_active_sidebar( 'home-section-4' ) || is_active_sidebar( 'home-section-5' ) ) {


		//* Force full width content layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove primary navigation
		remove_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add homepage widgets
		add_action( 'genesis_loop', 'alvaira_homepage_widgets' );

	}
}


/*

 Wrapper Class for Homepage
 
 1. home-slider-section
 2. home-intro-section
 3. home-services-section
 4. home-testimonial-section
 5. home-contact-section
 6. home-latest-news-section
*/

//* Add markup for homepage widgets
function alvaira_homepage_widgets() {

	genesis_widget_area( 'home-section-1', array(
		'before' => '<div class=" home-section-1 widget-area home-slider-section"><div class="fullwidth">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'home-section-2', array(
		'before' => '<div class="paralax-border-effect"></div><div class="home-section-2 widget-area home-intro-section text-center"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'home-section-3', array(
		'before' => '<div class="paralax-border-effect"></div><div class="home-section-3 widget-area"><div class="fullwidth">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'home-section-4', array(
		'before' => '<div class="paralax-border-effect"></div><div class="home-section-4 widget-area home-testimonial-section"><div class="fullwidth">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'home-section-5', array(
		'before' => '<div class="home-even home-section-5 widget-area home-contact-section"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'home-section-6', array(
		'before' => '<div class="paralax-border-effect"></div><div class="home-odd home-section-6 widget-area home-latest-news-section"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

genesis();
