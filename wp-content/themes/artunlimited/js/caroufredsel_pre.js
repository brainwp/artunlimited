// JavaScript Document
jQuery(function() {
	jQuery('#carousel').carouFredSel({
	width: "100%",
    align: 'center',
    responsive: true,
    items: {visible: 3, minimum: 2, start: -1},
    scroll: { items: 1, pauseOnHover: true, duration: 1000, timeoutDuration: 3000 ,onBefore: function(){
            jQuery('ul#carousel li')
                .animate({opacity:0.5}, 250);
        },
        onAfter: function(){
            jQuery('ul#carousel li')
                .filter(':eq(1)')
                .animate({opacity:1}, 250);
        }
    },
    auto: { play: true },
	prev: '#prev2',
	next: '#next2',
    swipe: true
});
	
	
		jQuery('#foo3').carouFredSel({
		prev: '#prev3',
		next: '#next3',
		auto: {
			play: false,
		},
		circular: true,
		infinite: true,
		responsive: true,
		direction: "left",
		width: null, // automatically calculated
		//height: null, // automatically calculated
		align: "center",
		items: {
			visible: 1,
			start: "random"
		}
	});
});
