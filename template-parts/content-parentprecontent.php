<?php
/**
 * Template part for parent pages, pre-content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Midwest Inland Port 2015
 */

if ( ! is_front_page() || ! is_home() ) {

	?><div class="header-page"><?php

/*
		?><header class="page-header contentpage"><?php

			echo apply_filters( 'mip_2015_precontent_title', the_title( '<h1 class="page-title">', '</h1>', FALSE ) );

		?></header><?php
*/
	?></div><?php

}