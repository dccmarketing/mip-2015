<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Midwest Inland Port 2015
 */

global $mip_2015_themekit;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php

wp_head();

?></head>

<body <?php body_class(); ?>><?php

do_action( 'after_body' );

	?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mip-2015' ); ?></a>
	<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="wrap wrap-header">
			<div class="site-branding"><?php

			if ( is_front_page() && is_home() ) {

				?><h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'site_logo' ) ); ?>" class="site-logo" /></a></h1><?php

			} else {

				?><p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'site_logo' ) ); ?>" class="site-logo" /></a></p><?php

			}

			?></div><!-- .site-branding --><?php

		get_template_part( 'menus/menu', 'social' );

		?>
		</div><!-- .header_wrap -->
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'mip-2015' ); ?></button><?php

				wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );

		?></nav><!-- #site-navigation -->
	</header><!-- #masthead --><?php

	do_action( 'after_header' );

	?><div class="breadcrumbs">
		<div class="wrap-crumbs"><?php

			do_action( 'mip_2015_breadcrumbs' );

		?></div><!-- .wrap-crumbs -->
	</div><!-- .breadcrumbs -->
	<div id="content" class="site-content">
		<div class="wrap wrap-content">