jQuery( document ).ready( function( $ ) {
	var $snom         = $( '#orbis-snom' );
	var $snomIframe   = $( '#orbis-snom-iframe' );
	var $snomInput    = $( '#orbis-snom-input' );
	var snomValue     = '';

	$snomIframe.load( function() {
		
	} );

	$snom.find( 'button' ).click( function() {
		var key = $( this ).data( 'snom-key' );

		// snomValue = snomValue + key;

		var url = orbisSnom.commandUrl + '?' + 'key' + '=' + key;

		// $snomInput.val( snomValue );

		$snomIframe.attr( 'src', url );
	} );

	$( 'a[href^="tel:"]' ).click( function( e ) {
		var url = $( this ).attr( 'href' );
		
		var number = url.substring( 4 );

		snomValue = number;
		
		var url = orbisSnom.commandUrl + '?' + 'number' + '=' + number;

		$snomInput.val( snomValue );
		$snomIframe.attr( 'src', url );
	} );
} );
