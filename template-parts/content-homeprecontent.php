<?php
/**
 * Template part for home page precontent section.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Midwest Inland Port 2015
 */

if ( is_front_page() ) {

	global $mip_2015_themekit;

	if ( function_exists( 'soliloquy' ) ) { soliloquy( 'home-page', 'slug' ); }

	get_template_part( 'menus/menu', 'multimodal' );

}