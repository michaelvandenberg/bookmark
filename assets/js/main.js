/**
 * Custom js for theme
 */

( function( $ ) {
	var $window   = $( window ),
		$document = $( document ),
		resizeTimer,
		toolbarHeight,
		slideMenu = $( '.slide-panel' ),
		body = $( 'body' ),
		actionText = $('.action-text'),
		menuToggle = $( '.menu-toggle' );

	/**
	* Full width feature images
	*
	* Makes full width images have a class.
	*/
	function bigImageClass() {
		$( '.entry-content img.size-full' ).each( function() {
			var img = $( this ),
			newImg = new Image();

			newImg.src = img.attr( 'src' );

			$( newImg ).load( function() {
				var imgWidth = newImg.width;

				if ( imgWidth >= 1080 ) {
					$( img ).addClass( 'size-big' );
				}

			} );
		} );
	}

	/**
	* Full screen size images: props to Resonar for solution
	*/
	function fullscreenFeaturedImage() {
		var entryHeaderBackground, entryHeaderHeight, windowWidth;
		entryHeaderBackground = $( '.feature-header' );

		if ( ! entryHeaderBackground ) {
			return;
		}

		toolbarHeight     = body.is( '.admin-bar' ) ? $( '#wpadminbar' ).height() : 0;
		entryHeaderHeight = $window.height();
		windowWidth       = $window.width();

		entryHeaderBackground.css( {
			'height': entryHeaderHeight + 'px',
			'margin-top': '-' + toolbarHeight + 'px',
		} );
	}

	/**
	* Sliding panel
	*
	* Swaps classes for sliding panel so it uses CSS transformations.
	*/
	function slideControl() {
		menuToggle.on( 'click', function( e ) {
			e.preventDefault();
			var $this = $( this );

			slideMenu.toggleClass( 'expanded' ).resize();
			body.toggleClass( 'sidebar-open' );

			$this.toggleClass( 'toggle-on' );
			$this.attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) == 'false' ? 'true' : 'false');

			if( slideMenu.hasClass( 'expanded' ) ) {
							actionText.text( 'hide' );
					} else {
						actionText.text( 'show' );
					}

			//Close slide menu with double click
			body.dblclick( function( e ) {
				e.preventDefault();
				slideMenu.removeClass( 'expanded' ).resize();
				$( this ).removeClass( 'sidebar-open' );
				menuToggle.removeClass( 'toggle-on' );
			} );
		} );
	}



	/**
	* Close slide menu with escape key
	*
	* Adds in this functionality
	*/
	$document.keyup( function( e ) {
		if ( e.keyCode === 27 && slideMenu.hasClass( 'expanded' ) ) {
			body.removeClass( 'sidebar-open' );
			menuToggle.removeClass( 'toggle-on' );
			slideMenu.removeClass( 'expanded' ).resize();

			if( slideMenu.hasClass( 'expanded' ) ) {
							actionText.text( 'hide' );
					} else {
						actionText.text( 'show' );
					}
		}
	} );

	/**
	* Loader for all the theme functions: props to Resonar for resizing
	*/
	$window.on( 'resize', function() {
		clearTimeout( resizeTimer );
		resizeTimer = setTimeout( function() {
			fullscreenFeaturedImage();
		}, 100 );
	} );

	$document.ready( function() {
		fullscreenFeaturedImage();
		bigImageClass();
		slideControl();
	} );

	// Check distance to top and display back-to-top.
	$(window).scroll(function(){
		if ($(this).scrollTop() > 800) {
			$( '.back-to-top' ).addClass( 'show-back-to-top' );
		} else {
			$( '.back-to-top' ).removeClass( 'show-back-to-top' );
		}
	});

	// Click event to scroll to top.
	$( '.back-to-top, .search-toggle' ).click(function(){
		$( 'html, body' ).animate({scrollTop : 0},800);
		return false;
	});


	// Open hidden header to reveal mobile menu.
	$( '.menu-toggle' ).on( 'click' , function() {
		var open   = $(this).data( 'open' ),
			easing = open ? 'swing' : 'easeOutBounce',
			time   = open ? 1000 : 2000;

		$( '#hidden-header' )[open ? 'slideUp' : 'slideDown']( time, easing);

		$(this).data('open', !open);

		$( '.menu-toggle' ).toggleClass( 'menu-toggled' );

		// Change aria attritute.
		if ( $( this ).hasClass( 'menu-toggled' ) ) {
			$( '.menu-toggle' ).attr( 'aria-expanded' , 'true' );
		}
		else {
			$( '.menu-toggle' ).attr( 'aria-expanded' , 'false' );
		}
	});










	$( '.comments-link' ).wrapInner( '<span class="comments-link-text"></span>');
	Waves.attach('.nav-previous a, .nav-next a');
	Waves.attach('.comments-link', ['waves-button', 'waves-float']);
	Waves.init();

	/*--------------------------------------------------------------
	Image links.
	--------------------------------------------------------------*/

	// Add .image-link class to the image link anchor.
	$( '.entry-content a img' ).each( function() {
		var $this = $( this );
		$this.parent().addClass( 'image-link' );
	});

} )( jQuery );