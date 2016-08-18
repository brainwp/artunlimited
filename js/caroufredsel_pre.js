// JavaScript Document
jQuery(function() {
	jQuery('#carousel').carouFredSel({
	width: '100%',
    align: 'center',
    responsive: true,
    items: { width: "variable", visible: 2},
    scroll: { items: 1, pauseOnHover: true, duration: 1000, timeoutDuration: 3000 },
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
		direction: 'left',
		width: 'null', // automatically calculated
		height: 'null', // automatically calculated
		align: 'center',
		items: {
			visible: 1,
			start: 'random'
		}
	});
});
