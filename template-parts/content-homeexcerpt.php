<?php
/**
 * Template part for displaying post excerpts on the homepage.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Midwest Inland Port 2015
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header justcontent"><?php

		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

	?></header><!-- .entry-header -->
	<div class="entry-content"><?php

			the_excerpt();

	?></div><!-- .entry-content -->
</article><!-- #post-## -->