/*
 * Frontend JS
 *
 * @package Fluida
 */

jQuery( document ).ready( function() {

	for (index = 1; index <= fluida_settings.lpboxratios.length; ++index) {
		jQuery( '.lp-boxes-'+index+' .lp-box-image' ).keepRatio( fluida_settings.lpboxratios[index-1] );
		jQuery('.lp-box').keepRatio( fluida_settings.lpboxratios[index-1] );
	}
	jQuery( ".lp-boxes-animated.lp-boxes" ).mousedir( ".lp-boxes-animated.lp-boxes:not(.lp-boxes-animated2) .lp-box" );

	fluida_mobilemenu_init();
	fluida_initnav('#mobile-menu');
	fluida_sitetitle_breakup();
	fluida_menu_animate();
	fluida_backtotop();
	fluida_searchform_animation();
	fluida_social_titles();
	fluida_bodyclasses();
	fluida_tabs_widget();
	fluida_portfolio_filter();

	if ( ( (fluida_settings.fitvids == 2) && (fluida_settings.is_mobile == 1) ) || ( fluida_settings.fitvids == 1 ) )	jQuery( ".entry-content" ).fitVids();
	if ( fluida_settings.autoscroll == 1 ) fluida_autoscroll();
}); /* document.ready */

jQuery(window).load(function() {

	jQuery( window ).trigger( "scroll" );

	/* articles masonry */
	if ( ( fluida_settings.masonry == 1 ) && ( fluida_settings.magazine != 1 ) && ( typeof jQuery.fn.masonry !== 'undefined' ) ) {
		jQuery('#content-masonry').masonry({
			itemSelector: 'article',
			columnWidth: 'article',
			percentPosition: true,
			isRTL: fluida_settings.rtl,
		});
	}
	/* jetpack portfolio masonry */
	fluida_portfolio_masonry();

}); /* window.load */

/* Site Title Letter break */
function fluida_sitetitle_breakup() {
	var str = jQuery( "#site-title span a" ).text();
	var newstr = "";
	var delay = 0.05;
	for ( var i = 0, len = str.length; i < len; i++ ) {
		if ( str[i]!=' ' )
			newstr += "<span>" + str[i] + "</span>";
		else
			newstr += "<span>&nbsp;</span>";
	}
	jQuery( "#site-title span a" ).html( newstr );
	jQuery( "#site-title > span > a > span" ).each( function() {
		jQuery( this ).css( {'transition': 'color 0s ease ' + delay + 's,' + ' background-color 0s ease ' + delay + 's'} );
		delay += .02;
	});
} /* fluida_sitetitle_breakup() */

/* Menu animation */
function fluida_menu_animate() {
	jQuery( "#access > .menu ul li > a:not(:only-child)" ).attr( "aria-haspopup", "true" );/* IE10 mobile Fix */

	jQuery( "#access li" ).hover( function() {
		jQuery( this ).addClass('menu-hover');
	}, function() {
		jQuery( this ).removeClass('menu-hover');
	});

	jQuery('#access ul').find('a').on( 'focus', function() {
		jQuery( this ).parents( '.menu-item, .page_item' ).addClass( 'menu-hover' );
	});

	jQuery('#access ul').find('a').on( 'blur', function() {
		jQuery( this ).parents( '.menu-item, .page_item' ).removeClass( 'menu-hover' );
	});

} /* fluida_menu_animate() */

/* Back to top button animation */
function fluida_backtotop() {
	jQuery( window ).scroll( function() {
		if ( jQuery( this ).scrollTop() > 500 ) {
			jQuery( "#toTop" ).css( { "bottom": "-2px", "opacity": 1 } );
		} else {
			jQuery( "#toTop" ).css( { "bottom": "100px", "opacity": 0 } );
		}
		if ( jQuery( this ).scrollTop() > 300 ) {
			jQuery( ".fluida-fixed-menu #site-header-main" ).addClass( "header-fixed" );
		} else {
			jQuery( ".fluida-fixed-menu #site-header-main" ).removeClass( "header-fixed" );
		}
	});
} /* fluida_backtotop() */

/* Search form animation */
function fluida_searchform_animation() {
	var i = 0;
	jQuery( "#access .menu-search-animated > a" ).on( 'click', function( event ) {
		event.preventDefault();
	});
	jQuery( "#access .menu-search-animated > a" ).on( 'mousedown focus', function( event ) {
		event.preventDefault();
		i++;
		jQuery( ".menu-search-animated .searchform" ).slideToggle( 100 );
		jQuery( ".menu-search-animated .s" ).focus();
		if( i == 2 ) {
			//jQuery( ".menu-search-animated .searchsubmit" ).click(); // disabled
		}
		event.stopPropagation();
	});
	jQuery( ".menu-search-animated .searchform" ).click( function( event ){
		event.stopPropagation();
	});
	jQuery( "#access .menu-search-animated .s").blur( function() {
		i = 0;
		jQuery( "#access .menu-search-animated .searchform" ).fadeOut( 100 );
	});

	jQuery( "#toTop" ).click( function( event ) {
		event.preventDefault();
		jQuery( "html, body" ).animate( { scrollTop: 0 }, 500 );
		return false;
	});
} /* fluida_searchform_animation() */

/* Mobile Menu */
function fluida_mobilemenu_init() {

	jQuery("#nav-toggle").click(function(){
		jQuery("#mobile-menu").show().animate({left: "0"}, 500);
		jQuery('body').addClass("noscroll");
	});

	jQuery("#nav-cancel").click(function(){
		jQuery("#mobile-menu").animate({left: "100%"},500,function(){jQuery(this).css("left","-100%").hide();});
		jQuery('body').removeClass("noscroll");
	});

	/* Remove animated class from mobile menu */
	jQuery("#mobile-menu .menu-main-search").removeClass("menu-search-animated");

	jQuery( "#mobile-menu > div" ).append( jQuery( "#sheader" ).clone() );
	jQuery( "#mobile-menu #sheader" ).attr( "id", "smobile");

}

/* Add submenus toggles to the primary navigation */
function fluida_initnav(selector) {

	container = jQuery(selector);

	/* Add dropdown toggle that display child menu items. */
	container.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"></button>' );
	container.find( '.page_item_has_children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"></button>' );

	/* Toggle buttons and submenu items with active children menu items. */
	container.find( '.current-menu-ancestor > button, .current-page-ancestor > button' ).addClass( 'toggle-on' );
	container.find( '.current-menu-ancestor > .sub-menu, .current-page-ancestor > .sub-menu, .current-menu-ancestor .children, .current-page-ancestor .children' ).show(0).addClass( 'toggled-on' );

	container.find( '.dropdown-toggle' ).click( function( e ) {
		var _this = jQuery( this );
		e.preventDefault();
		_this.toggleClass( 'toggle-on' );
		if ( _this.hasClass( 'toggle-on') ) {
			_this.next( '.children, .sub-menu' ).show(0).addClass( 'toggled-on' );
			_this.prev("a").addClass( "toggled-on" );
		}
		else {
			_this.next( '.children, .sub-menu' ).removeClass( 'toggled-on' );
			_this.prev("a").removeClass( "toggled-on" );
		}

		/* _this.parent().find( 'a' ).toggleClass( 'toggled-on' ); */
		_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
	} );

	/* Close mobile menu on click/tap */
	jQuery('body').on('click','#mobile-nav a', function() {
		jQuery('#nav-cancel i').trigger('click');
	});
}

/* LP Boxes Keep aspect ratio*/
jQuery.fn.keepRatio = function( ratio ) {

	var $this = jQuery( this );
	var nh = $this.width() / ratio;
	$this.css( "height", nh + "px" );
	jQuery( window ).resize( function() {
		var nh = $this.width() / ratio;
		$this.css( "height", nh + "px" );
	});

}; /* Keep boxes aspect ration */

/* LP Box Mouse direction overlay animation */
jQuery.fn.mousedir = function( el ) {
	if ( ! jQuery( "body" ).hasClass( "fluida-landing-page" ) ) return;

	var $this = jQuery( this ),
		$el = jQuery( el ),
		last_position = {},
		$output = "direction-down";

	jQuery( document ).on( "mousemove", function (event) {

	    if ( typeof( last_position.x ) != "undefined" ) {
	        var deltaX = last_position.x - event.offsetX,
	            deltaY = last_position.y - event.offsetY;
	        if ( Math.abs( deltaX ) > Math.abs( deltaY ) && deltaX > 0 ) {
	            $output = "direction-up";
	        } else if ( Math.abs( deltaX ) > Math.abs( deltaY ) && deltaX < 0 ) {
	            $output = "direction-up";
	        } else if ( Math.abs( deltaY ) > Math.abs( deltaX ) && deltaY > 0 ) {
	            $output = "direction-up";
	        } else if ( Math.abs( deltaY ) > Math.abs( deltaX ) && deltaY < 0 ) {
	            $output = "direction-up";
	        } else {
				$output = "direction-up";
			}
		}
		last_position = {
	    	x : event.offsetX,
	    	y : event.offsetY
		};

	});

	$el.on( "mouseenter", function() {
		jQuery( this ).removeClass( "in-direction-left in-direction-right in-direction-up in-direction-down out-direction-left out-direction-right out-direction-up out-direction-down" );
		jQuery( this ).addClass( "in-" + $output );
		return;
	});
	$el.on( "mouseleave", function() {
		jQuery( this ).removeClass( "in-direction-left in-direction-right in-direction-up in-direction-down out-direction-left out-direction-right out-direction-up out-direction-down" );
		jQuery( this ).addClass( "out-" + $output );
		return;
	});

}; /* Mouse direction overlay animation */

/* See if element is visible in browser window */
jQuery.fn.visible = function( partial ) {
	var $t            = jQuery( this ),
		$w            = jQuery( window ),
		viewTop       = $w.scrollTop(),
		viewBottom    = viewTop + $w.height(),
		_top          = $t.offset().top,
		_bottom       = _top + $t.height(),
		compareTop    = partial === true ? _bottom : _top,
		compareBottom = partial === true ? _top : _bottom;

	return ( (compareBottom <= viewBottom) && (compareTop >= viewTop) );
}; /* jQuery.fn.visible() */

/* Animate on scroll */
function animateScroll( $articles ) {

	var $articles = jQuery( $articles );

	$articles.each( function( i, el ) {
	  var el = jQuery( el );
	  if ( ! el.visible( true ) ) {
		  el.addClass( "animated-article" );
	  }
	});

	jQuery( window ).on({
	    'scroll': function( e ) {
			$articles.each( function( i, el ) {
				var el = jQuery( el );
				if ( el.visible( true ) ) {
					el.removeClass( "animated-article" );
				}
			});
	    }
	});

} /* animateScroll() */
if ( fluida_settings.articleanimation ) animateScroll( "#content-masonry > article" );

/*  Add Social Icons titles */
function fluida_social_titles() {

	jQuery( ".socials a" ).each(function() {
		jQuery( this ).attr( "title", jQuery( this ).children().html() );
		jQuery( this ).html( "" );
	});

} /* fluida_social_titles() */

/* Add body classes */
function fluida_bodyclasses() {
	/* Detect and apply custom class for Safari */
	if ( navigator.userAgent.indexOf( "Safari" ) != -1 && navigator.userAgent.indexOf( "Chrome" ) == -1) {
		jQuery( "body" ).addClass( "safari" );
	}
	/* Add body class if masonry is used on page */
	if ( jQuery( "#content-masonry" ).length > 0 ) {
		jQuery( "body" ).addClass( "fluida-with-masonry" );
	}
} /* fluida_bodyclasses() */


/*  Tabs widget */
function fluida_tabs_widget() {
		var tabsNav       = jQuery('.cryout-wtabs-nav'),
			tabsNavLis    = tabsNav.children('li'),
			tabsContainer = jQuery('.cryout-wtabs-container');

		tabsNav.each(function() {
			var localthis = jQuery(this);
			localthis.next().children('.cryout-wtab').stop(true,true).hide().siblings( localthis.find('a').attr('href') ).show();
			localthis.children('li').first().addClass('active').stop(true,true).show();
		});

		tabsNavLis.on('click', function(e) {
			var localthis = jQuery(this);

			localthis.siblings().removeClass('active').end().addClass('active');

			localthis.parent().next().children('.cryout-wtab').stop(true,true).hide().siblings( localthis.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		}).children( window.location.hash ? 'a[href="' + window.location.hash + '"]' : 'a:first' ).trigger('click');

};

/* Jetpack Portfolio masonry */
function fluida_portfolio_masonry() {
	if ( ( fluida_settings.masonry == 1 ) && ( typeof jQuery.fn.masonry !== 'undefined' ) ) {
		/* jQuery('#portfolio-masonry').masonry({
			itemSelector: '.portfolio-entry',
		 	columnWidth: '.portfolio-entry:not(.hidden)',
		 	percentPosition: true,
		 	isRTL: fluida_settings.rtl,
		 });*/
		jQuery('.jetpack-portfolio-shortcode').masonry({
			itemSelector: '.portfolio-entry',
			columnWidth: '.portfolio-entry:not(.hidden)',
			percentPosition: true,
			isRTL: fluida_settings.rtl,
		});
	}
}

/* Portfolio filtering */
function fluida_portfolio_filter() {
	jQuery('body').on('click', '#portfolio-filter > a', function(e) {
		e.preventDefault();
		jQuery('#portfolio-filter > a').removeClass('active');
		jQuery(this).addClass('active');
		var filter = jQuery(this).attr('data-slug');
		jQuery('#portfolio-masonry .portfolio-entry').each( function(i,elm) {
			if (filter == 'all') {
				jQuery(elm).removeClass('hidden');
			} else {
				if ( !jQuery(elm).hasClass('type-'+filter) ) {
					jQuery(elm).addClass('hidden');
				} else {
					jQuery(elm).removeClass('hidden');
				}
			}
		}).promise().done( function() {
			fluida_portfolio_masonry();
			/*jQuery('.jetpack-portfolio-shortcode').masonry();*/
		});
		return false;
	});
}

/* FitVids 1.1*/
;(function( $ ){

  'use strict';

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      /* appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js */
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement("div");
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore, .wp-block-embed__wrapper';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object'); /* SwfObj conflict patch */
      $allVideos = $allVideos.not(ignoreList); /* Disable FitVids on this video. */

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; /* Disable FitVids on this video. */
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('name')){
          var videoName = 'fitvid' + $.fn.fitVids._count;
          $this.attr('name', videoName);
          $.fn.fitVids._count++;
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };

  /* Internal counter for unique video names. */
  $.fn.fitVids._count = 0;

/* Works with either jQuery or Zepto */
})( window.jQuery || window.Zepto );


/**
 * Scroll to anchors
 */
function fluida_autoscroll(document, history, location) {
	document = window.document;
	history = window.history;
	location = window.location;
	var HISTORY_SUPPORT = !!(history && history.pushState);
	var anchorScrolls = {
		ANCHOR_REGEX: /^#[^ ]+$/,
		OFFSET_HEIGHT_PX: jQuery('.fluida-fixed-menu #site-header-main').height()+40,

		/**
		* Establish events, and fix initial scroll position if a hash is provided.
		*/
		init: function() {
			this.scrollToCurrent();
			jQuery(window).on('hashchange', jQuery.proxy(this, 'scrollToCurrent'));
			jQuery('body').on('click', '.main a, nav ul li a', jQuery.proxy(this, 'delegateAnchors'));
		},

		/**
		* Return the offset amount to deduct from the normal scroll position.
		* Modify as appropriate to allow for dynamic calculations
		*/
		getFixedOffset: function() {
			return this.OFFSET_HEIGHT_PX;
		},

		/**
		* If the provided href is an anchor which resolves to an element on the
		* page, scroll to it.
		* @param  {String} href
		* @return {Boolean} - Was the href an anchor.
		*/
		scrollIfAnchor: function(href, pushToHistory) {
			var match, anchorOffset;

			if(!this.ANCHOR_REGEX.test(href)) {
				return false;
			}

			match = document.getElementById(href.slice(1));

			if(match && ! jQuery(match).visible( true )) {
				anchorOffset = jQuery(match).offset().top - this.getFixedOffset();
				jQuery('html, body').animate({ scrollTop: anchorOffset});

				/* Add the state to history as-per normal anchor links */
				if(HISTORY_SUPPORT && pushToHistory) {
					history.pushState({}, document.title, location.pathname + href);
				}
			}

			return !!match;
		},

		/**
		* Attempt to scroll to the current location's hash.
		*/
		scrollToCurrent: function(e) {
			if(this.scrollIfAnchor(window.location.hash) && e) {
				e.preventDefault();
			}
		},

		/**
		* If the click event's target was an anchor, fix the scroll position.
		*/
		delegateAnchors: function(e) {
			var elem = e.target.closest('a');

			if(this.scrollIfAnchor(elem.getAttribute('href'), true)) {
				e.preventDefault();
			}
		}
	};

	jQuery(document).ready(jQuery.proxy(anchorScrolls, 'init'));
}

/* FIN */
