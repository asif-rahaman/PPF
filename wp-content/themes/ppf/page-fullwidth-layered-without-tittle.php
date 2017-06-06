<?php
/**
 * Template Name: Full Width Without Tittle Page
 *
 * @package WordPress
 * @subpackage Genesis Theme
 * @since SEIBASE 1.0
 */

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


// //* Remove wpautop
// remove_filter( 'the_content', 'wpautop',12 );
// remove_filter( 'the_excerpt', 'wpautop',12 );

genesis();