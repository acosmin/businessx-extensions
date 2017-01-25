/**
 * Sections JS
 */
;( function( $, window, document, undefined ) {

	// Selectors
	var
	$window        = $( window ),
	$body          = $( 'body' ),
	$document      = $( document );

	/**
	 * Map Section
	 */
	var $smo_div = $( '.sec-maps-overlay' );

	$document.on( 'touchend click', '.smo-open-map', function( event ) {
		event.preventDefault();
		$smo_div.fadeOut( 200 );
		$body.addClass('smo-opened');
	});

	$document.on( 'touchend click', 'body.smo-opened', function( event ) {
		event.preventDefault();
		$smo_div.fadeIn( 200 );
		$body.removeClass('smo-opened');
	});

})( jQuery, window, document );
