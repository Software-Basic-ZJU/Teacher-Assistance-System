jQuery(document).ready(function($){
	//create the slider
	$('.cd-testimonials-wrapper').flexslider({
		selector: ".cd-testimonials > li",
		animation: "slide",
		controlNav: false,
		slideshow: false,
		smoothHeight: true,
		start: function(){
			$('.cd-testimonials').children('li').css({
				'opacity': 1,
				'position': 'relative'
			});
		}
	});

	//open the testimonials modal page
	$('.cd-see-all').on('click', function(){
		$('.cd-testimonials-all').addClass('is-visible');
	});

	//close the testimonials modal page
	$('.cd-testimonials-all .close-btn').on('click', function(){
		$('.cd-testimonials-all').removeClass('is-visible');
	});
	$(document).keyup(function(event){
		//check if user has pressed 'Esc'
    	if(event.which=='27'){
    		$('.cd-testimonials-all').removeClass('is-visible');	
	    }
    });
    
	//build the grid for the testimonials modal page
	$('.cd-testimonials-all-wrapper').children('ul').masonry({
  		itemSelector: '.cd-testimonials-item'
	});
});

(function () {

	'use strict';

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var fullHeight = function() {

		if ( !isMobile.any() ) {
			$('.js-fullheight').css('height', $(window).height() - $('#fh5co-header').height());
			$(window).resize(function(){
				$('.js-fullheight').css('height', $(window).height() - $('#fh5co-header').height());
			});
		}

	};

	// iPad and iPod detection
	var isiPad = function(){
		return (navigator.platform.indexOf("iPad") != -1);
	};

	var isiPhone = function(){
		return (
			(navigator.platform.indexOf("iPhone") != -1) ||
			(navigator.platform.indexOf("iPod") != -1)
		);
	};

	// Main Menu Superfish
	var mainMenu = function() {

		$('#fh5co-primary-menu').superfish({
			delay: 0,
			animation: {
				opacity: 'show'
			},
			speed: 'fast',
			cssArrows: true,
			disableHI: true
		});

	};

	var sliderMain = function() {

		$('#fh5co-hero .flexslider').flexslider({
			animation: "fade",
			slideshowSpeed: 5000,
			directionNav: true,
			start: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			},
			before: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			}

		});

		$('#fh5co-hero .flexslider .slides > li').css('height', $(window).height());
		$(window).resize(function(){
			$('#fh5co-hero .flexslider .slides > li').css('height', $(window).height());
		});

	};


	// Offcanvas and cloning of the main menu
	var offcanvas = function() {

		var $clone = $('#fh5co-menu-wrap').clone();
		$clone.attr({
			'id' : 'offcanvas-menu'
		});
		$clone.find('> ul').attr({
			'class' : '',
			'id' : ''
		});

		$('#fh5co-page').prepend($clone);

		// click the burger
		$('.js-fh5co-nav-toggle').on('click', function(){

			if ( $('body').hasClass('fh5co-offcanvas') ) {
				$('body').removeClass('fh5co-offcanvas');
			} else {
				$('body').addClass('fh5co-offcanvas');
			}
			// $('body').toggleClass('fh5co-offcanvas');

		});

		$('#offcanvas-menu').css('height', $(window).height());

		$(window).resize(function(){
			var w = $(window);


			$('#offcanvas-menu').css('height', w.height());

			if ( w.width() > 769 ) {
				if ( $('body').hasClass('fh5co-offcanvas') ) {
					$('body').removeClass('fh5co-offcanvas');
				}
			}

		});

	};



	// Click outside of the Mobile Menu
	var mobileMenuOutsideClick = function() {
		$(document).click(function (e) {
			var container = $("#offcanvas-menu, .js-fh5co-nav-toggle");
			if (!container.is(e.target) && container.has(e.target).length === 0) {
				if ( $('body').hasClass('fh5co-offcanvas') ) {
					$('body').removeClass('fh5co-offcanvas');
				}
			}
		});
	};

	// Parallax
	var parallax = function() {
		$(window).stellar();
	};


	// Animations

	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated') ) {

				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							el.addClass('fadeInUp animated');
							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});

				}, 100);

			}

		} , { offset: '85%' } );
	};

	var gridAutoHeight = function() {
		if (!isiPhone() || !isiPad()) {
			$('.row-half').css('height', $('.col-half').outerHeight()/2);
		}
		$(window).resize(function(){
			if (!isiPhone() && !isiPad()) {
				$('.row-half').css('height', $('.col-half').outerHeight()/2);
			}
		});
	};

	var counter = function() {
		$('.js-counter').countTo({
			formatter: function (value, options) {
				return value.toFixed(options.decimals);
			}
		});
	};

	var counterWayPoint = function() {
		if ($('#fh5co-counter-section').length > 0 ) {
			$('#fh5co-counter-section').waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {
					setTimeout( counter , 400);
					$(this.element).addClass('animated');

				}
			} , { offset: '90%' } );
		}
	};


	// Document on load.
	$(function(){
		mainMenu();
		offcanvas();
		mobileMenuOutsideClick();
		contentWayPoint();
		sliderMain();
		fullHeight();
		gridAutoHeight();
		parallax();
		counterWayPoint();
	});


}());