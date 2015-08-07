<?php

$menu['theme_location']	= 'primary';
$menu['walker']			= new Submenu_Walker();

wp_nav_menu( $menu );