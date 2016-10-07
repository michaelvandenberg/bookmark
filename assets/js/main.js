/**
 * Custom js for theme
 */

( function( $ ) {

	/*--------------------------------------------------------------
	Scroll-To-Top.
	--------------------------------------------------------------*/
	
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


	/*--------------------------------------------------------------
	Menu.
	--------------------------------------------------------------*/

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


	/*--------------------------------------------------------------
	Waves.
	--------------------------------------------------------------*/

	// Wrap the the text of the comments-link in a span element.
	$( '.comments-link' ).wrapInner( '<span class="comments-link-text"></span>');

	// Attach and intitialize Waves.
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