
// <a href="javascript:scroll_to('#nav-quem-somos');">Quem Somos</a>
function scroll_to (target) {
	jQuery('html, body').animate({
		scrollTop: jQuery(target).offset().top - 99
	}, 500);
}