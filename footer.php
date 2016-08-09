<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Midwest Inland Port 2015
 */

global $mip_2015_themekit;

		?></div><!-- .wrap -->
	</div><!-- #content --><?php

	do_action( 'after_content' );

	?><footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrap wrap-footer">
			<div class="text-footer"><?php echo get_theme_mod( 'footer_text' ); ?></div>
			<div class="logo-limitless"><a href="<?php echo esc_url( 'http://decaturcitylimitless.com' ); ?>"><?php mip_the_svg( 'limitless' ); ?></a></div>
			<div class="site-info">
				<ul>
					<li class="copyright">&copy <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( get_admin_url(), 'mip-2015' ); ?>"><?php echo get_theme_mod( 'footer_owner' ); ?></a></li>
					<li class="address"><address><?php echo get_theme_mod( 'footer_address' ); ?></address></li>
				</ul>
				<ul>
					<li class="phone"><?php echo $mip_2015_themekit->make_phone_link( get_theme_mod( 'footer_phone' ) ); ?></li>
					<li class="email"><a href="<?php echo esc_url( '/contact-us' ); ?>"><?php esc_html_e( 'Email Us', 'mip-2015' ); ?></a></li>
					<li class="privacy"><a href="<?php echo esc_url( '/privacy-policy' ); ?>"><?php esc_html_e( 'Privacy Policy', 'mip-2015' ); ?></a></li>
				</ul>
			</div><!-- .site-info -->
		</div><!-- .wrap-footer -->
	</footer><!-- #colophon -->
</div><!-- #page --><?php

wp_footer();

?></body>
</html>
