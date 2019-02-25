$( document ).ready( function() {

	/* a click on mobile search closes a possibly opened menu/toc */
	$( '#mobile-search-button' ).click( function( e ) {
		if ( $( '#main-nav-toggler' ).hasClass( 'slide-active' ) ) {
			$( '#main-nav-toggler' ).trigger( 'click' );
		}
		if ( $( '#toc-toggler' ).hasClass( 'slide-active' ) ) {
			$( '#toc-toggler' ).trigger( 'click' );
		}
		e.preventDefault();
		$( '#mobile-search-bar' ).toggleClass( 'hidden' );
		$( '#mobile-search-button' ).toggleClass( 'active' );
	} );

	//stick in the fixed 100% height behind the navbar but don't wrap it
	$( '#slide-nav.navbar-default' ).after( $( '<div id="navbar-height-col"></div>' ) );
	$( '#slide-nav.navbar-default' ).after( $( '<div id="toc-height-col"></div>' ) );

	var menuneg = '-100%';
	var slideneg = '-80%';

	$( '#slide-nav' ).on( 'click', '#main-nav-toggler', function( e ) {
		if ( $( '#toc-toggler' ).hasClass( 'slide-active' ) ) {
			$( '#toc-toggler' ).trigger( 'click' );
		}
		if ( $( '#mobile-search-button' ).hasClass( 'active' ) ) {
			$( '#mobile-search-button' ).trigger( 'click' );
		}

		var selected = $( this ).hasClass( 'slide-active' );

		$( '#slidemenu' ).stop().animate( {
			left: selected ? menuneg : '0px'
		}, 200 );

		$( '#navbar-height-col' ).stop().animate( {
			left: selected ? slideneg : '0px'
		}, 200 );

		$( this ).toggleClass( 'slide-active', !selected );
		$( '#slidemenu' ).toggleClass( 'slide-active' );

		$( '#page-content, .navbar, body, .navbar-header, #scroll-wrapper-menu' ).toggleClass( 'slide-active' );
	} );

	$( '#slide-nav' ).on( 'click', '#toc-toggler', function( e ) {
		if ( $( '#main-nav-toggler' ).hasClass( 'slide-active' ) ) {
			$( '#main-nav-toggler' ).trigger( 'click' );
		}
		if ( $( '#mobile-search-button' ).hasClass( 'active' ) ) {
			$( '#mobile-search-button' ).trigger( 'click' );
		}

		var selected = $( this ).hasClass( 'slide-active' );

		$( '#slide-toc' ).stop().animate( {
			right: selected ? menuneg : '0px'
		} );

		$( '#toc-height-col' ).stop().animate( {
			right: selected ? slideneg : '0px'
		} );

		$( this ).toggleClass( 'slide-active', !selected );
		$( '#slide-toc' ).toggleClass( 'slide-active' );

		$( '#page-content, .navbar, body, .navbar-header, #scroll-wrapper-toc' ).toggleClass( 'slide-active' );
	} );

	/* Hide navigation/toc if a linked within is clicked */
	$( '#slidemenu a[href!="#"]' ).click( function( e ) {
		$( '#main-nav-toggler' ).trigger( 'click' );
	} );

	$( '#slide-toc a' ).click( function( e ) {
		$( '#toc-toggler' ).trigger( 'click' );
	} );

	var selected = '#slidemenu, .navbar, .navbar-header, #scroll-wrapper-menu, #scroll-wrapper-toc';
	$( window ).on( 'resize', function() {
		if ( $( window ).width() > 767 && $( '.navbar-toggle' ).is( ':hidden' ) ) {
			$( selected ).removeClass( 'slide-active' );
		}

	} );

	/* Add fancy popup reference boxes */
	$( 'sup.reference' ).each( function() {
		var href = $( this ).children( 'a' ).attr( 'href' );
		href = href.replace( /\./g, "\\\." ).replace( /\:/g, "\\\:" );
		var reference = $( href + ' > .reference-text' ).html();
		$( this ).children( 'a' ).attr( 'href', 'javascript:;' );
		$( this )
			.data( 'toggle', 'popover' )
			.data( 'placement', 'bottom' )
			.attr( 'title', 'Reference' )
			.attr( 'tabindex', '0' )
			.data( 'content', reference )
			.data( 'html', true )
			.data( 'trigger', 'focus' )
			.data( 'template', '<div class="popover" role="tooltip" style="max-width:400px;"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' )
			.popover( { sanitize: false } );
	} );

	/* Popover achievements */
	$( '[data-toggle="popover-hover"]' ).on( { 'mouseenter': function() {
			$( this ).popover( 'show' );
		}, 'mouseleave': function() {
			$( this ).popover( 'hide' );
		} } );

	/* Popover for other things 8on click) */
	$( function() {
		$( '[data-toggle="popover"]' ).popover()
	} );

	/* Tooltips */
	$( function() {
		$( '[data-toggle="tooltip"]' ).tooltip()
	} );

} );

/* Hide the slide-in nav/toc if an area outside of it is clicked */
$( document ).click( function( e ) {
	var container = $( '#slide-nav' );

	if ( !container.is( e.target ) // if the target of the click isn't the container...
		&& container.has( e.target ).length === 0 ) // ... nor a descendant of the container
	{
		if ( $( '#slidemenu' ).hasClass( 'slide-active' ) ) {
			$( '#main-nav-toggler' ).trigger( 'click' );
		}
		if ( $( '#slide-toc' ).hasClass( 'slide-active' ) ) {
			$( '#toc-toggler' ).trigger( 'click' );
		}
	}
} );

/* Social media share links */
Share = {
	facebook: function( purl, ptitle ) {
		url = 'https://www.facebook.com/sharer.php?s=100';
		url += '&p[title]=' + encodeURIComponent( ptitle );
		url += '&p[url]=' + encodeURIComponent( purl );
		Share.popup( url );
	},
	twitter: function( purl, ptitle ) {
		purl = purl.replace( / /g, '_' );
		url = 'https://twitter.com/share?';
		url += 'text=' + encodeURIComponent( ptitle );
		url += '&url=' + encodeURIComponent( purl );
		url += '&counturl=' + encodeURIComponent( purl );
		Share.popup( url );
	},
	reddit: function( purl, ptitle ) {
		url = 'https://www.reddit.com/submit?';
		url += 'title=' + encodeURIComponent( ptitle );
		url += '&url=' + encodeURIComponent( purl );
		Share.popup( url );
	},
	qq: function( purl, ptitle ) {
		url = 'https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?';
		url += 'title=' + encodeURIComponent( ptitle );
		url += '&url=' + encodeURIComponent( purl );
		Share.popup( url );
	},
	vk: function( purl, ptitle ) {
		url = 'https://vkontakte.ru/share.php?';
		url += 'title=' + encodeURIComponent( ptitle );
		url += '&url=' + encodeURIComponent( purl );
		Share.popup( url );
	},
	weibo: function( purl, ptitle ) {
		url = 'https://service.weibo.com/share/share.php?';
		url += 'url=' + encodeURIComponent( purl );
		url += '&title=' + encodeURIComponent( ptitle );
		Share.popup( url );
	},
	whatsapp: function( purl, ptitle ) {
		url = 'whatsapp://send?';
		url += 'text=' + encodeURIComponent( ptitle + ": " + purl.replace( " ", "_" ) );
		Share.popup( url );
	},
	popup: function( url ) {
		window.open( url, '', 'toolbar=0,status=0,width=626,height=436' );
	}
};