/*jQuery(function($){	
	var el_width = $('#portfolio-container').width();
	console.log(el_width);
	$('#portfolio-container').attr('style','right:-'+el_width + 'px');

	$('#portfolio-click').on('click',function(e){
		var el_width = $('#portfolio-container').width();
		var show = $(this).attr('data-show');
		if(show == 'false'){
			//$('#portfolio-content').show('slow');
			$( "#portfolio-container" ).animate({
				right: '0',
			}, 500, function() {
			// Animation complete.
		    });
			//$('.slide-out-div').addClass('active');
			$(this).attr('data-show','true');
		}
		else{
			//$('#portfolio-content').show('slow');
			$( "#portfolio-container" ).animate({
				right: '-'+ el_width,
			}, 500, function() {
			// Animation complete.
		    });
			//$('#portfolio-content').hide('slow');
			$('.slide-out-div').removeClass('active');
			$(this).attr('data-show','false');
		}
	})
});*/
	jQuery(function() {
		var s = {'mouseWheelSpeed':30};

		if (jQuery('.scroll-pane').length)
			jQuery('.scroll-pane').jScrollPane(s);
		if (jQuery('.scroll-panes').length)
			jQuery('.scroll-panes').jScrollPane(s);	

	});

    jQuery.fn.toggleText = function(a,b) {
	    return this.html(this.html().replace(new RegExp("("+a+"|"+b+")"),function(x){return(x==a)?b:a;}));
	}

	jQuery(document).ready(function(){
	    jQuery('.tgl').before('<span class="link-tgl">Acesso Restrito</span>');
	    jQuery('.tgl').css('display', 'none')
	    jQuery('span', '#link-login').click(function() {
	        jQuery(this).next().slideToggle('slow')
                .siblings('.tgl:visible')
                .slideToggle('fast');
            // aqui começa o funcionamento do plugin
	        jQuery(this).toggleText('Acesso Restrito','Fechar')
	            .siblings('span').next('.tgl:visible').prev()
	            .toggleText('Acesso Restrito','Fechar')
	    });

        jQuery(function(){
             jQuery ('.slide-out-div').tabSlideOut({
                 tabHandle: '.handle',                              //class of the element that will be your tab
                 imageHeight: jQuery(document).height() + 'px',                               //height of tab image
                 imageWidth: '50px',                               //width of tab image    
                 tabLocation: 'right',                               //side of screen where tab lives, top, right, bottom, or left
                 speed: 400,                                        //speed of animation
                 action: 'click',                                   //options: 'click' or 'hover', action to trigger animation
                 topPos: '0px',                                   //position from the top
                 fixedPosition: false                               //options: true makes it stick(fixed position) on scroll
             });
         });


		jQuery('.barra-portfolio').click(function(e){

			if (jQuery('#portfolio-container').hasClass('open')) {
				jQuery('#portfolio-content').hide('slow');
				//jQuery('html').css('overflow-y','scroll');
				jQuery('.overlay').css('display','none');
				jQuery('#portfolio-content').css('height',jQuery(document).height() + 'px');
	
			} else {
				jQuery('#portfolio-content').show('slow');
				//jQuery('html').css('overflow-y','hidden');
				jQuery('.overlay').css('display','block');

			}
		});

		jQuery(document).click(function (e){
        var container = jQuery("#portfolio-container");

        if (jQuery('#portfolio-container').hasClass('open') && !container.is(e.target) && container.has(e.target).length === 0){
				jQuery('#portfolio-content').hide('slow');
				//jQuery('html').css('overflow-y','scroll');
				jQuery('.overlay').css('display','none');
				jQuery('#portfolio-content').css('height',jQuery(document).height() + 'px');
        }
});



});
