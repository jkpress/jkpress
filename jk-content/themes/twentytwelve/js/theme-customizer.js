/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

( function( $ ) {
	// Site title and description.
	jk.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	jk.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	jk.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-title a, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// Hook into background color/image change and adjust body class value as needed.
	jk.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( ( '#ffffff' === to || '#fff' === to ) && 'none' === body.css( 'background-image' ) )
				body.addClass( 'custom-background-white' );
			else if ( '' === to && 'none' === body.css( 'background-image' ) )
				body.addClass( 'custom-background-empty' );
			else
				body.removeClass( 'custom-background-empty custom-background-white' );
		} );
	} );
	jk.customize( 'background_image', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( '' !== to ) {
				body.removeClass( 'custom-background-empty custom-background-white' );
			} else if ( 'rgb(255, 255, 255)' === body.css( 'background-color' ) ) {
				body.addClass( 'custom-background-white' );
			} else if ( 'rgb(230, 230, 230)' === body.css( 'background-color' ) && '' === jk.customize.instance( 'background_color' ).get() ) {
				body.addClass( 'custom-background-empty' );
			}
		} );
	} );
} )( jQuery );
