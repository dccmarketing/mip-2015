<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.me/
 *
 * @package Midwest Inland Port 2015
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 *
 * @uses 	add_theme_support()
 */
function mip_2015_jetpack_setup() {

	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );

} // mip_2015_jetpack_setup()
add_action( 'after_setup_theme', 'mip_2015_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function mip_2015__infinite_scroll_render() {

	while ( have_posts() ) {

		the_post();
		get_template_part( 'template-parts/content', get_post_format() );

	}

} // mip_2015__infinite_scroll_render