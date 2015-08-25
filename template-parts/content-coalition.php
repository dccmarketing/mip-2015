<?php
/**
 * Template part for the Coalition Partners logos
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Midwest Inland Port 2015
 */

global $mip_2015_themekit;

?><div class="wrap-partners">
	<h3><?php esc_html_e( 'Coalition Members', 'mip-2015' ); ?></h3>
	<ul><?php

	$data 	= get_theme_mod( 'partners_logos' );
	$logos 	= explode( ',', $data );

	foreach ( $logos as $logo ) {

		if ( empty( $logo ) ) { continue; }

		$id 	= $mip_2015_themekit->get_image_id( $logo );
		$image 	= wp_prepare_attachment_for_js( $id );

		//showme( $image );

		if ( isset( $image['sizes']['thumbnail']['url'] ) ) {

			$url = $image['sizes']['thumbnail']['url'];

		} else {

			$url = $image['sizes']['full']['url'];

		}

		?><li>
			<a href="<?php echo esc_url( site_url( '/why-midwest-inland-port/strategic-development-coalition/#' . $image['name']  ) ); ?>">
				<img alt="<?php echo esc_attr( $image['alt'] ); ?>" class="logo-partner" src="<?php echo esc_url( $url ); ?>" />
			</a>
		</li><?php

	} // foreach

	?></ul>
</div>