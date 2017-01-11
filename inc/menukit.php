<?php

/**
 * A class of helpful menu-related functions
 *
 * @package Midwest Inland Port 2015
 * @author Slushman <chris@slushman.com>
 */
class mip_2015_Menukit {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->loader();

	} // __construct()

	/**
	 * Loads all filter and action calls
	 *
	 * @return 		void
	 */
	private function loader() {

		add_filter( 'walker_nav_menu_start_el', array( $this, 'menu_caret' ), 10, 4 );
		add_shortcode( 'listmenu', array( $this, 'list_menu' ) );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_menu_title_as_class' ), 10, 1 );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'add_icons_to_menu' ), 10, 4 );
		add_filter( 'mip-menu-item-link-classes', array( $this, 'add_coin_to_menu_item_classes' ), 10, 2 );
		add_filter( 'mip_menu_item_text_position', array( $this, 'get_text_position' ), 10, 3 );
		add_filter( 'mip_menu_item_icon_name', array( $this, 'get_icon_info' ), 10, 3 );
		add_filter( 'mip-menu-item-link-url', array( $this, 'add_utm_tags' ), 10, 3 );

	} // loader()

	/**
	 * Adds the 'coin' class to the menu item classes,
	 * if the text position is 'coin'.
	 *
	 * @param 		string 		$classes [description]
	 * @param [type] $textpos [description]
	 */
	public function add_coin_to_menu_item_classes( $classes, $textpos ) {

		if ( 'coin' !== $textpos ) { return $classes; }

		$classes[] = 'coin';

		return $classes;

	} // add_coin_to_menu_item_classes()

	/**
	 * Add an icon the menu item
	 *
	 * @exits 		If $args is empty.
	 * @exits 		If 'slushicons' is not in the classes array.
	 * @hooked 		walker_nav_menu_start_el 		10
	 * @link 		http://www.billerickson.net/customizing-wordpress-menus/
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 * @return 		string 							modified menu
	 */
	public function add_icons_to_menu( $item_output, $item, $depth, $args ) {

		if ( empty( $args ) ) { return $item_output; }
		if ( ! in_array( 'slushicons', $item->classes ) ) { return $item_output; }

		$atts 		= $this->get_attributes( $item );
		$icon_name 	= apply_filters( 'mip_menu_item_icon_name', '', $item, $args );
		$icon 		= $this->get_icon( $icon_name );
		$textpos 	= apply_filters( 'mip_menu_item_text_position', '', $item, $args );

		if ( empty( $icon_name ) && empty( $textpos ) ) { return $item_output; }

		$link_classes 	= apply_filters( 'mip-menu-item-link-classes', array( 'icon-menu' ), $textpos );
		$classes 		= implode( ' ', $link_classes );
		$url 			= apply_filters( 'mip-menu-item-link-url', $item->url, $item, $args );
		$item_title 	= apply_filters( 'mip-menu-item-title', $item->title, $item, $args );

		$output = '';
		$output .= '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $classes ) . '" ' . $atts . '>';

		if ( 'right' === $textpos ) {

			$output .= $icon;

		}

		if ( 'hide' === $textpos ) {

			$output .= '<span class="screen-reader-text">' . esc_html( $item_title ) . '</span>';
			$output .= $icon;

		} elseif ( 'coin' === $textpos ) {

			$output .= '<div class="front menu-icon">';
			$output .= $icon;
			$output .= '</div><div class="back menu-label"><span class="text">';
			$output .= esc_html( $item_title );
			$output .= '</span></div>';

		} else {

			$output .= '<span class="menu-label">' . esc_html( $item_title ) . '</span>';

		}

		if ( 'left' === $textpos ) {

			$output .= $icon;

		}

		$output .= '</a>';

		return $output;

	} // add_icons_to_menu()

	/**
	 * Adds the Menu Item Title as a class on the menu item
	 *
	 * @param 	object 		$menu_item 			A menu item object
	 */
	public function add_menu_title_as_class( $menu_item ) {

		$title = sanitize_title( $menu_item->title );

		if ( empty( $menu_item->classes ) || ! is_array( $menu_item->classes ) ) {

			$menu_item->classes[0] = $title;

		} elseif ( ! in_array( $title, $menu_item->classes ) ) {
			
			$menu_item->classes[] = $title;
			
		}

		return $menu_item;

	} // add_menu_title_as_class()

	/**
	 * Adds the appropriate UTM tag to the menu link.
	 *
	 * @param 		string 		$url 		The current menu item link URL.
	 * @param 		object 		$item 		The menu item object
	 * @param 		array 		$args 		The menu arguments.
	 * @return 		string 		$url 		The modified menu item link URL.
	 */
	public function add_utm_tags( $url, $item, $args ) {

		if ( empty( $item->classes ) ) { return $url; }
		if ( ! in_array( 'utm', $item->classes ) ) { return $url; }

		$return = '';

		foreach ( $item->classes as $class ) {

			if ( FALSE !== stripos( $class, 'utm-' ) ) {

				$medium 					= substr( $class, 4 );
				$query_args['utm_medium'] 	= urlencode( $medium );
				break;

			}

		}

		$query_args['utm_source'] 	= urlencode( 'homepage' );
		$query_args['utm_campaign'] = urlencode( 'header-icons' );
		$return 					= add_query_arg( $query_args, $url );

		return $return;

	} // add_utm_tags()

	/**
	 * Returns a string of HTML attributes for the menu item
	 *
	 * @exits 		If $item is empty.
	 * @param 		object 		$item 			The menu item object
	 * @return 		string 						A string of attributes
	 */
	public function get_attributes( $item ) {

		if ( empty( $item ) ) { return; }

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$attributes = '';

		foreach ( $atts as $attr => $value ) {

			if ( ! empty( $value ) ) {

				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';

			}

		}

		return $attributes;

	} // get_attributes()

	/**
	 * Returns the code for the icon.
	 *
	 * @exits 		If $icon is empty
	 * @exits 		if $icon is not an array.
	 * @param 		array 		$icon 			The icon info array.
	 * @return 		mixed 						The icon markup.
	 */
	private function get_icon( $icon ) {

		if ( empty( $icon ) || ! is_array( $icon ) ) { return; }

		$return = '';

		if ( 'dashicons' === $icon['type'] ) {

			$return = '<span class="dashicons dashicons-' . $icon['name'] . '"></span>';

		}

		if ( 'fontawesome' === $icon['type'] ) {

			$return = '<span class="fa fa-' . $icon['name'] . '"></span>';

		}

		if ( 'svg' === $icon['type'] ) {

			$check = mip_get_svg( $icon['name'] );

			if ( ! is_null( $check ) ) {

				$return = $check;

			}

		}

		return $return;

	} // get_icon()

	/**
	 * Returns an array of info about the icon.
	 *
	 * @exits 		If $classes is empty.
	 * @param 		string 		$icon 			The current icon name.
	 * @param 		object 		$item			The menu item object.
	 * @param 		array 		$args 			The menu arguments.
	 * @return 		array 						The type and name of the icon.
	 */
	public function get_icon_info( $icon, $item, $args  ) {

		if ( empty( $item->classes ) ) { return; }

		$return = array();
		$checks = array( 'dic-', 'fas-', 'svg-' );

		foreach ( $item->classes as $class ) {

			if ( stripos( $class, $checks[0] ) !== FALSE ) {

				$return['type'] = 'dashicons';
				$return['name'] = str_replace( $checks[0], '', $class );
				break;

			}

			if ( stripos( $class, $checks[1] ) !== FALSE ) {

				$return['type'] = 'fontawesome';
				$return['name'] = str_replace( $checks[1], '', $class );
				break;

			}

			if ( stripos( $class, $checks[2] ) !== FALSE ) {

				$return['type'] = 'svg';
				$return['name'] = str_replace( $checks[2], '', $class );
				break;

			}

		} // foreach

		return $return;

	} // get_icon_info()

	/**
	 * Returns the text position from the menu item class.
	 *
	 * @exits 		If $classes is empty.
	 * @param 		string 		$position 			The current text position.
	 * @param 		object 		$item				The menu item object.
	 * @param 		array 		$args 				The menu arguments.
	 * @return 		string 							The text position.
	 */
	public function get_text_position( $position, $item, $args ) {

		if ( empty( $item->classes ) ) { return; }

		if ( in_array( 'no-text', $item->classes ) ) { return 'hide'; }
		if ( in_array( 'text-left', $item->classes ) ) { return 'left'; }
		if ( in_array( 'text-right', $item->classes ) ) { return 'right'; }
		if ( in_array( 'text-coin', $item->classes ) ) { return 'coin'; }

		return;

	} // get_text_position()

	/**
	 * Returns a WordPress menu for a shortcode
	 *
	 * @param 	array 		$atts 			Shortcode attributes
	 * @param 	mixed 		$content 		The page content
	 * @return 	mixed 						A WordPress menu
	 */
	public function list_menu( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'menu'            => '',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 0,
			'walker'          => '',
			'theme_location'  => ''),
			$atts )
		);

		return wp_nav_menu( array(
			'menu'            => $menu,
			'container'       => $container,
			'container_class' => $container_class,
			'container_id'    => $container_id,
			'menu_class'      => $menu_class,
			'menu_id'         => $menu_id,
			'echo'            => false,
			'fallback_cb'     => $fallback_cb,
			'before'          => $before,
			'after'           => $after,
			'link_before'     => $link_before,
			'link_after'      => $link_after,
			'depth'           => $depth,
			'walker'          => $walker,
			'theme_location'  => $theme_location )
		);

	} // list_menu()

	/**
	 * Add Down Caret to Menus with Children
	 *
	 * @global 		 			$dcc_2015_themekit 			Themekit class
	 *
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 *
	 * @return 		string 							modified menu
	 */
	public function menu_caret( $item_output, $item, $depth, $args ) {

		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

		global $dcc_2015_themekit;

		$atts 	= $this->get_attributes( $item );
		$output = '';

		$output .= '<a href="' . $item->url . '">';
		$output .= $item->title;
		$output .= '<span class="show-hide">+</span>';
		$output .= '</a>';

		return $output;

	} // menu_caret()

} // class

/**
 * Make an instance so its ready to be used
 */
$mip_2015_menukit = new mip_2015_Menukit();
