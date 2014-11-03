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

       // jQuery('#portfolio-click').css('height', jQuery(document).height() + 'px');
		jQuery('#portfolio-open').click(function(e){

			if (jQuery('#portfolio-container').hasClass('isopen')) {
				jQuery('#nav-contatos').css('display','block');
				jQuery('#portfolio-content').hide('slow');
				jQuery('html').css('overflow-y','scroll');
				jQuery('.overlay').css('display','none');
				//jQuery('#portfolio-content').css('height',jQuery(document).height() + 'px');
	
			}
		});

/*		jQuery(document).click(function (e){
        var container = jQuery("#portfolio-container");

        if (jQuery('#portfolio-container').hasClass('isopen') && !container.is(e.target) && container.has(e.target).length === 0){
				alert('triggeou aqui')
				jQuery('#portfolio-content').hide('slow');
				jQuery('html').css('overflow-y','scroll');
				jQuery('.overlay').css('display','none');
			    jQuery('#nav-contatos').css('display','block');
				//jQuery('#portfolio-content').css('height',jQuery(document).height() + 'px');
        }
});
*/


});
	jQuery(function($) {
		isopen = false;
		$(document).ready(function(){
			var containerHeight = parseInt($(window).outerHeight(), 10) + 'px';
			var containerWidth = parseInt($('#portfolio-container').outerWidth(), 10) + 'px';
			var tabWidth = parseInt($('#portfolio-open').outerWidth(), 10) + 'px';
			$('#portfolio-container').css('right','-'+containerWidth);
			$('#portfolio-container').css('height',containerHeight);
			$('#portfolio-open').css('left','-' + tabWidth);
			$('#portfolio-open').css('height',containerHeight);
	    });

        $('#portfolio-banner').on('click',function(e){
        	$('html, body').animate({ scrollTop: 0 }, 200, function(){
        		$('#portfolio-container').css('display','block');
        		$('#portfolio-banner').css('display','none');
        		$('#nav-contatos').css('display','none');
        		$('#portfolio-content').show('slow');
        		$('html').css('overflow-y','hidden');
        		$('.overlay').css('display','block');
        		$('#portfolio-container').addClass('isopen');
        	});
			//$('#portfolio-open').trigger('click');
			//$('#portfolio-open').trigger('click');
        });
        var closePortfolio = function(){
            var containerWidth = parseInt($('#portfolio-container').outerWidth(), 10) + 'px';
			$('html').css('overflow-y','scroll');
			$('.overlay').css('display','none');
		    $('#nav-contatos').css('display','block');
		    $('#portfolio-container').removeClass('isopen');

		    $('#portfolio-content').hide('slow', {start: function(){
		    	$('#portfolio-container').css('right','-'+containerWidth);
		    }}, function(){
		    	$('#portfolio-container').css('display','none');
		    	$('#portfolio-banner').css('display','block');
		    });
		   // $('#portfolio-container').animate({right:'-'+containerWidth}, duration: 400});
        }
        $(document).click(function (e){
        var container = $("#portfolio-container");
        var barra = $("#portfolio-banner");
        if (!container.is(e.target) && container.has(e.target).length === 0 && !barra.is(e.target) && barra.has(e.target).length === 0){
        	closePortfolio();
        }
        $('#portfolio-open').on('click',function(){
            closePortfolio();
        })
    });


	});