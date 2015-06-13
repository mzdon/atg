jQuery( function() {

		// Enable menu toggle for small screens.
		( function() {
			var nav = jQuery( '#section-menu' ), button, menu;
			if ( ! nav ) {
				return;
			}

			button = nav.find( '.menu-toggle' );
			if ( ! button ) {
				return;
			}

			// Hide button if menu is missing or empty.
			menu = nav.find( '.nav-menu' );
			if ( ! menu || ! menu.children().length ) {
				button.hide();
				return;
			}

			jQuery( '.menu-toggle' ).on( 'click', function() {
				nav.toggleClass( 'toggled-on' );
			} );
		} )();
		
		// Menu smooth scroll
		jQuery( '.nav-menu' ).localScroll( 800 );
		
		var $window = jQuery( window ),
			navSection = jQuery( '#section-menu' );
			
		function checkStickyMenu() {
			if( !navSection.hasClass( 'sticky' ) && window.scrollY > window.innerHeight ) {
				navSection.addClass( 'sticky' );
			} else if( navSection.hasClass( 'sticky' ) && window.scrollY <= window.innerHeight ) {
				navSection.removeClass( 'sticky' );
			}
		};
		
		checkStickyMenu();
			
		$window.scroll( function() {
			checkStickyMenu();
		} );
		
		
		//Parallax
		var landing = jQuery( '.section-landing' );
		landing.parallax("50%", 0.5);
		
		function sizeLanding() {
			var cache = sizeLanding.cache = sizeLanding.cache || {};
			
			var windowHeight = $window.height();
			landing.height( Math.ceil( windowHeight * 0.75 ) );
			
			if( !cache.cycleAfter ) {
				var cycle = jQuery('.slider-cycle').data( cycle ),
					fn;
				if( cycle && cycle[ 'cycle.opts' ] && cycle[ 'cycle.opts' ].after.length ) {
					fn = function() {
						var after = cycle[ 'cycle.opts' ].after;
						for( var i = 0, len = after.length; i < len; i++ ) {
							after[ i ].apply( cycle[ 'cycle.opts' ].elements[ cycle[ 'cycle.opts' ].currSlide ] );
						}
					}
					cache.cycleAfter = fn;
				}
			}
			cache.cycleAfter && cache.cycleAfter();
		}
		
		sizeLanding();

		$window.resize(function () {
			sizeLanding();
		});
		
		// Masonry
		$grid = jQuery( '.grid' );
		$grid.masonry({
		  itemSelector: '.grid-item',
		  columnWidth: '.grid-size',
		  gutter: '.gutter-size',
		  percentPosition: true
		});
		
		// Filtering
		var $filters = jQuery( '.category-filter' );
		for( var i = 0, len = $filters.length; i < len; i++ ) {
			( function( grid, filter ) {
				var fn = function( e ) {
					e.preventDefault();
					e.stopPropagation();
					
					var cat = this.getAttribute( 'data-category' );
					var re = RegExp( "(?:[^\\w-]|\\s+)" + cat + "(?:[^\\w-]|\\s+)" );
					// Get masonry item
					var bricks = jQuery( '.grid-item' );
					// Hide everything but the category we selected
					if( cat !== 'All' ) {
						for( var i = 0, len = bricks.length; i < len; i++ ) {
							var brick = jQuery( bricks[ i ] );
							if( re.test( brick.attr( 'class' ) ) ) {
								brick.css( 'display', 'block' );
							} else {
								brick.css( 'display', 'none' );
							}
						}
					} else {
						for( var i = 0, len = bricks.length; i < len; i++ ) {
							jQuery(bricks[ i ]).css( 'display', 'block' );
						}
					}
					
					grid.masonry();
				}
				if( filter.addEventListener ) {
					filter.addEventListener( 'click', fn );
				} else {
					filter.attachEvent( 'onclick', fn );
				}
			})( $grid, $filters[ i ] );
		}
} );