jQuery( function() {

		// Search toggle.
		jQuery( '.search-toggle' ).on( 'click', function( event ) {
			var that    = jQuery( this ),
				wrapper = jQuery( '#search-box' );

			that.toggleClass( 'active' );
			wrapper.toggleClass( 'hide' );

			if ( that.is( '.active' ) || jQuery( '.search-toggle' )[0] === event.target ) {
				wrapper.find( '.s' ).focus();
			}
		} );

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
		

		var $window = jQuery(window),
		landing = jQuery( '.section-landing' );
		
		function sizeLanding() {
			var cache = sizeLanding.cache = sizeLanding.cache || {};
			
			var windowHeight = $window.height();
			landing.height( windowHeight );
			
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
		$masonry = jQuery( '.masonry' );
		$masonry.masonry({
		  itemSelector: '.masonry-item',
		  columnWidth: '.grid-size',
		  gutter: '.gutter-size',
		  percentPosition: true
		});
		
		// Filtering
		var $filters = jQuery( '.category-filter' );
		for( var i = 0, len = $filters.length; i < len; i++ ) {
			( function( masonry, filter ) {
				var fn = function( e ) {
					e.preventDefault();
					e.stopPropagation();
					
					var cat = this.getAttribute( 'data-category' );
					// Get masonry item
					var bricks = jQuery( '.masonry-item' );
					// Hide everything but the category we selected
					if( cat !== 'All' ) {
						for( var i = 0, len = bricks.length; i < len; i++ ) {
							var brick = jQuery( bricks[ i ] );
							if( brick.attr( 'class' ).indexOf( cat ) < 0 ) {
								brick.css( 'display', 'none' );
							} else {
								brick.css( 'display', 'block' );
							}
						}
					} else {
						for( var i = 0, len = bricks.length; i < len; i++ ) {
							jQuery(bricks[ i ]).css( 'display', 'block' );
						}
					}
					
					masonry.masonry();
				}
				if( filter.addEventListener ) {
					filter.addEventListener( 'click', fn );
				} else {
					filter.attachEvent( 'onclick', fn );
				}
			})( $masonry, $filters[ i ] );
		}
} );