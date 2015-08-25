<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Midwest Inland Port 2015
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header contentsingle"><?php

		the_title( '<h1 class="entry-title">', '</h1>' );

		?><div class="entry-meta"><?php

			mip_2015_posted_on();

		?></div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content"><?php

		the_content();

	?></div><!-- .entry-content -->

	<footer class="entry-footer"><?php

		mip_2015_entry_footer();

	?></footer><!-- .entry-footer -->
</article><!-- #post-## -->