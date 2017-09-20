mw.loader.using( 'jquery.chosen' ).then( function() {
	if( $.fn.chosen ) {
		$( 'select' ).chosen( {no_results_text: "Oops, nothing found!"} );
	} else {
		console.log( 'No fancy selects :(' );
	}
} );