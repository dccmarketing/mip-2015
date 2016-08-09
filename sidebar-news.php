<?php
/**
 * The sidebar for the Sidebar Content page template
 *
 * @package Midwest Inland Port 2015
 */

if ( ! is_active_sidebar( 'sidebar-news' ) ) {
	return;
}
?><div id="secondary" class="widget-area sidebar-news" role="complementary"><?php

	dynamic_sidebar( 'sidebar-news' );

?></div><!-- #secondary -->