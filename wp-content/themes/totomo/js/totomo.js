jQuery( function ( $ ) {
	// Header search form click
	var $headerSearch = $( '.header-search' ),
		$body = $( 'body' );

	$headerSearch.find( '.search-toggler' ).click( function ( e ) {
		e.preventDefault();
		$headerSearch.toggleClass( 'active-search' );
	} );

	// Fitvids
	$body.fitVids();

	$('.carousel').carousel();
} );
