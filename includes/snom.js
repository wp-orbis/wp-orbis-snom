jQuery(document).ready(function($) {
	$('a[href^="tel:"]').click(function() {
		alert('Telefoon link');
		
		return false;
	});
});