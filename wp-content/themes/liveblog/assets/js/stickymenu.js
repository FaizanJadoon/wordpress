jQuery(document).ready(function() {
	var stickyNavTop = jQuery('.main-header').offset().top;

	var stickyNav = function(){
		var scrollTop = jQuery(window).scrollTop(); 
		if (scrollTop > stickyNavTop + 150) { 
			jQuery('.main-menu').addClass('stickymenu');
		} else {
			jQuery('.main-menu').removeClass('stickymenu'); 
		}
	};

	stickyNav();

	jQuery(window).scroll(function() {
		stickyNav();
	});
});