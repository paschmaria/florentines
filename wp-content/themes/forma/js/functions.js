(function($) {
	var $window = $(window),
		$body = $('body');

	$(document).ready(function() {

		// Hidden sections
		$('#show-sidebar, #hide-sidebar, #site-overlay').on('click', function(e){
			$body.toggleClass('sidebar--opened');
			e.preventDefault();
		});

		// Scroll to top
		$('#top-link').on('click', function(e) {
			$('html, body').animate({'scrollTop': 0});
			e.preventDefault();
		});
		$window.scroll(function () {
			if ( $(this).scrollTop() > 600 ) {
				$body.addClass('is--scrolled');
			} else {
				$body.removeClass('is--scrolled');
			}
		});

		// Add dropdown toggle
		var $dropdownArrow = $('<button class="dropdown-toggle" aria-expanded="false"><span class="screen-reader-text">' + jgtformaVars.submenuText + '</span><span aria-hidden="true" class="fa-angle-down"></span></button>');
		$('#primary-menu').find('.menu-item-has-children > a').after($dropdownArrow);
		$('#primary-menu').find('.dropdown-toggle').click( function(e) {
			var _this = $(this);
			e.preventDefault();
			_this.toggleClass('toggled--on').attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');
			_this.next('.sub-menu').slideToggle(200);
		});

		// Initialize featured posts slider
		$('#featured-slider').slick({
			autoplay: true,
			arrows : true,
			dots : false,
			fade : true,
			appendArrows : $('.featured-nav'),
			prevArrow : $('.featured-prev'),
			nextArrow : $('.featured-next')
		});
		$('#featured-slider').fadeIn(600, function(){
			$(this).parents().removeClass('slider-loading');
		});

		// Grid layout
		if ( $.isFunction( $.fn.masonry ) && $body.hasClass('grid-layout') ) {
			gridLayout.refresh();
		}

		// Adjust image margins
		adjustImages();

		// Responsive video embeds
		fitVidsInit();

		// Initialize post gallery
		postGalleryInit();

		$(document.body).on('post-load', function() {
			fitVidsInit();
			postGalleryInit();
			adjustImages();
		});
	});

	$window.load(function() {
		adjustImages();
	});

	$window.on('debouncedresize', onResize);

	/* Grid layout */
	var gridLayout = (function() {
		var $container = $('#post-wrapper'),
			$items = $container.children().addClass('post--loaded'),
			initialized = false,

			init = function() {
				$container.imagesLoaded(function() {
					$container.masonry({
						itemSelector: '.hentry',
						columnWidth: '.hentry',
						transitionDuration: 0
					});
					$(document.body).on('post-load', onLoad);
					setTimeout(function() {
						$container.masonry('layout');
					}, 100);
					showItems($items);
					initialized = true;
				});
			},

			refresh = function() {
				if (!initialized) {
					init();
					return;
				}

				$container.masonry('layout');
			},

			showItems = function($items) {
				$items.each(function(i, obj) {
					var $postInside = $(obj).find('.post-inside');
					animatePost($postInside, i * 100);
				});
			},

			animatePost = function($postInside, delay) {
				setTimeout(function() {
					$postInside.addClass('is--visible');
				}, delay);
			},

			onLoad = function() {
				var $newItems = $container.children().not('.post--loaded').addClass('post--loaded');
				$newItems.imagesLoaded(function() {
					$container.masonry('appended', $newItems, true).masonry('layout');
					showItems($newItems);
				});
			};

		return {
			init: init,
			refresh: refresh
		}
	})();

	function onResize() {
		adjustImages();
		if ( $.isFunction( $.fn.masonry ) && $body.hasClass('grid-layout') ) {
			gridLayout.refresh();
		}
	}

	function adjustImages() {
		var $entry = $('.hentry'),
			$entryContent = $entry.find('.entry-content'),
			entryWidth = $entry.width(),
			entryContentWidth = $entryContent.width(),
			margin = entryContentWidth / 2 - entryWidth / 2;

		$entryContent.find('.alignleft').each(function() {
			var _this = $(this),
				elName = _this.prop('tagName').toLowerCase();
			if ( elName == 'img' || elName == 'figure' ) {
				_this.css({ 'margin-left': margin });
			}
		});
		$entryContent.find('.alignright').each(function() {
			var _this = $(this),
				elName = _this.prop('tagName').toLowerCase();
			if ( elName == 'img' || elName == 'figure' ) {
				_this.css({ 'margin-right': margin });
			}
		});
		$entryContent.find('.alignnone').each(function() {
			var _this = $(this),
				elName = _this.prop('tagName').toLowerCase();
			if ( elName == 'img' ) {
				_this.css({ 'margin-left': margin, 'max-width': 'none', 'width': entryWidth });
			} else if ( elName == 'figure' ) {
				_this.css({ 'margin-left': margin, 'max-width': 'none', 'width': entryWidth });
				_this.find('img').css({ 'width': entryWidth });
			}
		});
	}

	function postGalleryInit() {
		$('.post-gallery').not('.slick-slider').slick({
			arrows : true,
			dots : false,
			fade : true,
			prevArrow : '<button type="button" class="slick-prev"><span class="fa-arrow-left-custom" aria-hidden="true"></span> <span class="screen-reader-text">Previous</span></button>',
			nextArrow : '<button type="button" class="slick-next"><span class="fa-arrow-right-custom" aria-hidden="true"></span> <span class="screen-reader-text">Next</span></button>'
		});
	}

	function fitVidsInit() {
		$('.hentry').fitVids();
	}

})(jQuery);
