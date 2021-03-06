/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	wp.customize( 'label_resources', function( value ) {
		value.bind( function( to ) {
			$( '.download-now .text-calltoaction' ).text( to );
		} );
	} );

	wp.customize( 'label_contact_us', function( value ) {
		value.bind( function( to ) {
			$( '.contact-now .text-calltoaction' ).text( to );
		} );
	} );

	wp.customize( 'button_text_resources', function( value ) {
		value.bind( function( to ) {
			$( '.download-now .button-calltoaction' ).text( to );
		} );
	} );

	wp.customize( 'button_text_contact_us', function( value ) {
		value.bind( function( to ) {
			$( '.contact-now .button-calltoaction' ).text( to );
		} );
	} );

	wp.customize( 'footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.text-footer' ).text( to );
		} );
	} );

	wp.customize( 'footer_owner', function( value ) {
		value.bind( function( to ) {
			$( '.copyright a' ).text( to );
		} );
	} );

	wp.customize( 'footer_address', function( value ) {
		value.bind( function( to ) {
			$( '.address address' ).text( to );
		} );
	} );

	wp.customize( 'footer_phone', function( value ) {
		value.bind( function( to ) {
			$( '.phone a' ).text( to );
		} );
	} );


/*
	// Doesn't work instantly, works after you go out of the field
	wp.customize( 'url_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title a' ).attr( 'href', to );
		} );
	} );

	// Doesn't work instantly, works after you go out of the field
	wp.customize( 'email_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).text( to );
			//$( '.entry-title a' ).attr( 'href', 'mailto:'+to );
		} );
	} );

	wp.customize( 'date_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-date' ).text( to );
		} );
	} );

	wp.customize( 'checkbox_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-date' ).style.display( 'none' );
			if ( to ) {

			}
		} );
	} );


	wp.customize( 'color_field', function( value ) {
		value.bind( function( to ) {
			$( '.color_field' ).css( {
				'color': to,
			} );
		} );
	} );

	wp.customize( 'image_field', function( value ) {
		value.bind( function( to ) {
			$( '.image_field' ).css( {
				'color': to,
			} );
		} );
	} );
*/
} )( jQuery );
