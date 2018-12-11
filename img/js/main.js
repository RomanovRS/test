$(function() {		
	/*scroll*/
    jQuery(function() {
        jQuery('a.scroll-link').bind('click', function(event) {
            var $anchor = jQuery(this);
			
            jQuery('html, body').stop().animate({
                scrollTop: (jQuery($anchor.attr('href')).offset().top -5)
			}, 800, 'easeOutQuad');
            event.preventDefault();
        });
    });
	
	/*fancybox*/
	$(".fancybox").fancybox({padding: 0});
});