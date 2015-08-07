/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {

	var search, page, button;

	search = document.getElementById( 'mip-search' );
	if ( ! search ) { return; }

	page = document.getElementById( 'page' );
	if ( ! page ) { return; }

	button = document.getElementsByClassName( 'open-search' )[0];
	if ( ! button ) { return; }

	search.setAttribute( 'aria-hidden', 'true' );

	button.onclick = function() {

		event.preventDefault();

		if ( -1 !== search.className.indexOf( 'open' ) ) {

			search.className = search.className.replace( ' open', '' );
			search.setAttribute( 'aria-hidden', 'true' );

		} else {

			search.className += ' open';
			search.setAttribute( 'aria-hidden', 'false' );

		}

		if ( -1 !== page.className.indexOf( 'open' ) ) {

			page.className = page.className.replace( ' open', '' );

		} else {

			page.className += ' open';

		}

	};

} )();
