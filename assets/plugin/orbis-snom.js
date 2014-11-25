jQuery( document ).ready( function( $ ) {
	var $snom = $( '#orbis-snom' );
	var $snomIframe = $( '#orbis-snom-iframe' );
	
	$snomIframe.load( function() {
		console.log( 'Loaded' );
	} );

	$( 'a[href^="tel:"]' ).click( function( e ) {
		var url = $( this ).attr( 'href' );
		
		var number = url.substring( 4 );

		var url = orbisSnom.commandUrl + '?' + 'number' + '=' + number;

		console.log( url );

		$snomIframe.attr( 'src', url );

		return false;
	} );
} );
