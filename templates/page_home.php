<?php
/**
 * Template Name: Home Page
 *
 * Description: A full-width template with no sidebar
 *
 * @package Midwest Inland Port 2015
 */

global $mip_2015_themekit;

get_header();

	?><div id="primary" class="content-area full-width">
		<main id="main" class="site-main" role="main"><?php

			$args['posts_per_page'] = 4;

			$news = $mip_2015_themekit->get_posts( 'post', $args, 'home' );

			if ( $news->have_posts() ) :

				?><div class="news-home">
					<h2 class="header-news"><?php esc_html_e( 'Announcements', 'mip-2015' ); ?></h2><?php

				while ( $news->have_posts() ) : $news->the_post();

					get_template_part( 'template-parts/content', 'homeexcerpt' );

				endwhile; // loop

				?></div><?php

				wp_reset_postdata();

			endif;

			if( have_posts() ) :

				?><div class="video-home"><?php

				while ( have_posts() ) : the_post();

					?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="page-content"><?php

							the_content();

						?></div><!-- .entry-content -->
					</article><!-- #post-## --><?php

				endwhile; // loop

				?></div><?php

			endif;

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();