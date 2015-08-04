<?php

/**
 * A class of helpful theme functions
 *
 * @package DocBlock
 * @author Slushman <chris@slushman.com>
 */
class mip_2015_Themekit {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->loader();

	}

	/**
	 * Loads all filter and action calls
	 *
	 * @return [type] [description]
	 */
	private function loader() {

		add_action( 'init', array( $this, 'disable_emojis' ) );
		add_action( 'after_setup_theme', array( $this, 'more_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'more_scripts_and_styles' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'login_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_and_styles' ) );
		add_action( 'after_body', array( $this, 'analytics_code' ) );
		add_filter( 'post_mime_types', array( $this, 'add_mime_types' ) );
		add_filter( 'upload_mimes', array( $this, 'custom_upload_mimes' ) );
		add_filter( 'body_class', array( $this, 'page_body_classes' ) );
		//add_action( 'wp_head', array( $this, 'background_images' ) );
		add_action( 'wp_head', array( $this, 'add_favicons' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'excerpt_read_more' ) );
		add_filter( 'mce_buttons_2', array( $this, 'add_editor_buttons' ) );
		add_action( 'mip_2015_breadcrumbs', array( $this, 'breadcrumbs' ) );

		remove_action( 'wp_head', array( $this, 'print_emoji_detection_script', 7 ) );
		remove_action( 'admin_print_scripts', array( $this, 'print_emoji_detection_script' ) );

	} // loader()

	/**
	 * Additional theme setup
	 * @return 	void
	 */
	public function more_setup() {

		register_nav_menus( array(
			'social' => esc_html__( 'Social Links', 'mip-2015' )
		) );

		add_theme_support( 'yoast-seo-breadcrumbs' );

	} // more_setup()

	/**
	 * Enqueues scripts and styles for the admin
	 */
	public function admin_scripts_and_styles() {

		wp_enqueue_style( 'scriptname-admin', get_stylesheet_directory_uri() . '/admin.css' );

	} // admin_scripts_and_styles()

	/**
	 * Enqueues additional scripts and styles
	 *
	 * @return 	void
	 */
	public function more_scripts_and_styles() {

		wp_enqueue_style( 'dashicons' );
		// wp_enqueue_style( 'scriptname-fonts', fonts_url(), array(), null );

	} // more_scripts_and_styles()

	/**
	 * Enqueues scripts and styles for the login page
	 *
	 * @return 	void
	 */
	function login_scripts() {

		wp_enqueue_style( 'scriptname-login', get_stylesheet_directory_uri() . '/login.css', 10, 2 );

	} // login_scripts()




	/**
	 * Add core editor buttons that are disabled by default
	 */
	function add_editor_buttons( $buttons ) {

		$buttons[] = 'superscript';
		$buttons[] = 'subscript';

		return $buttons;

	} // add_editor_buttons()

	/**
	 * Creates links to all favicons
	 *
	 * PUT THEM IN A "FAVICONS" FOLDER AT THE ROOT!
	 *
	 * @link 	http://iconogen.com/
	 * @return 	mixed 			HTML for favicon links
	 */
	public function add_favicons() {

		?><link rel="shortcut icon" href="/favicons/favicon.ico" type="image/x-icon" />

		<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">

		<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicons/android-chrome-192x192.png" sizes="192x192">

		<meta name="msapplication-square70x70logo" content="/favicons/smalltile.png" />
		<meta name="msapplication-square150x150logo" content="/favicons/mediumtile.png" />
		<meta name="msapplication-wide310x150logo" content="/favicons/widetile.png" />
		<meta name="msapplication-square310x310logo" content="/favicons/largetile.png" /><?php

	} // add_favicons()

	/**
	 * Adds PDF as a filter for the Media Library
	 *
	 * @param 	array 		$post_mime_types 		The current MIME types
	 * @return 	array 								The modified MIME types
	 */
	public function add_mime_types( $post_mime_types ) {

	    $post_mime_types['application/pdf'] = array( esc_html__( 'PDFs', 'mip-2015' ), esc_html__( 'Manage PDFs', 'mip-2015' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
	    $post_mime_types['text/x-vcard'] = array( esc_html__( 'vCards', 'mip-2015' ), esc_html__( 'Manage vCards', 'mip-2015' ), _n_noop( 'vCard <span class="count">(%s)</span>', 'vCards <span class="count">(%s)</span>' ) );

	    return $post_mime_types;

	} // add_mime_types

	/**
	 * Inserts Google Tag manager code after body tag
	 * @return 	mixed 		The inserted Google Tag Manager code
	 */
	public function analytics_code() { ?>

		<!-- paste code here -->

	<?php } // analytics_code()

	/**
	 * Creates a style tag in the header with the background image
	 *
	 * @return 		void
	 */
	public function background_images() {

		$output = '';
		$image 	= get_thumbnail_url( get_the_ID(), 'full' );

		if ( ! $image ) {

			$image = get_theme_mod( 'default_bg_image' );

		}

		if ( ! empty( $image ) ) {

			$output .= '<style>';
			$output .= '@media screen and (min-width:768px){.site-header{background-image:url(' . $image . ');}';
			$output .= '</style>';

		}

		echo $output;

	} // background_images()

	/**
	 * Returns the appropriate breadcrumbs.
	 *
	 * @return 		mixed 				WooCommerce breadcrumbs, then Yoast breadcrumbs
	 */
	public function breadcrumbs() {

		$crumbs = '';

		if ( function_exists( 'woocommerce_breadcrumb' ) ) {

			$args['after'] 			= '</span>';
			$args['before'] 		= '<span rel="v:child" typeof="v:Breadcrumb">';
			$args['delimiter'] 		= '&nbsp;>&nbsp;';
			$args['home'] 			= esc_html_x( 'Home', 'breadcrumb', 'mip-2015' );
			$args['wrap_after'] 	= '</span></span></nav>';
			$args['wrap_before'] 	= '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">';

			$crumbs = woocommerce_breadcrumb( $args );

		} elseif( function_exists( 'yoast_breadcrumb' ) ) {

			$crumbs = yoast_breadcrumb();

		}

		return $crumbs;

	} // breadcrumbs()

	/**
	 * [custom_upload_mimes description]
	 * @param  array  $existing_mimes [description]
	 * @return [type]                 [description]
	 */
	public function custom_upload_mimes( $existing_mimes = array() ) {

		// add your extension to the array
		$existing_mimes['vcf'] = 'text/x-vcard';

		return $existing_mimes;

	} // custom_upload_mimes()

	/**
	 * Removes WordPress emoji support everywhere
	 */
	function disable_emojis() {

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	} // disable_emojis()

	/**
	 * Limits excerpt length
	 *
	 * @param 	int 		$length 			The current word length of the excerpt
	 * @return 	int 							The word length of the excerpt
	 */
	public function excerpt_length( $length ) {

		if ( is_home() || is_front_page() ) {

			return 30;

		}

		return $length;

	} // excerpt_length()

	/**
	 * Customizes the "Read More" text for excerpts
	 *
	 * @global   			$post 		The post object
	 * @param 	mixed 		$more 		The current "read more"
	 * @return 	mixed 					The modifed "read more"
	 */
	public function excerpt_read_more( $more ) {

		global $post;

		return '... <a class="moretag" href="'. get_permalink( $post->ID ) . '">Read more<span class="screen-reader-text"> about ' . $post->post_title . '</span></a>';

	} // excerpt_read_more()

	/**
	 * Properly encode a font URLs to enqueue a Google font
	 *
	 * @return 	mixed 		A properly formatted, translated URL for a Google font
	 */
	public function fonts_url() {

		$return 	= '';
		$families 	= '';
		$fonts[] 	= array( 'font' => 'Oxygen', 'weights' => '400,700', 'translate' => esc_html_x( 'on', 'Oxygen font: on or off', 'mip-2015' ) );

		foreach ( $fonts as $font ) {

			if ( 'off' == $font['translate'] ) { continue; }

			$families[] = $font['font'] . ':' . $font['weights'];

		}

		if ( ! empty( $families ) ) {

			$query_args['family'] 	= urlencode( implode( '|', $families ) );
			$query_args['subset'] 	= urlencode( 'latin,latin-ext' );
			$return 				= add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		}

		return $return;

	} // fonts_url()

	/**
	 * Returns an array of the featured image details
	 *
	 * @param 	int 	$postID 		The post ID
	 *
	 * @return 	array 					Array of info about the featured image
	 */
	public function get_featured_images( $postID ) {

		if ( empty( $postID ) ) { return FALSE; }

		$imageID = get_post_thumbnail_id( $postID );

		if ( empty( $imageID ) ) { return FALSE; }

		return wp_prepare_attachment_for_js( $imageID );

	} // get_featured_images()

	/**
	 * Returns a post object of the requested post type
	 *
	 * @param 	string 		$post 			The name of the post type
	 * @param   array 		$params 		Optional parameters
	 * @return 	object 		A post object
	 */
	public function get_posts( $post, $params = array(), $cache = '' ) {

		$return = '';
		$cache_name = 'posts';

		if ( ! empty( $cache ) ) {

			$cache_name = '' . $cache . '_posts';

		}

		$return = wp_cache_get( $cache_name, 'posts' );

		if ( false === $return ) {

			$args['post_type'] 				= $post;
			$args['post_status'] 			= 'publish';
			$args['order_by'] 				= 'date';
			$args['posts_per_page'] 		= 50;
			$args['no_found_rows']			= true;
			$args['update_post_meta_cache'] = false;
			$args['update_post_term_cache'] = false;

			if ( ! empty( $params ) ) {

				foreach ( $params as $key => $value ) {

					$args[$key] = $value;

				}

			}

			$query = new WP_Query( $args );

			if ( ! is_wp_error( $query ) && $query->have_posts() ) {

				wp_cache_set( $cache_name, $query, 'posts', 5 * MINUTE_IN_SECONDS );

				$return = $query;

			}

		}

		return $return;

	} // get_posts()

	/**
	 * Returns the requested SVG
	 *
	 * @param 	string 		$svg 		The name of the icon to return
	 * @param 	string 		$link 		URL to link from the SVG
	 *
	 * @return 	mixed 					The SVG code
	 */
	public function get_svg( $svg ) {

		$output = '';

		switch ( $svg ) {

			case 'caret-down' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="caret-down"><path d="M15 8l-4.03 6L7 8h8z"/></svg>'; break;
			case 'caret-left' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="caret-left"><path d="M13 14L7 9.97 13 6v8z"/></svg>'; break;
			case 'caret-right' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="caret-right"><path d="M8 6l6 4.03L8 14V6z"/></svg>'; break;
			case 'caret-up' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="caret-up"><path d="M7 13l4.03-6L15 13H7z"/></svg>'; break;
			case 'cart' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="cart"><path d="M6 13h9q.41 0 .705.295T16 14t-.295.705T15 15H5q-.41 0-.705-.295T4 14V4H2q-.41 0-.705-.295T1 3t.295-.705T2 2h3q.41 0 .705.295T6 3v2h13l-4 7H6v1zm-.5 3q.62 0 1.06.44T7 17.5t-.44 1.06T5.5 19t-1.06-.44T4 17.5t.44-1.06T5.5 16zm9 0q.62 0 1.06.44T16 17.5t-.44 1.06-1.06.44-1.06-.44T13 17.5t.44-1.06T14.5 16z"/></svg>'; break;
			case 'email' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="email"><path d="M19 14.5v-9q0-.62-.44-1.06T17.5 4H3.49q-.62 0-1.06.44T1.99 5.5v9q0 .62.44 1.06t1.06.44H17.5q.62 0 1.06-.44T19 14.5zm-1.31-9.11q.15.15.175.325t-.04.295-.165.22L13.6 9.95l3.9 4.06q.26.3.06.51-.09.11-.28.12t-.28-.07l-4.37-3.73-2.14 1.95-2.13-1.95-4.37 3.73q-.09.08-.28.07t-.28-.12q-.2-.21.06-.51l3.9-4.06-4.06-3.72q-.1-.1-.165-.22t-.04-.295.175-.325q.4-.4.95.07l6.24 5.04 6.25-5.04q.55-.47.95-.07z"/></svg>'; break;
			case 'facebook' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="facebook"><path d="M8.46 18h2.93v-7.3h2.45l.37-2.84h-2.82V6.04q0-.69.295-1.035T12.8 4.66h1.51V2.11Q13.36 2 12.12 2q-1.67 0-2.665.985T8.46 5.76v2.1H6v2.84h2.46V18z"/></svg>'; break;
			case 'facebooksquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="facebook"><path d="M2.89 2h14.23q.37 0 .625.255T18 2.88v14.24q0 .36-.255.62t-.625.26h-4.08v-6.2h2.08l.31-2.41h-2.39V7.85q0-.59.25-.885t.95-.295h1.28V4.51q-.66-.09-1.86-.09-1.42 0-2.265.835T10.55 7.61v1.78H8.46v2.41h2.09V18H2.89q-.37 0-.63-.26T2 17.12V2.88q0-.37.26-.625T2.89 2z"/></svg>'; break;
			case 'flickr' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="flickr"><path d="M19.8 3.9v12.2c0 2-1.6 3.7-3.7 3.7H3.9c-2 0-3.7-1.6-3.7-3.7V3.9C.2 1.9 1.8.2 3.9.2h12.2c2.1 0 3.7 1.6 3.7 3.7zM6.4 7.3c-1.5 0-2.7 1.2-2.7 2.7s1.2 2.7 2.7 2.7c1.5 0 2.7-1.2 2.7-2.7S7.9 7.3 6.4 7.3zm7.2 0c-1.5 0-2.7 1.2-2.7 2.7s1.2 2.7 2.7 2.7c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7z"/></svg>'; break;
			case 'gallery' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="gallery"><path d="M16 4h1.96q.43 0 .735.305T19 5.04v12.92q0 .43-.305.735T17.96 19H5.04q-.43 0-.735-.305T4 17.96V16H2.04q-.43 0-.735-.305T1 14.96V2.04q0-.43.305-.735T2.04 1h12.92q.43 0 .735.305T16 2.04V4zM3 14h11V3H3v11zm5-8.5q0-.62-.44-1.06T6.5 4t-1.06.44T5 5.5t.44 1.06T6.5 7t1.06-.44T8 5.5zm2 4.5q.02-.1.06-.28t.185-.7.305-.995.43-1.05.555-.99.67-.7T13 5v8H4V7q.56 0 .97.31t.6.75.3.88.12.75L6 10q.01-.04.025-.115t.08-.28.155-.395.255-.42.36-.395.49-.28T8 8q.47 0 .845.205t.58.5.345.59.19.505zm7 7V6h-1v8.96q0 .43-.305.735T14.96 16H6v1h11z"/></svg>'; break;
			case 'github' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="github"><path d="M19.8 16.1c0 2-1.6 3.7-3.7 3.7h-2.9c-.4 0-.8 0-.8-.6v-3.1c0-.9-.3-1.5-.7-1.8 2.2-.2 4.5-1.1 4.5-4.8 0-1.1-.4-2-1-2.6.1-.3.4-1.3-.1-2.6-.8-.3-2.7 1-2.7 1-.7-.3-1.6-.4-2.4-.4s-1.7.1-2.5.4c0 0-1.9-1.3-2.7-1-.5 1.3-.2 2.3 0 2.6-.6.7-1 1.6-1 2.6 0 3.8 2.3 4.6 4.5 4.8-.3.3-.5.7-.6 1.3-.6.3-2 .7-2.8-.8-.5-.9-1.5-1-1.5-1-1 0-.1.6-.1.6.6.3 1.1 1.4 1.1 1.4.4 1.8 3.2 1.2 3.2 1.2v2.2c0 .6-.4.6-.8.6H3.9c-2 0-3.7-1.6-3.7-3.7V3.9C.2 1.9 1.8.2 3.9.2h12.3c2 0 3.7 1.6 3.7 3.7v12.2h-.1z"/></svg>'; break;
			case 'googleplus' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="googleplus"><path d="M9.25 11.64q.88.62 1.23 1.28t.35 1.65q0 .62-.3 1.195t-.845 1.04-1.4.74-1.895.275q-1.26 0-2.31-.315t-1.685-.93-.635-1.405q0-1.28 1.3-2.265t3.14-.985q.14 0 .4-.005t.38-.005q-.61-.61-.61-1.26 0-.43.23-.86-.08.01-.22-.005t-.2-.015q-1.51 0-2.475-.97T2.74 6.43q0-.87.555-1.665t1.47-1.28T6.67 3h4.52l-1.01 1H8.74q.83.87 1.03 1.16.43.63.43 1.44 0 1.35-1.28 2.34-.53.42-.695.67t-.165.62q0 .28.395.705t.795.705zM6.83 9.37q.88.03 1.39-.76t.36-1.94q-.15-1.14-.87-1.95t-1.6-.84q-.88-.02-1.39.75t-.36 1.91q.15 1.15.875 1.98t1.595.85zM17 10v1h-2v2h-1v-2h-2v-1h2V8h1v2h2zM6.38 17.1q1.72 0 2.5-.635t.78-1.705q0-.22-.05-.47-.04-.16-.105-.295t-.18-.275-.205-.235-.28-.24-.295-.215-.365-.25-.38-.26q-.56-.18-1.12-.18-1.31-.02-2.3.685t-.99 1.665q0 1 .855 1.705t2.135.705z"/></svg>'; break;
			case 'hamburger' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="hamburger"><path d="M17 7V5H3v2h14zm0 4V9H3v2h14zm0 4v-2H3v2h14z"/></svg>'; break;
			case 'instagram' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="instagram"><path d="M19.9 17.3c0 1.4-1.1 2.5-2.5 2.5H2.7c-1.4 0-2.5-1.1-2.5-2.5V2.7C.2 1.3 1.3.2 2.7.2h14.7c1.4 0 2.5 1.1 2.5 2.5v14.6zm-2.3-8.8h-1.7c.2.5.3 1.1.3 1.7 0 3.3-2.7 5.9-6.1 5.9-3.4 0-6.1-2.7-6.1-5.9-.1-.6 0-1.2.1-1.7H2.3v8.3c0 .4.3.8.8.8h13.7c.4 0 .8-.3.8-.8V8.5zM10 6.1c-2.2 0-4 1.7-4 3.8 0 2.1 1.8 3.8 4 3.8s4-1.7 4-3.8c0-2.1-1.8-3.8-4-3.8zm7.6-2.9c0-.5-.4-.9-.9-.9h-2.2c-.5 0-.9.4-.9.9v2.1c0 .5.4.9.9.9h2.2c.5 0 .9-.4.9-.9V3.2z"/></svg>'; break;
			case 'linkedin' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="linkedin"><path d="M2.5 5C1 5 .1 4 .1 2.8.1 1.6 1.1.6 2.5.6c1.5 0 2.4 1 2.4 2.2C4.9 4 4 5 2.5 5zm2.1 14.4H.4V6.7h4.2v12.7zm15.3 0h-4.2v-6.8c0-1.7-.6-2.9-2.1-2.9-1.2 0-1.9.8-2.2 1.5-.1.3-.1.7-.1 1v7.1H6.9c.1-11.4 0-12.6 0-12.6h4.2v1.9c.6-.9 1.6-2.1 3.8-2.1 2.8 0 4.9 1.8 4.9 5.7v7.2z"/></svg>'; break;
			case 'linkedinsquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="linked-square"><path d="M19.9 16.2c0 2-1.7 3.7-3.7 3.7H3.8c-2 0-3.7-1.7-3.7-3.7V3.8C.1 1.8 1.8.1 3.8.1h12.3c2 0 3.7 1.7 3.7 3.7v12.4zM4.7 3.4C3.7 3.4 3 4.1 3 5c0 .8.6 1.5 1.6 1.5S6.3 5.8 6.3 5c0-.9-.6-1.6-1.6-1.6zm1.4 13.3v-9h-3v8.9h3zm10.7 0v-5.1c0-2.7-1.5-4-3.4-4-1.6 0-2.3.9-2.7 1.5V7.7h-3v8.9h3v-5c0-.3 0-.5.1-.7.2-.5.7-1.1 1.5-1.1 1.1 0 1.5.8 1.5 2v4.8h3z"/></svg>'; break;
			case 'menu' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="menu"><path d="M17 7V5H3v2h14zm0 4V9H3v2h14zm0 4v-2H3v2h14z"/></svg>'; break;
			case 'phone' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="phone"><path d="M12.06 6l-.21-.2q-.26-.27-.32-.47t.035-.38.365-.45l2.72-2.75q.11-.11.275-.285t.235-.245.19-.175.185-.12.17-.035.195.03.21.13.27.22l.21.2zm.53.45l4.4-4.4q.21.28.415.595t.47.78.45.95.31 1 .1 1.04-.215.975q-.33.76-.59 1.175t-.695.93-.715.895q-2.26 2.57-6 6.07-.41.29-.9.725t-.915.705-1.185.57q-.43.17-.95.18t-1.035-.125T4.53 18.2t-.97-.445-.8-.455-.62-.4l4.4-4.4 1.18 1.62q.16.23.485.165t.66-.285.655-.54l.925-.93 1.18-1.185 1.045-1.065.85-.89q.32-.32.535-.65t.29-.655-.165-.495zM1.57 16.5l-.21-.21q-.15-.16-.235-.28t-.095-.245-.01-.195.11-.21.17-.205.27-.265.31-.3l2.74-2.72q.41-.39.635-.425t.635.315l.2.21z"/></svg>'; break;
			case 'pinterest' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="pinterest"><path d="M10.5.1c3.7 0 7.1 2.6 7.1 6.5 0 3.7-1.9 7.8-6.1 7.8-1 0-2.2-.5-2.7-1.4-.9 3.6-.8 4.1-2.8 6.8l-.2.1-.1-.1c-.1-.7-.2-1.5-.2-2.2 0-2.4 1.1-5.9 1.7-8.3-.3-.6-.4-1.3-.4-2 0-1.2.8-2.7 2.2-2.7 1 0 1.5.8 1.5 1.7 0 1.5-1 3-1 4.5 0 1 .8 1.7 1.8 1.7 2.7 0 3.6-3.9 3.6-6 0-2.8-2-4.3-4.7-4.3C7 2.1 4.6 4.3 4.6 7.5c0 1.5.9 2.3.9 2.7 0 .3-.2 1.4-.6 1.4h-.2C3 11 2.4 8.8 2.4 7.2c0-4.4 4-7.1 8.1-7.1z"/></svg>'; break;
			case 'pinterestsquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="pinterest-square"><path d="M19.9 3.8v12.3c0 2-1.7 3.7-3.7 3.7H6.9c.4-.6 1.1-1.6 1.4-2.7 0 0 .1-.4.7-2.7.3.7 1.3 1.2 2.4 1.2 3.1 0 5.3-2.9 5.3-6.7 0-2.9-2.5-5.6-6.2-5.6-4.6 0-7 3.3-7 6.1 0 1.7.6 3.2 2 3.7.2.1.4 0 .5-.2 0-.2.1-.6.2-.8.1-.2 0-.3-.1-.5-.4-.5-.6-1.1-.6-1.9C5.5 7.2 7.4 5 10.3 5c2.6 0 4.1 1.6 4.1 3.7 0 2.8-1.2 5.2-3.1 5.2-1 0-1.8-.8-1.5-1.9.3-1.2.9-2.6.9-3.5 0-.8-.4-1.5-1.3-1.5-1 0-1.9 1.1-1.9 2.5 0 0 0 .9.3 1.6-1.1 4.5-1.3 5.3-1.3 5.3-.3 1.2-.2 2.6-.1 3.3H3.8C1.8 19.7.1 18 .1 16V3.8C.1 1.8 1.8.1 3.8.1h12.3c2.1 0 3.8 1.7 3.8 3.7z"/></svg>'; break;
			case 'reddit' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="reddit"><path d="M10 19.9C4.5 19.9.1 15.5.1 10S4.5.1 10 .1s9.9 4.4 9.9 9.9-4.4 9.9-9.9 9.9zm4.6-11.5c-.4 0-.7.2-.9.4-.9-.6-2.1-1-3.4-1.1l.7-3.1 2.2.5c0 .5.4 1 1 1s1-.5 1-1-.4-1-1-1c-.4 0-.7.2-.9.6l-2.4-.5c-.1 0-.2.1-.3.2l-.8 3.3c-1.4.1-2.6.4-3.4 1.1-.2-.3-.6-.4-1-.4-.7 0-1.3.6-1.3 1.3 0 .5.3 1 .7 1.2 0 .2-.1.4-.1.6 0 2.1 2.4 3.8 5.3 3.8s5.3-1.7 5.3-3.8c0-.2 0-.4-.1-.6.4-.2.7-.7.7-1.2 0-.8-.6-1.3-1.3-1.3zM7.8 12c-.6 0-1-.4-1-1s.4-1 1-1c.5 0 1 .4 1 1 0 .5-.4 1-1 1zm4.4 1.3c-.6.7-1.8.7-2.2.7s-1.6 0-2.2-.7c-.1-.1-.1-.2 0-.3.1-.1.2-.1.3 0 .4.4 1.3.5 1.9.5s1.5-.1 1.9-.5c.1-.1.2-.1.3 0 .1.1.1.2 0 .3zm0-1.3c-.5 0-1-.4-1-1s.4-1 1-1 1 .4 1 1c0 .5-.5 1-1 1z"/></svg>'; break;
			case 'search' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="search"><path d="M12.14 4.18q1.39 1.39 1.58 3.345t-.86 3.545q.03.03.155.14t.205.17q.34.27.81.59.62.43.66.47.61.45.94.78.49.49.84 1 .36.5.59 1.04.22.55.18 1-.03.48-.36.81t-.81.36q-.49.03-.99-.19-.52-.21-1.04-.59-.51-.35-1-.84-.33-.33-.77-.93-.02-.03-.47-.66-.32-.46-.56-.78-.24-.3-.44-.5-1.54.83-3.34.57t-3.1-1.55q-1.6-1.61-1.6-3.895t1.6-3.885q1.06-1.06 2.475-1.435t2.83 0T12.14 4.18zm-1.41 6.36q1.02-1.03 1.02-2.475T10.73 5.59Q9.7 4.56 8.25 4.56T5.78 5.59Q4.75 6.62 4.75 8.065t1.03 2.475q1.02 1.03 2.47 1.03t2.48-1.03z"/></svg>'; break;
			case 'slack' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="slack"><path d="M19.9 11c0 .8-.4 1.3-1.1 1.5l-2 .7.7 2c.1.2.1.4.1.6 0 .9-.8 1.7-1.7 1.7-.7 0-1.4-.5-1.7-1.2l-.7-2-3.7 1.3.7 1.9c.1.2.1.4.1.6 0 .9-.8 1.7-1.7 1.7-.7 0-1.4-.5-1.6-1.2l-.7-1.9-1.8.6c-.2.1-.4.1-.6.1-1 0-1.7-.7-1.7-1.7 0-.7.5-1.4 1.2-1.6l1.9-.6-1.4-3.7-1.9.6c-.2.1-.4.1-.6.1-1 0-1.7-.7-1.7-1.7 0-.7.5-1.4 1.2-1.6l1.9-.6-.6-1.9c0-.1-.1-.3-.1-.5 0-.9.8-1.7 1.7-1.7.7 0 1.4.5 1.6 1.2l.6 1.9L10 4.4l-.5-2c-.1-.2-.1-.4-.1-.6 0-.9.8-1.7 1.7-1.7.7 0 1.4.5 1.7 1.2l.6 1.9 1.9-.7c.2 0 .3-.1.5-.1.9 0 1.7.7 1.7 1.6 0 .7-.6 1.4-1.2 1.6l-1.9.6 1.2 3.8 1.9-.7c.2-.1.4-.1.5-.1 1.1.1 1.9.8 1.9 1.8zm-7.5.2l-1.2-3.7-3.7 1.2 1.2 3.7 3.7-1.2z"/></svg>'; break;
			case 'snapchat' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="snapchat"><path d="M71.9 43.8c.8-.2 1.7-.8 2.5-.8 1.3 0 2.7 0 3.8.5 1.9.9 2 3 .3 4.3-1.4 1-3.1 1.6-4.7 2.3-3.6 1.4-4.1 2.4-2.3 5.8 3 5.6 7.2 9.8 13.7 11.4.7.2 1.7.9 1.7 1.3-.1.9-.5 2.2-1.2 2.5-2.2 1-4.5 1.9-6.8 2.4-1.5.3-2 .8-2.3 2.2-.7 2.9-1.2 3.3-4 2.7-4.5-.9-8.4-.1-12.2 2.6-7.7 5.5-13.4 5.5-21 0-3.7-2.7-7.6-3.5-12-2.6-2.9.6-3.5.2-4.2-2.8-.3-1.2-.7-1.9-2.2-2.1-2.2-.4-4.4-1.1-6.5-2.1-.8-.4-1.5-1.7-1.6-2.7-.1-.4 1.3-1.3 2.2-1.5 6.9-1.9 11.2-6.6 14-12.9.7-1.5.1-2.5-1.1-3.2-1.1-.6-2.3-1-3.5-1.4-.7-.3-1.5-.6-2.2-1-1.4-.9-2.5-1.9-1.7-3.8.7-1.5 2.8-2.3 4.5-1.8 1 .3 1.9.7 2.9.9 1.3.3 2-.1 2-1.7-.1-3.6-.3-7.1 0-10.7.6-7.5 5-12.4 11.7-15 9.7-3.8 21.4-.9 26.6 8.5 1.8 3.3 2.1 6.9 2.3 10.5-.1 2.3-.3 4.6-.4 6.8-.3 1.4.5 1.7 1.7 1.4z"/></svg>'; break;
			case 'tumblr' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="tumblr"><path d="M15.7 18.7c-.4.5-2 1.1-3.4 1.2-4.3.1-5.9-3.1-5.9-5.3V8.1h-2V5.6c3-1.1 3.7-3.8 3.9-5.3 0-.1.1-.1.1-.1h2.9v5h4v3h-4v6.1c0 .8.3 2 1.9 1.9.5 0 1.2-.2 1.6-.3l.9 2.8z"/></svg>'; break;
			case 'twitter' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="twitter"><path d="M18.94 4.46q-.75 1.12-1.83 1.9.01.15.01.47 0 1.47-.43 2.945T15.38 12.6t-2.1 2.39-2.93 1.66-3.66.62q-3.04 0-5.63-1.65.48.05.88.05 2.55 0 4.55-1.57-1.19-.02-2.125-.73T3.07 11.55q.39.07.69.07.47 0 .96-.13-1.27-.26-2.105-1.27T1.78 7.89v-.04q.8.43 1.66.46-.75-.51-1.19-1.315T1.81 5.25q0-1 .5-1.84Q3.69 5.1 5.655 6.115T9.87 7.24q-.1-.45-.1-.84 0-1.51 1.075-2.585T13.44 2.74q1.6 0 2.68 1.16 1.26-.26 2.33-.89-.43 1.32-1.62 2.02 1.07-.11 2.11-.57z"/></svg>'; break;
			case 'twittersquare' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="twitter-square"><path d="M19.9 16.2c0 2-1.7 3.7-3.7 3.7H3.8c-2 0-3.7-1.7-3.7-3.7V3.8C.1 1.8 1.8.1 3.8.1h12.4c2 0 3.7 1.7 3.7 3.7v12.4zM15 6.8c.6-.3 1-.9 1.2-1.5-.5.3-1.1.5-1.7.7-.5-.5-1.2-.8-2-.8-1.5 0-2.7 1.2-2.7 2.7 0 .2 0 .4.1.6-2.3-.2-4.3-1.3-5.6-3-.2.4-.4.9-.4 1.4 0 .9.4 1.8 1.2 2.3-.4 0-.9-.2-1.3-.4 0 1.3 1 2.4 2.2 2.7-.2.1-.4.1-.7.1-.2 0-.3 0-.5-.1.3 1.1 1.3 1.9 2.5 1.9-.9.7-2.1 1.2-3.4 1.2h-.6c1.2.8 2.6 1.2 4.1 1.2 5 0 7.7-4.1 7.7-7.7v-.3c.5-.4 1-.9 1.4-1.4-.4.1-.9.3-1.5.4z"/></svg>'; break;
			case 'vimeosquare' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="vimeo-square"><path d="M19.9 16.2c0 2.1-1.7 3.7-3.7 3.7H3.8c-2.1 0-3.7-1.7-3.7-3.7V3.8C.1 1.8 1.8.1 3.8.1h12.4c2.1 0 3.7 1.7 3.7 3.7v12.4zM14.7 3.8c-2-.1-3.3 1.1-4 3.4.3-.2.7-.3 1-.3.7 0 1 .4 1 1.2 0 .5-.4 1.2-1 2.2-.6 1-1.1 1.4-1.4 1.4-.4 0-.7-.7-1.1-2.2 0-.4-.2-1.5-.5-3.2-.2-1.6-.9-2.4-2-2.3-.5 0-1.2.5-2.2 1.3-.6.6-1.3 1.2-2 1.8l.6.9c.6-.4 1-.7 1.1-.7.5 0 1 .8 1.4 2.3l1.2 4.2c.6 1.5 1.3 2.3 2.1 2.3 1.3 0 3-1.3 4.9-3.8 1.9-2.4 2.9-4.3 2.9-5.7.1-1.8-.6-2.7-2-2.8z"/></svg>'; break;
			case 'vine' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="vine"><path d="M18.7 12.3c-.8.2-1.7.3-2.4.3-1.7 3.5-4.6 6.5-5.6 7-.7.4-1.3.4-2 0-1.2-.8-5.8-4.6-7.4-16.5h3.4c.8 7.2 2.9 10.9 5.2 13.6 1.3-1.3 2.5-2.9 3.4-4.8-2.3-1.2-3.6-3.7-3.6-6.6 0-3 1.7-5.2 4.6-5.2 2.8 0 4.4 1.8 4.4 4.8 0 1.1-.2 2.4-.7 3.4 0 0-2.1.4-2.9-.9.2-.5.4-1.4.4-2.2 0-1.4-.5-2.1-1.3-2.1s-1.4.8-1.4 2.3c0 3 1.9 4.8 4.4 4.8.4 0 .9 0 1.4-.2v2.3z"/></svg>'; break;
			case 'wordpress' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="wordpress"><path d="M20 10q0-1.63-.505-3.155t-1.43-2.755-2.155-2.155-2.755-1.43T10 0 6.845.505 4.09 1.935 1.935 4.09.505 6.845 0 10t.505 3.155 1.43 2.755 2.155 2.155 2.755 1.43T10 20t3.155-.505 2.755-1.43 2.155-2.155 1.43-2.755T20 10zM10 1.01q1.83 0 3.495.71t2.87 1.915 1.915 2.87.71 3.495-.71 3.495-1.915 2.87-2.87 1.915-3.495.71-3.495-.71-2.87-1.915-1.915-2.87T1.01 10t.71-3.495 1.915-2.87 2.87-1.915T10 1.01zM8.01 14.82L4.96 6.61l1.05-.08q.2-.02.27-.275t-.025-.49-.305-.225q-1.29.1-2.13.1-.33 0-.52-.01Q4.4 3.97 6.17 3T10 2.03q1.54 0 2.935.55t2.475 1.54q-.52-.07-.985.305T13.96 5.54q0 .29.115.615t.225.525.37.61l.08.13q.5.87.5 2.21 0 .6-.315 1.72t-.635 1.94l-.32.82-2.71-7.5q.21-.01.4-.05t.27-.08l.08-.03q.2-.02.275-.295t-.025-.535-.3-.25q-1.3.11-2.14.11-.35 0-.875-.03L8.08 5.4l-.36-.03q-.2-.01-.3.255t-.025.54.275.285l.84.08 1.12 3.04zm6.02 2.15L16.64 10q.03-.07.07-.195t.15-.535.155-.82.08-1.05-.065-1.21q.94 1.7.94 3.81 0 2.19-1.065 4.05t-2.875 2.92zM2.68 6.77L6.5 17.25q-2.02-.99-3.245-2.945T2.03 10q0-1.79.65-3.23zm7.45 4.53l2.29 6.25q-1.17.42-2.42.42-1.03 0-2.06-.3z"/></svg>'; break;
			case 'youtube' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="youtube"><path d="M17.9 18c-.2.9-.9 1.5-1.8 1.6-2 .2-4.1.2-6.1.2s-4.1 0-6.1-.2c-.9-.1-1.6-.7-1.8-1.6-.3-1.2-.3-2.6-.3-3.9 0-1.3 0-2.6.3-3.9.2-.7.9-1.4 1.8-1.5 2-.2 4.1-.2 6.1-.2s4.1 0 6.1.2c.8.1 1.6.7 1.8 1.6.3 1.2.3 2.6.3 3.9 0 1.3-.1 2.6-.3 3.8zM6.5 11.4v-1H3.1v1h1.2v6.3h1.1v-6.3h1.1zM8.3.1L7 4.5v3H5.9v-3c-.1-.5-.4-1.3-.7-2.3-.3-.7-.5-1.4-.7-2.1h1.2L6.4 3 7.1.1h1.2zm1.2 17.6v-5.4h-1v4.2c-.2.3-.4.5-.6.5-.1 0-.2-.1-.2-.2v-4.4h-1v4.3c0 .4 0 .6.1.8.1.3.3.4.6.4.4 0 .7-.2 1.1-.7v.6h1zm1.7-12c0 .6-.1 1-.3 1.3-.3.4-.7.6-1.2.6-.4 0-.8-.2-1.1-.6-.2-.3-.3-.7-.3-1.3V3.8c0-.6.1-1 .3-1.3.3-.4.7-.6 1.2-.6s.9.2 1.2.6c.2.3.3.7.3 1.3v1.9zm-1-2.1c0-.5-.1-.8-.5-.8-.3 0-.5.3-.5.8v2.3c0 .5.2.8.5.8s.5-.3.5-.8V3.6zm3 10.3c0-.5 0-.9-.1-1.1-.1-.4-.4-.6-.8-.6s-.7.2-1 .6v-2.4h-1v7.3h1v-.5c.3.4.7.6 1 .6.4 0 .7-.2.8-.6.1-.2.1-.6.1-1.1v-2.2zm-1 2.3c0 .5-.1.7-.4.7-.2 0-.3-.1-.5-.2v-3.3c.2-.2.3-.2.5-.2.3 0 .4.3.4.7v2.3zm2.7-8.7h-1v-.6c-.4.5-.8.7-1.1.7-.3 0-.6-.1-.6-.4-.1-.2-.1-.4-.1-.8V2h1v4.4c0 .2.1.2.2.2.2 0 .4-.2.6-.5V2h1v5.5zm2 8.3h-1v.7c-.1.3-.2.4-.4.4-.3 0-.5-.3-.5-.8v-1h2V14c0-.6-.1-1-.3-1.3-.3-.4-.7-.6-1.2-.6s-.9.2-1.2.6c-.2.3-.3.8-.3 1.3v1.9c0 .6.1 1 .3 1.3.3.4.7.6 1.2.6s.9-.2 1.2-.6c.1-.2.2-.4.2-.6v-.8zm-.9-1.4h-1v-.5c0-.5.2-.7.5-.7s.5.3.5.7v.5z"/></svg>'; break;
			case 'youtubesquare'	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="youtube-square"><path d="M19.9 16.2c0 2-1.7 3.7-3.7 3.7H3.8c-2 0-3.7-1.7-3.7-3.7V3.8C.1 1.8 1.8.1 3.8.1h12.4c2 0 3.7 1.7 3.7 3.7v12.4zm-3.1-6c-.2-.8-.8-1.3-1.5-1.4-1.8-.2-3.5-.2-5.3-.2-1.8 0-3.5 0-5.3.2-.7.1-1.4.6-1.5 1.4-.2 1.1-.3 2.2-.3 3.3 0 1.1 0 2.3.3 3.3.2.7.8 1.3 1.5 1.4 1.8.2 3.5.2 5.3.2s3.5 0 5.3-.2c.7-.1 1.4-.6 1.5-1.4.3-1.1.3-2.3.3-3.3 0-1.1 0-2.3-.3-3.3zm-9.8.9H6v5.4H5v-5.4H4v-.9h3v.9zm1.5-9.8h-1l-.6 2.5-.7-2.5h-1l.6 1.8c.3.9.5 1.6.6 2v2.6h1V5.1l1.1-3.8zm1 15.3h-.8v-.5c-.3.4-.7.6-1 .6-.3 0-.5-.1-.5-.4-.1-.1-.1-.4-.1-.7v-3.7h.8v3.8c0 .1.1.2.2.2.2 0 .3-.1.5-.4v-3.6h.9v4.7zm1.6-12.1c0-.5-.1-.9-.3-1.1-.2-.3-.6-.5-1-.5s-.8.2-1 .5c-.2.2-.3.6-.3 1.1v1.7c0 .5.1.9.3 1.1.2.3.6.5 1 .5s.8-.2 1-.5c.2-.2.3-.6.3-1.1V4.5zm-.9 1.9c0 .4-.1.7-.4.7-.3-.1-.4-.3-.4-.7v-2c0-.4.1-.7.4-.7.3 0 .4.2.4.7v2zm2.6 8.8c0 .4 0 .7-.1.9-.1.4-.3.5-.7.5-.3 0-.6-.2-.9-.5v.5h-.9v-6.3h.9v2.1c.3-.3.6-.5.9-.5.3 0 .6.2.7.5.1.2.1.5.1 1v1.8zm-.9-2c0-.4-.1-.6-.4-.6-.1 0-.3.1-.4.2v2.9c.1.1.3.2.4.2.2 0 .4-.2.4-.6v-2.1zm2.4-5.5V3h-.9v3.6c-.2.3-.4.4-.5.4-.1 0-.2-.1-.2-.2V3h-.9v3.8c0 .3 0 .6.1.7.1.2.3.3.6.3s.6-.2 1-.6v.5h.8zm1.7 7.4v.6c0 .2-.1.4-.2.5-.2.3-.6.5-1 .5-.5 0-.8-.2-1-.5-.2-.2-.3-.6-.3-1.1v-1.7c0-.5.1-.9.3-1.1.2-.3.6-.5 1-.5s.8.2 1 .5c.2.2.3.6.3 1.1v1h-1.7v.8c0 .4.1.7.4.7.2 0 .3-.1.4-.3V15h.8v.1zm-.8-1.4v-.4c0-.4-.1-.7-.4-.7s-.4.2-.4.7v.4h.8z"/></svg>'; break;

			// Insert theme-specific SVGs
			case 'logo' 			: $output .= ''; break;

		} // switch

		if ( ! empty( $link ) ) {

			$output .= '</a>';

		}

		$output .= '</svg>';

		return $output;

		return $output;

	} // get_svg()

	/**
	 * Returns the URL of the featured image
	 *
	 * @param 	int 		$postID 		The post ID
	 * @param 	string 		$size 			The image size to return
	 *
	 * @return 	string | bool 				The URL of the featured image, otherwise FALSE
	 */
	public function get_thumbnail_url( $postID, $size = 'thumbnail' ) {

		if ( empty( $postID ) ) { return FALSE; }

		$thumb_id = get_post_thumbnail_id( $postID );

		if ( empty( $thumb_id ) ) { return FALSE; }

		$thumb_array = wp_get_attachment_image_src( $thumb_id, $size, true );

		if ( empty( $thumb_array ) ) { return FALSE; }

		return $thumb_array[0];

	} // get_thumbnail_url()

	/**
	 * Returns a Google Map link from an address
	 *
	 * @param 	string 		$address 		An address
	 * @return 	string 						URL for Google Maps
	 */
	public function make_map_link( $address ) {

		if( empty( $address ) ) { return FALSE; }

		$return = '';

		$query_args['q'] 	= urlencode( $address );
		$return 			= add_query_arg( $query_args, 'http://www.google.com/maps/' );

		return $return;

	} // make_map_link()

	/**
	 * Converts formatted phone numbers to just numbers for tel links
	 *
	 * @param 	string 		$number 			A formatted phone number
	 * @return 	string 							The number minus characters besides numbers
	 */
	public function make_number( $number ) {

		if ( empty( $number ) ) { return FALSE; }

		$return = '';

		$return = preg_replace( '/[^0-9]/', '', $number );

		return $return;

	} // make_number()

	/**
	 * Prints whatever in a nice, readable format
	 */
	public function pretty( $input ) {

		echo '<pre>'; print_r( $input ); echo '</pre>';

	} // pretty()

	/**
	 * Adds the name of the page or post to the body classes.
	 *
	 * @global 	$post						The $post object
	 * @param 	array 		$classes 		Classes for the body element.
	 * @return 	array 						The modified body class array
	 */
	public function page_body_classes( $classes ) {

		global $post;

		if ( empty( $post->post_content ) ) {

			$classes[] = 'content-none';

		} else {

			$classes[] = $post->post_name;

		}

		return $classes;

	} // page_body_classes()

	/**
	 * Reduce the length of a string by character count
	 *
	 * @param 	string 		$text 		The string to reduce
	 * @param 	int 		$limit 		Max amount of characters to allow
	 * @param 	string 		$after 		Text for after the limit
	 * @return 	string 					The possibly reduced string
	 */
	public function shorten_text( $text, $limit = 100, $after = '...' ) {

		$length = strlen( $text );
		$text 	= substr( $text, 0, $limit );

		if ( $length > $limit ) {

			$text = $text . $after;

		} // Ellipsis

		return $text;

	} // shorten_text()

	/**
	 * Echos the requested SVG
	 *
	 * @param 	string 		$svg 		The name of the icon to return
	 * @param 	string 		$link 		URL to link from the SVG
	 *
	 * @return 	mixed 					The SVG code
	 */
	public function the_svg( $svg, $link = '' ) {

		echo get_svg( $svg, $link = '' );

	} // the_svg()

	/**
	 * Returns an attachment by the filename
	 *
	 * @param  [type] $post_name [description]
	 * @return [type]            [description]
	 */
	function wp_get_attachment_by_post_name( $post_name ) {

		if ( empty( $post_name ) ) { return 'Post name is empty'; }

		$args['name'] 			= trim ( $post_name );
		$args['post_per_page'] 	= 1;
		$args['post_status'] 	= 'any';

		$posts = $this->get_posts( 'attachment', $args, $post_name . '_attachments' );

		if ( $posts->posts[0] ) {

			return $posts->posts[0];

		}

		return FALSE;

	} // wp_get_attachment_by_post_name()

} // class

/**
 * Make an instance so its ready to be used
 */
$mip_2015_themekit = new mip_2015_Themekit();

