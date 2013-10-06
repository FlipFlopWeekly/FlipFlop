$(document).ready(function() {
	$('#nav li').hover(function() {
		// show its submenu
		$('ul', this).stop(true, true).slideDown(100);
	}, function() {
		// hide its submenu
		$('ul', this).stop(true, true).slideUp(100);
	});
});