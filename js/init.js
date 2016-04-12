(function($){
  $(function(){

    $('.button-collapse').sideNav();
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: true, // Creates a dropdown of 1 year to control year
		min: new Date(),
		max: new Date(new Date().setYear(new Date().getFullYear() + 1)),
		close: 'OK'
	});

  }); // end of document ready
})(jQuery); // end of jQuery name space