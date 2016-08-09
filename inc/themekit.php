<?php

/**
 * A class of helpful theme functions
 *
 * @package Midwest Inland Port 2015
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
		add_action( 'wp_head', array( $this, 'background_images' ) );
		add_action( 'wp_head', array( $this, 'add_favicons' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'excerpt_read_more' ) );
		add_filter( 'mce_buttons_2', array( $this, 'add_editor_buttons' ) );
		add_action( 'mip_2015_breadcrumbs', array( $this, 'breadcrumbs' ) );
		add_action( 'after_body', array( $this, 'add_hidden_search' ) );
		add_filter( 'get_search_form', array( $this, 'make_search_button_a_button' ) );
		add_action( 'after_header', array( $this, 'add_precontent' ) );
		add_filter( 'wpseo_breadcrumb_single_link', array( $this, 'unlink_private_pages' ), 10, 2 );
		add_filter( 'wp_seo_get_bc_title', array( $this, 'remove_private' ) );
		//add_filter( 'mip_2015_precontent_title', array( $this, 'precontent_title' ) );
		add_action( 'after_content', array( $this, 'add_home_slider' ), 10 );
		add_action( 'after_content', array( $this, 'add_coalition_partners' ), 20 );
		add_filter( 'embed_oembed_html', array( $this, 'youtube_add_id_attribute' ), 99, 4 );

	} // loader()

	/**
	 * Additional theme setup
	 * @return 	void
	 */
	public function more_setup() {

		register_nav_menus( array(
			'multimodal' => esc_html__( 'Multimodal Icons', 'mip-2015' ),
			'social' => esc_html__( 'Social Links', 'mip-2015' )
		) );

		add_theme_support( 'yoast-seo-breadcrumbs' );

	} // more_setup()

	/**
	 * Enqueues scripts and styles for the admin
	 */
	public function admin_scripts_and_styles() {

		wp_enqueue_style( 'mip-2015-admin', get_stylesheet_directory_uri() . '/admin.css' );

	} // admin_scripts_and_styles()

	/**
	 * Enqueues additional scripts and styles
	 *
	 * @return 	void
	 */
	public function more_scripts_and_styles() {

		wp_enqueue_style( 'dashicons' );
		// wp_enqueue_style( 'mip-2015-fonts', fonts_url(), array(), null );
		wp_enqueue_script( 'mip-2015-search', get_template_directory_uri() . '/js/hide-search.min.js', array(), '20150807', true );
		wp_enqueue_script( 'mip-2015-collapse', get_template_directory_uri() . '/js/collapse-submenus.min.js', array( 'jquery' ), '20150812', true );

		if ( is_front_page() ) {

			wp_enqueue_script( 'cycle2', get_template_directory_uri() . '/js/cycle2.min.js', array( 'jquery' ), '', true );

		}

	} // more_scripts_and_styles()

	/**
	 * Enqueues scripts and styles for the login page
	 *
	 * @return 	void
	 */
	function login_scripts() {

		wp_enqueue_style( 'mip-2015-login', get_stylesheet_directory_uri() . '/login.css', 10, 2 );

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
	 * Adds a testimonials slider just above the footer on the home page.
	 */
	public function add_home_slider() {

		if ( ! is_front_page() ) { return; }

		$testimonials = $this->get_posts( 'testimonial', array(), 'home-test' );

		//showme( $testimonials );

		?><div class="home-testimonials cycle-slideshow" data-cycle-timeout="10000" data-cycle-slides="> div"><?php

			foreach ( $testimonials->posts as $post ) {

				//showme( $post );

				$meta = get_post_custom( $post->ID );

				//showme( $meta );

				?><div class="slide">
					<blockquote class="testimonials-text" itemprop="reviewBody"><?php

						echo apply_filters( 'the_content', $post->post_content );

					?></blockquote>
					<cite class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
						<span itemprop="name"><?php

							if ( empty( $meta['_url'][0] ) ) {

								echo esc_html( $post->post_title );

							} else {

								?><a href="<?php

									echo esc_url( $meta['_url'][0] );

								?>"><?php

									echo esc_html( $post->post_title );

								?></a><?php

							}

						?></span>
						<span class="title" itemprop="jobTitle"><?php

							echo esc_html( $meta['_byline'][0] );

						?></span>
					</cite>
				</div><!-- .slide --><?php

			} // foreach

			?></div><?php

		/*

		// This is the static, single testimonial shown on the home page
		?><div class="home-testimonials"><?php

			//do_action( 'woothemes_testimonials', array( 'limit' => 1, 'order' => 'DESC', 'orderby' => 'date' ) );

		?></div><?php
		*/

	} // add_home_slider()

	/**
	 * Inserts the coalition partners links after the main content and before the footer.
	 */
	public function add_coalition_partners() {

		//if ( is_front_page() ) { return; }

		get_template_part( 'template-parts/content', 'coalition' );

	} // add_coalition_partners()

	/**
	 * Inserts content after the header and before the main content.
	 */
	public function add_precontent() {

		if ( is_front_page() ) {

			get_template_part( 'template-parts/content', 'homeprecontent' );

		} elseif ( ! is_front_page() || ! is_home() ) {

			get_template_part( 'template-parts/content', 'parentprecontent' );

		}

		get_template_part( 'template-parts/content', 'actioncalls' );

	} // add_precontent()

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

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5V4QS7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5V4QS7');</script>
<!-- End Google Tag Manager -->

	<?php } // analytics_code()

	/**
	 * Creates a style tag in the header with the background image
	 *
	 * @return 		void
	 */
	public function background_images() {

		$output = '';
		$image 	= $this->get_thumbnail_url( get_the_ID(), 'full' );

		if ( ! $image ) {

			$image = get_theme_mod( 'default_header' );

		}

		if ( ! empty( $image ) ) {

			$output .= '<style>';
			$output .= '@media screen and (min-width:768px){.header-page{background-image:url(' . $image . ');}';
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

		$return = sprintf( '... <a class="moretag read-more" href="%s">', esc_url( get_permalink( $post->ID ) ) );
		$return .= esc_html__( 'Read more', 'dcc-2015' );
		$return .= '<span class="screen-reader-text">';
		$return .= sprintf( esc_html__( ' about %s', 'dcc-2015' ), $post->post_title );
		$return .= '</span></a>';

		return $return;

	} // excerpt_read_more()

	/**
	 * Properly encode a font URLs to enqueue a Google font
	 *
	 * @return 	mixed 		A properly formatted, translated URL for a Google font
	 */
	public function fonts_url() {

		$return 	= '';
		$families 	= '';
		$fonts[] 	= array( 'font' => 'Montserrat', 'weights' => '400,700', 'translate' => esc_html_x( 'on', 'Montserrat font: on or off', 'mip-2015' ) );

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
	 * Returns the attachment ID from the file URL
	 *
	 * @link 	https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
	 * @param 	string 		$image_url 			The URL of the image
	 * @return 	int 							The image ID
	 */
	public function get_image_id( $image_url ) {

		if ( empty( $image_url ) ) { return FALSE; }

		global $wpdb;

		$attachment = $wpdb->get_col(
						$wpdb->prepare(
							"SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url
						)
					);

        return $attachment[0];

	} // get_image_id()

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

			$args 	= wp_parse_args( $params, $args );
			$query 	= new WP_Query( $args );

			if ( ! is_wp_error( $query ) && $query->have_posts() ) {

				wp_cache_set( $cache_name, $query, 'posts', 5 * MINUTE_IN_SECONDS );

				$return = $query;

			}

		}

		return $return;

	} // get_posts()

	/**
	 * Returns the URL for the posts page
	 *
	 * @return 		string 						The URL for the posts page
	 */
	public function get_posts_page() {

		if( get_option( 'show_on_front' ) == 'page' ) {

			return get_permalink( get_option( 'page_for_posts' ) );

		} else  {

			return bloginfo( 'url' );

		}

	} // get_posts_page()

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
	 * Converts a phone number into a tel link
	 *
	 * @param 	string 		$number 			A phone number
	 * @return 	mixed 							Formatted HTML telephone link
	 */
	public function make_phone_link( $number ) {

		if ( empty( $number ) ) { return FALSE; }

		$formatted 	= preg_replace( '/[^0-9]/', '', $number );

		return '<a href="tel:' . $formatted . '">' . $number . '</a>';

	} // make_phone_link()

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
	 * Changes the page title based
	 *
	 * @param 		mixed 		$title 			The current page title HTML
	 * @return 		mixed 						The modified page title HTML
	 */
	public function precontent_title( $title ) {

		$elders = get_post_ancestors( get_the_ID() );

		if ( 0 < count( $elders ) ) {

			$granny_id 	= $elders[ count( $elders ) - 1 ];
			$granny  	= get_post( $granny_id );
			$title 		= '<h1 class="page-title">' . $granny->post_title . '</h1>';

		}

		return $title;

	} // precontent_title()

	/**
	 * Removes the "Private" text from the private pages in the breadcrumbs
	 *
	 * @param 	string 		$text 			The breadcrumb text
	 * @return 	string 						The modified breadcrumb text
	 */
	public function remove_private( $text ) {

		$check = stripos( $text, 'Private: ' );

		if ( is_int( $check ) ) {

			$text = str_replace( 'Private: ', '', $text );

		}

		return $text;

	} // remove_private()

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
	 * Unlinks breadcrumbs that are private pages
	 *
	 * @param 	mixed 		$output 		The HTML output for the breadcrumb
	 * @param 	array 		$link 			Array of link info
	 * @return 	mixed 						The modified link output
	 */
	public function unlink_private_pages( $output, $link ) {

		$id 		= url_to_postid( $link['url'] );
		$options 	= WPSEO_Options::get_all();

		if ( $options['breadcrumbs-home'] !== $link['text'] && 0 === $id ) {

			$output = '<span rel="v:child" typeof="v:Breadcrumb">' . $link['text'] . '</span>';

		}

		return $output;

	} // unlink_private_pages()

	/**
	 * Returns an attachment by the filename
	 *
	 * @param  [type] $post_name [description]
	 * @return [type]            [description]
	 */
	public function wp_get_attachment_by_post_name( $post_name ) {

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

	/**
	 * Adds a hidden search field
	 *
	 * @return 		mixed 			The HTML markup for a search field
	 */
	public function add_hidden_search() {

		?><div aria-hidden="true" class="mip-search" id="mip-search">
			<div class="wrap"><?php

			get_search_form();

			?></div>
		</div><?php

	} // add_hidden_search()

	/**
	 * Converts the search input button to an HTML5 button element
	 *
	 * @param 		mixed  		$form 			The current form HTML
	 * @return 		mixed 						The modified form HTML
	 */
	public function make_search_button_a_button( $form ) {

		$form = '<form action="' . esc_url( home_url( '/' ) ) . '" class="search-form" method="get" role="search" >
				<label class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</label>
				<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />
				<button type="submit" class="search-submit">
					<span class="screen-reader-text">'. esc_attr_x( 'Search', 'submit button' ) .'</span>
					<span class="dashicons dashicons-search"></span>
				</button>
			</form>';

		return $form;

	} // make_search_button_a_button()

	/**
	 * Adds the video ID as the ID attribute on the iframe
	 *
	 * @param 		string 		$html 			The current oembed HTML
	 * @param 		string 		$url 			The oembed URL
	 * @param 		array 		$attr 			The oembed attributes
	 * @param 		int 		$post_id 		The post ID
	 * @return 		string 						The modified oembed HTML
	 */
	public function youtube_add_id_attribute( $html, $url, $attr, $post_id ) {

		$check = strpos( $url, 'youtu' );

		if ( ! $check ) { return $html; }

		if ( strpos( $url, 'watch?v=' ) > 0 ) {

			$id = explode( 'watch?v=', $url );

		} else {

			$id = explode( '.be/', $url );

		}

		$html = str_replace( 'allowfullscreen>', 'allowfullscreen id="video-' . $id[1] . '">', $html );

		return $html;

	} // youtube_add_id_attribute

} // class

/**
 * Make an instance so its ready to be used
 */
$mip_2015_themekit = new mip_2015_Themekit();

/**
 * Prints whatever in a nice, readable format
 */
function showme( $input ) {

	echo '<pre>'; print_r( $input ); echo '</pre>';

} // showme()
