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
		    $('#portfolio-content').animate({opacity: "hide"}, {
		    	duration: "slow", start: function(){
		    		$('#portfolio-container').css('right','-'+containerWidth);
		    	}, complete: function(){
		    		$('#portfolio-container').css('display','none');
		    		$('#portfolio-banner').css('display','block');
		    	}}
		   );
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
        });
        $('.portfolio-ajax').on('click',function(e){
        	var data = {
        		'action': 'portfolio_query',
        		'area': $(this).attr('data-href')
		    };
		    $('#portfolio-ajax-container').fadeOut('slow');
		    $.post(portfolio.ajax_url, data, function(response) {
		    	$('#portfolio-ajax-container').html(response);
		    	$('#portfolio-ajax-container').fadeIn('slow');
		    });

        });
    });


	});
/*
 *
 * Sticky sidebar (sidebar que segue o conteudo)
 */
// Sticky Plugin v1.0.4 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 02/14/2011
// Date: 07/20/2015
// Website: http://stickyjs.com/
// Description: Makes an element on the page stick on the screen as you scroll
//              It will only set the 'top' and 'position' of your element, you
//              might need to adjust the width in some cases.

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    var slice = Array.prototype.slice; // save ref to original slice()
    var splice = Array.prototype.splice; // save ref to original slice()

  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: '',
      widthFromWrapper: true, // works only when .getWidthFrom is empty
      responsiveWidth: false,
      zIndex: 'inherit'
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0, l = sticked.length; i < l; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        //update height in case of dynamic content
        s.stickyWrapper.css('height', s.stickyElement.outerHeight());

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css({
                'width': '',
                'position': '',
                'top': '',
                'z-index': ''
              });
            s.stickyElement.parent().removeClass(s.className);
            s.stickyElement.trigger('sticky-end', [s]);
            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop !== newTop) {
            var newWidth;
            if (s.getWidthFrom) {
                padding =  s.stickyElement.innerWidth() - s.stickyElement.width();
                newWidth = $(s.getWidthFrom).width() - padding || null;
            } else if (s.widthFromWrapper) {
                newWidth = s.stickyWrapper.width();
            }
            if (newWidth == null) {
                newWidth = s.stickyElement.width();
            }
            s.stickyElement
              .css('width', newWidth)
              .css('position', 'fixed')
              .css('top', newTop)
              .css('z-index', s.zIndex);

            s.stickyElement.parent().addClass(s.className);

            if (s.currentTop === null) {
              s.stickyElement.trigger('sticky-start', [s]);
            } else {
              // sticky is started but it have to be repositioned
              s.stickyElement.trigger('sticky-update', [s]);
            }

            if (s.currentTop === s.topSpacing && s.currentTop > newTop || s.currentTop === null && newTop < s.topSpacing) {
              // just reached bottom || just started to stick but bottom is already reached
              s.stickyElement.trigger('sticky-bottom-reached', [s]);
            } else if(s.currentTop !== null && newTop === s.topSpacing && s.currentTop < newTop) {
              // sticky is started && sticked at topSpacing && overflowing from top just finished
              s.stickyElement.trigger('sticky-bottom-unreached', [s]);
            }

            s.currentTop = newTop;
          }

          // Check if sticky has reached end of container and stop sticking
          var stickyWrapperContainer = s.stickyWrapper.parent();
          var unstick = (s.stickyElement.offset().top + s.stickyElement.outerHeight() >= stickyWrapperContainer.offset().top + stickyWrapperContainer.outerHeight()) && (s.stickyElement.offset().top <= s.topSpacing);

          if( unstick ) {
            s.stickyElement
              .css('position', 'absolute')
              .css('top', '')
              .css('bottom', 0)
              .css('z-index', '');
          } else {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop)
              .css('bottom', '')
              .css('z-index', s.zIndex);
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();

      for (var i = 0, l = sticked.length; i < l; i++) {
        var s = sticked[i];
        var newWidth = null;
        if (s.getWidthFrom) {
            if (s.responsiveWidth) {
                newWidth = $(s.getWidthFrom).width();
            }
        } else if(s.widthFromWrapper) {
            newWidth = s.stickyWrapper.width();
        }
        if (newWidth != null) {
            s.stickyElement.css('width', newWidth);
        }
      }
    },
    methods = {
      init: function(options) {
        return this.each(function() {
          var o = $.extend({}, defaults, options);
          var stickyElement = $(this);

          var stickyId = stickyElement.attr('id');
          var wrapperId = stickyId ? stickyId + '-' + defaults.wrapperClassName : defaults.wrapperClassName;
          var wrapper = $('<div></div>')
            .attr('id', wrapperId)
            .addClass(o.wrapperClassName);

          stickyElement.wrapAll(function() {
            if ($(this).parent("#" + wrapperId).length == 0) {
                    return wrapper;
            }
});

          var stickyWrapper = stickyElement.parent();

          if (o.center) {
            stickyWrapper.css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") === "right") {
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          o.stickyElement = stickyElement;
          o.stickyWrapper = stickyWrapper;
          o.currentTop    = null;

          sticked.push(o);

          methods.setWrapperHeight(this);
          methods.setupChangeListeners(this);
        });
      },

      setWrapperHeight: function(stickyElement) {
        var element = $(stickyElement);
        var stickyWrapper = element.parent();
        if (stickyWrapper) {
          stickyWrapper.css('height', element.outerHeight());
        }
      },

      setupChangeListeners: function(stickyElement) {
        if (window.MutationObserver) {
          var mutationObserver = new window.MutationObserver(function(mutations) {
            if (mutations[0].addedNodes.length || mutations[0].removedNodes.length) {
              methods.setWrapperHeight(stickyElement);
            }
          });
          mutationObserver.observe(stickyElement, {subtree: true, childList: true});
        } else {
          if (window.addEventListener) {
            stickyElement.addEventListener('DOMNodeInserted', function() {
              methods.setWrapperHeight(stickyElement);
            }, false);
            stickyElement.addEventListener('DOMNodeRemoved', function() {
              methods.setWrapperHeight(stickyElement);
            }, false);
          } else if (window.attachEvent) {
            stickyElement.attachEvent('onDOMNodeInserted', function() {
              methods.setWrapperHeight(stickyElement);
            });
            stickyElement.attachEvent('onDOMNodeRemoved', function() {
              methods.setWrapperHeight(stickyElement);
            });
          }
        }
      },
      update: scroller,
      unstick: function(options) {
        return this.each(function() {
          var that = this;
          var unstickyElement = $(that);

          var removeIdx = -1;
          var i = sticked.length;
          while (i-- > 0) {
            if (sticked[i].stickyElement.get(0) === that) {
                splice.call(sticked,i,1);
                removeIdx = i;
            }
          }
          if(removeIdx !== -1) {
            unstickyElement.unwrap();
            unstickyElement
              .css({
                'width': '',
                'position': '',
                'top': '',
                'float': '',
                'z-index': ''
              })
            ;
          }
        });
      }
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };

  $.fn.unstick = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.unstick.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };
  $(function() {
    setTimeout(scroller, 0);
  });
}));

jQuery(function($) {
	$( '.fixed-sidebar' ).sticky();

	var menu_portfolio = function() {
		$( '.esquerda-single-portfolio h2' ).each( function(){
			if ( $( this ).has( 'span' ) ) {
				var name = $( this ).children( 'span' ).html();
			} else {
				var name = $( this ).html();
			}
			if ( ':' === name.substr( name.length - 1) ) {
				name = name.replace( ':', '' );
			}
			var id = name.replace(/\s/g,'');
			var html = '<li><a href="#' + id + '">' + name + '</a></li>';
			$( '#menu-items ul.sections' ).append( html );
		});
	}
	$( window ).load(function() {
		menu_portfolio();
	});
	$( document ).on( 'click', '#menu-items ul.sections li a', function(){
		var hash = $( this ).attr( 'href');
		$('html, body').animate({
			scrollTop: $( hash ).offset().top
		}, 400, function(){
			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		});

	})
} );
