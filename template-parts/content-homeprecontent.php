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

	putRevSlider( 'homepage' );

	get_template_part( 'menus/menu', 'multimodal' );

	?><div class="action-calls">
		<a class="single-call download-now" href="<?php echo esc_url( get_permalink( get_theme_mod( 'resources_page_field' ) ) ); ?>">
			<div class="text-calltoaction"><?php esc_html_e( get_theme_mod( 'label_resources' ), 'mip-2015' ); ?></div>
			<div class="icon-calltoaction"><?php $mip_2015_themekit->the_svg( 'resources' ); ?></div>
			<div class="button-calltoaction"><?php esc_html_e( get_theme_mod( 'button_text_resources' ), 'mip-2015' ); ?></div>
		</a>
		<a class="single-call contact-now" href="<?php echo esc_url( get_permalink( get_theme_mod( 'contact_us_page_field' ) ) ); ?>">
			<div class="text-calltoaction"><?php esc_html_e( get_theme_mod( 'label_contact_us' ), 'mip-2015' ); ?></div>
			<div class="icon-calltoaction"><?php $mip_2015_themekit->the_svg( 'contact' ); ?></div>
			<div class="button-calltoaction"><?php esc_html_e( get_theme_mod( 'button_text_contact_us' ), 'mip-2015' ); ?></div>
		</a>
	</div><?php

}