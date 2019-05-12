(function($){
	
	"use strict";

	window.themeFrontCore = {
	
		/**
			Constructor
		**/
		initialize: function() {

			var self = this;

			$(document).ready(function(){
				self.build();
				self.events();
			});

		},
		/**
			Build page elements, plugins init
		**/
		build: function() {
			
			var self = this;
			
			// Setup body classes
			this.setupDocumentClasses();
			
			// page preloader
			this.initPreloader();
			
			// Add additional markup for form inputs
			this.wrapFormInputs();
			
			// load inline SVG
			this.loadSVG();
			
			// Headroom
			this.setupHeader();
			
			// Setup full height sections
			this.setupFullHeightSections();
			
			// Setup animations
			this.setupAnimations();
			
			// Setup parallax effect for sections
			this.setupParallax();
			
			// Setup parallax effect for sections
			this.setupVideoBG();
			
			// Create a slider
			this.setupSlider();
			
			// Setup hero sections
			this.setupHeroSections();
			
			// Setup menus
			this.setupMenu();
			
			// Setup post frmats
			this.setupPostFormats();
			
			// Setup carousels
			this.setupCarousels();
			
			// Setup tabs
			this.setupTabs();
			
			// Setup pricing tables
			this.setupPricing();
			
			// Setup footer
			this.setupFooter();
			
			// Setup one-page scrolling
			this.setupOnePage();
			
			// Go Top link
			this.setupGoTop();
			
			// Lazy YouTube videos
			this.setupVideos();
			
			// Portfolio Galleries
			this.setupPortfolio();
			
			// Init Lightbox
			this.setupLightbox();
			
			// Contact form sender
			this.bindContactForm();
			
		},
		/**
			Set page events
		**/
		events: function() {
			
			var self = this;

			// Re-init some sections of window resize
			$( window ).resize(function() {
				self.setupHeroSections();
				self.setupFooter();			
				self.setupFullHeightSections();	
			});

			// Skip intro
			$('#skip-intro').click( function() {
				$('html, body').animate({
					scrollTop: $("#content").offset().top - 80
				}, 800);
				return false;
			});

			// Comment reply link
			$('.reply-link').click( function() {
				$('html, body').animate({
					scrollTop: $("#comment-form").offset().top
				}, 2000);
				return false;
			});
			
			// Submit a form
			$('.form-builder-submit').each( function() {
				
				$(this).on('click', function() {
					$(this).parents('form').submit();
					return false;
				});
				
			});
			
		},
		/**************************************************************************************************************************************************/
		/** init preloader **/
		initPreloader: function() {
			
			var self = this;
			
			if( $('#preloader-inner').length ) {
		    $('#preloader-inner.ball-pulse').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-grid-pulse').html(self.createPreloaderDivs(9));
		    $('#preloader-inner.ball-clip-rotate').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.ball-clip-rotate-pulse').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.square-spin').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.ball-clip-rotate-multiple').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-pulse-rise').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.ball-rotate').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.cube-transition').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-zig-zag').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-zig-zag-deflect').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-triangle-path').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-scale').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.line-scale').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.line-scale-party').html(self.createPreloaderDivs(4));
		    $('#preloader-inner.ball-scale-multiple').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-pulse-sync').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-beat').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.line-scale-pulse-out').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.line-scale-pulse-out-rapid').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.ball-scale-ripple').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.ball-scale-ripple-multiple').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-spin-fade-loader').html(self.createPreloaderDivs(8));
		    $('#preloader-inner.line-spin-fade-loader').html(self.createPreloaderDivs(8));
		    $('#preloader-inner.triangle-skew-spin').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.pacman').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.ball-grid-beat').html(self.createPreloaderDivs(9));
		    $('#preloader-inner.semi-circle-spin').html(self.createPreloaderDivs(1));
			}
			
			// Close preloader
			$(window).load(function() {
				
				if( $('body.preloader').length ) {
					
					$('body').waitForImages({
						waitForAll: true,
						finished: function() {
							
							$('#preloader').fadeOut( 1200, function() {
								$('body.preloader').removeClass('preloader');
								$(this).remove();
							});
							
						}
					});
					
					if( $('.ie7, .ie8, .ie9, .ie10').length ) {
						$('#preloader').remove();
						$('body').removeClass('preloader');
					}
					
				}
			});
			
		},
		/** setup documents classes **/
		setupDocumentClasses: function() {
		
			$('html').removeClass('no-js');
			
			// Detect mobile browser
			if( (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) || (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.platform)) ) {
				$('html').addClass('mobile');
			}
			
			// Detect MAC
	    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Mac') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
	      $('html').addClass('mac');
	    }
			
			// Detect IE
			if (navigator.appName == "Microsoft Internet Explorer") {
    		var ie = true;
    		var ua = navigator.userAgent;
    		var re = new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
    		if (re.exec(ua) != null) {
    	    var ieVersion = parseInt(RegExp.$1);
        	$('html').addClass('ie' + ieVersion );
    		}
			} 
			
		},
		/** wrap inputs with additional markup **/
		wrapFormInputs: function() {
			
			var $inputs = $('input[type=text], input[type=number], input[type=password], input[type=email], input[type=search], input[type=tel], input[type=url], textarea, select').not('#wpl-theme-switcher-box select');
			
			$inputs.wrap('<div class="input-wrapper"></div>');
			
			$inputs.focus( function() {
				$(this).parents('.input-wrapper').addClass('hovered');
			});
			
			$inputs.focusout( function() {
				$(this).parents('.input-wrapper').removeClass('hovered');
			});
			
		},
		/** load inline SVG **/
		loadSVG: function() {
			
	    $('img.image-svg').each(function(){
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
    		var extension = imgURL.replace(/^.*\./, '');
    		extension = extension.toLowerCase();
    		
    		if( extension == 'svg' ) {
    		
	        $.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = $(data).find('svg');
    
            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
              $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
              $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            
            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
              $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
            }
    
            // Replace image with new SVG
            $img.replaceWith($svg);
	    
	        }, 'xml');
					
    		}
	    
	    });
			
		},
		/** sticky header **/
		setupHeader: function() {
			
			$(".fixed-header #header, .transparent-header #header").headroom({
			  "offset": 200,
			  "tolerance": 0,
			  "classes": {
			    "initial": "animated",
			    "pinned": "headroom--pinned",
			    "unpinned": "headroom--unpinned"
			  }
			});
			
		},
		/** home slider **/
		setupSlider: function() {
    	
    	$('.skip-slider').click( function() {
				$('html, body').animate({
					scrollTop: $(window).height()
				}, 800);
    		return false;
    	});
			
		},
		/** fix slider height **/
		setupFullHeightSections: function() {
			
			var windowHeight = $(window).height();
			$(".full-height").css('min-height', windowHeight + 'px' );
			
		},
		/** animations **/
		setupAnimations: function() {
			
		  var wow = new WOW({
				boxClass:     'wow',
				animateClass: 'animated',
				offset:       0,
				mobile:       true,
				live:         true,
				callback:     function(box) {
					
					var $box = $(box);
					
					if( $box.hasClass('animationNuminate') ) {
						$box.each( function() {
							var $item = $(this);
							var to = $item.data('to');
							
							$item.numinate({ format: '%counter%', from: 1, to: to, runningInterval: 2000, stepUnit: 5});
						});
					}
					
				}
			});
			
		  wow.init();
			
		},
		/** parallax effect for sections **/
		setupParallax: function() {
			
			$('.parallax-section').each( function() {
				$( this ).parallax({ zIndex: 10 });
			});
			
		},
		/** video backgrounds for sections **/
		setupVideoBG: function() {

			var self = this;
			
			$('.video-bg-section').each( function() {
				
				var videoId = $(this).data('video-id');
				var mute = self.stringToBoolean( $(this).data('video-mute') );
				var pauseOnScroll = self.stringToBoolean( $(this).data('video-pause-scroll') );
				
				$( this ).YTPlayer({
					videoId: videoId,
					mute: mute,
					pauseOnScroll: pauseOnScroll
				});
				
			});
			
		},
		/** hero sections **/
		setupHeroSections: function() {
			
			var $hero = $('#hero');
			
			if( $hero.length ) {
			
				var heroHeight = $hero.height(),
				$heroText = $hero.find('.intro-text'),
				heroTextHeight = $heroText.height();
				
				$heroText.css( 'margin-top', '-' + heroTextHeight / 2 + 'px' );
				
			}
			
		},
		/** mobile responsive header menu **/
		setupMenu: function() {
			
			// Mobile menu effects
			var $menu = $( '#header-nav' );
			$menu.dlmenu({
				'backLabel' : $menu.data('back-label')
			});
			
		},
		/** add some styles to post formats **/
		setupPostFormats: function() {
			
		  // Select first word of every paragraph in post format chat
		  $('.format-chat .post-excerpt p, .single #content article.format-chat p').each( function(){
		    var text_splited = $(this).text().split(" ");
		   $(this).html("<strong>"+text_splited.shift()+"</strong> "+text_splited.join(" "));
		  });
			
		},
		/** setup carousels **/
		setupCarousels: function() {
			
			var self = this;
			
			// Swiper carousel, news posts
			$('.news-carousel').swiper({
				loop: true,
				pagination: '.swiper-pagination',
				freeMode: true,
				spaceBetween: 30,
				slidesPerView: 'auto',
				paginationClickable: true
			});
			
			// Swiper carousel, screenshots
			$('.screenshots-carousel').swiper({
				loop: true,
				spaceBetween: 0,
				centeredSlides: true,
				slidesPerView: 'auto'
			});
			
			// OWL carousel
			$('.owl-carousel').owlCarousel({
		    items: 1,
		    navigation: true,
		    navigationText: ['', ''],
		    singleItem: true,
		    autoHeight: true,
		    transitionStyle: 'fade',
		    direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr'
			});
			
			setInterval(function(){
			 $(".owl-carousel").each( function(){
			    $(this).data('owlCarousel').updateVars();
			 });
			},1500);
			
			// Team members carousel
			$('.shortcode-team-members').each( function() {
				
				self.preloadImages([ $(this).find('div.item:first').data('bg') ]);
				
				var carouselID = $(this).attr('id');
				
				$(this).parents('.fw-main-row:first').css('background-image', 'url(' + $(this).find('div.item:first').data('bg') + ')').css('transition', '0.3s');
				
				var teamCarousel = $(this).find('.items').owlCarousel({
			    items: 1,
			    singleItem: true,
			    transitionStyle: 'fade',
			    direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
			    afterAction: function( carousel ) {
			    	
			    	var newBg = carousel.find('.item').eq( this.owl.currentItem ).data('bg'),
						$parentSection = carousel.parents('.fw-main-row:first').css('background-image', 'url(' + newBg + ')');
			    	
						$('#'+ carouselID +' .team-pagination a').removeClass('current');
						$('#'+ carouselID +' .team-pagination a').eq( this.owl.currentItem ).addClass('current');
	
			    }
				}).data('owlCarousel');
				
				// Team carousel custom pagination
				$('#'+ carouselID +' .team-pagination a').click( function() {
					
					var slideNum = $('#'+ carouselID +' .team-pagination a').index( $(this) );
					teamCarousel.goTo( slideNum );
					
					return false;
				});
			});
			
		},
		/** tabs script **/
		setupTabs: function() {
			
			$('.services').each( function() {
				
				var $tabs = $(this);
				var $pagination = $tabs.next('.services-pagination').find('.tab-link');
				
				$pagination.click( function() {
					
					var target = $(this).attr('href');
					var $target = $( target );
					$tabs.find('.service-item').hide().removeClass('selected');
					
					var bgImg = $target.data('image');
					
					$target.fadeIn(300, function() {
						$target.addClass('selected');
						
						$('html, body').animate({
							scrollTop: $target.offset().top - 20
						}, 800);
						
					});
					
					$pagination.removeClass('selected');
					
					$(this).addClass('selected');
					
					return false;
				});
				
			});
			
		},
		/** setup pricing tables **/
		setupPricing: function() {
			
			$('ul.pricing-table > li:first').addClass('first');
			$('ul.pricing-table > li:last').addClass('last');
			
		},
		/** setup footer **/
		setupFooter: function() {
			
			var self = this;
			
			if( $( window ).width() < 992 ) {
				$('div.section').last().css('margin-bottom', '0px');
			} else {
				
				if( $('body').hasClass('parallax-footer') && $( window ).width() >= 992 ) {
					var $footer = $('#footer');
					
					$footer.waitForImages({
						waitForAll: true,
						finished: function() {
							
							$('#content-wrapper').css( 'margin-bottom', $footer.height() + 'px' );
							
						}
					});	
					
				}
				
			}
			
		},
		/** setup one-page scroller **/
		setupOnePage: function() {
			
			var self = this;
			
			// One-page navigation
			if( $('body.one-page').length ) {
			
				var scrollOffset = $('#header-nav').data('scroll-offset'),
				scrollSpeed = $('#header-nav').data('scroll-speed'),
				scrollEasing = $('#header-nav').data('scroll-easing');
				
				scrollEasing = scrollEasing == '' ? 'easeOutBack' : scrollEasing;
			
				$('body.one-page #header-menu').singlePageNav({
					currentClass: 'current-link',
					updateHash: true,
					offset: scrollOffset,
					speed: scrollSpeed,
					filter: ':not(.external)',
					easing: scrollEasing
				});
				
			}
			
		},
		/** go top link **/
		setupGoTop: function() {
			
			if( $('body').hasClass('go-top') ) {
			
			  $.scrollUp({
			    scrollName: 'scrollUp',
			    topDistance: '1000',
			    topSpeed: 100,
			    animation: 'slide', // Fade, slide, none
			    animationInSpeed: 500, // Animation in speed (ms)
			    animationOutSpeed: 500, // Animation out speed (ms)
			    scrollText: '', // Text for element
			    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
			  });
				
			}
			
		},
		/** lazy YouTube videos **/
		setupVideos: function() {
			
			var $videos = $('.lazy-video');
			
			$videos.each( function() {
				$(this).lazyYT();
			});
			
			$('body.single article.format-video iframe').each( function() {
				$(this).parents('p').addClass('responsive-video-contaner');
			});
			
		},
		/** Portfolio galleries **/
		setupPortfolio: function() {
			
			var self = this;
			
			$('.portfolio').each( function() {
				
				var $portfolio = $(this),
				$galleryElem = $portfolio.find('.portfolio-gallery'),
				rowH = $galleryElem.data('row-height'),
				rowMH = $galleryElem.data('row-min-height');
				
				var gallery = $galleryElem.justifiedGallery({
					sizeRangeSuffixes: {},
					rowHeight: rowH,
					maxRowHeight: rowMH,
					margins: 0,
					captionSettings: {
						visibleOpacity: 0.9,
						animationDuration: 300,
						nonVisibleOpacity: 0.0
					},
					captions: true
				});
				
				$portfolio.find('.portfolio-header .filters a').bind( 'click touchstart', function() {

					$portfolio.find('.portfolio-header .filters a').removeClass('selected');
					
					$(this).addClass('selected');
					
					var filterClass = $(this).data('filter');
					
					$galleryElem.justifiedGallery({
						'filter': filterClass
					});
					
					return false;
				});
				
				$portfolio.find('.portfolio-load-more').on('click', function() {
					var $link = $(this);
					var loader = $link.find('i.icon');
					var data = $link.data();
					
					$.ajax({
						url: wprotoEngineVars.ajaxurl,
						type: "POST",
						dataType : 'json',
						data: {
							'action' : 'load_more_portfolio_posts',
							'data' : data,
							'type' : 'json'
						},
						beforeSend: function() {
							loader.addClass('rotating');
						},
						success: function( response ) {
							loader.removeClass('rotating');
							
							if( response.answer == 'add' ) {
								$galleryElem.append( response.html );
								$galleryElem.justifiedGallery('norewind');
								$link.data('nextpage', response.next_page );
								self.setupLightbox();
							}
							
							if( self.stringToBoolean( response.hide_more ) ) {
								$link.remove();
							}
							
						}
					});
					
					return false;
				});
				
			});
			
		},
		/** setup LightBox **/
		setupLightbox: function() {
			
			$('body.single article.format-image img').each( function() {
				$(this).parents('a').addClass('lightbox');
			});
			
			// init lightbox
			if( $('.lightbox').length ) {
				$('.lightbox').nivoLightbox({
					effect: 'fadeScale'
				});				
			}
			
		},
		/** send a contact form **/
		bindContactForm: function() {
			
			if( window.fwForm ) {
			
		    fwForm.initAjaxSubmit({
	        selector: 'form.fw_form_fw_form'
		    });
				
			}
			
		},
		/**************************************************************************************************************************
			Utils
		**************************************************************************************************************************/
		/**
			Check email address
		**/
		isValidEmailAddress: function( emailAddress ) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
 			return pattern.test( emailAddress );
		},
		preloadImages: function(arrayOfImages) {
	    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
	    });
		},
		createPreloaderDivs: function( n ) {
      var arr = [];
      var i = 0;
      for (i = 1; i <= n; i++) {
        arr.push('<div></div>');
      }
      return arr;
		},
		stringToBoolean: function(string){
			
			switch(string){
				case "true": case "yes": case "1": return true;
				case "false": case "no": case "0": case null: return false;
				default: return Boolean(string);
			}
		},

	}

	window.themeFrontCore.initialize();

})( window.jQuery );