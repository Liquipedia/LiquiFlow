mw.loader.using('jquery.chosen', function() {
	if($.fn.chosen) {
		$('select').chosen({});
	} else {
		console.log('No fancy selects :(');
	}
});