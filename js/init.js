$(document).ready(function() {
	$('.button-collapse').sideNav();
	$('select').material_select();
	var yesterday = new Date((new Date()).valueOf()-1000*60*60*24);
	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15, // Creates a dropdown of 15 years to control year
	    format: 'yyyy/mm/dd',
		disable: [
			{ from: [0,0,0], to: yesterday }
		]
	});
});
