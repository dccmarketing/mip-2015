<?php if ( has_nav_menu( 'multimodal' ) ) {

	$menu['theme_location']		= 'multimodal';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-multimodal';
	$menu['container_class'] 	= 'menu nav-multimodal';
	$menu['menu_id']         	= 'menu-multimodal-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 1;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

}