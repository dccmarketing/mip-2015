<?php
/**
 * Template part for home page.
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
		<ul>
			<li>
				<a href="">
					<span class="text-calltoaction"><?php esc_html_e( 'Resources', 'mip-2015' ); ?></span>
					<span class="icon-calltoaction"><?php $mip_2015_themekit->the_svg( 'resources' ); ?></span>
					<span class="button-calltoaction"><?php esc_html_e( 'Download Now', 'mip-2015' ); ?></span>
				</a>
			</li>
			<li>
				<a href="">
					<span class="text-calltoaction"><?php esc_html_e( 'Contact', 'mip-2015' ); ?></span>
					<span class="icon-calltoaction"><?php $mip_2015_themekit->the_svg( 'email2' ); ?></span>
					<span class="button-calltoaction"><?php esc_html_e( 'Contact Us Now', 'mip-2015' ); ?></span>
				</a>
			</li>
		</ul>
	</div><?php

}