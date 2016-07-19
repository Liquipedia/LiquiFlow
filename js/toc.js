
var lastScrollTop = 0;
var currentState = 'top';
function adjustSidebar() {
	var secondNavbar = 0;
	var tocBottomOffset = 0;
	var tocHeightModifier = 30;
	var tocScrollTopOffset = 30;
	var tocTopOffset = 57;
	
	/* second navbar for logged in people */
	secondNavbar = ($('body')[0].hasClass('logged-in')) ? $('#wiki-nav').outerHeight(): 0;
	if(secondNavbar != 0) {
		tocScrollTopOffset = -secondNavbar;
		tocTopOffset = 89;
		tocBottomOffset = 32;
		tocHeightModifier = 25;
	}
	
	var scrollTop = $(window).scrollTop();
	var navMaxHeightAd = true;
	if($(window).height() < 600) {
		navMaxHeightAd = false;
	}

	var distanceToFooter = $(document).height() - $('#slide-nav').outerHeight() - $(window).scrollTop()
		- $('#sidebar-toc').outerHeight() - $('#footer').outerHeight() + ($('#sidebar-ad').length?$('#sidebar-ad').outerHeight():0) - tocBottomOffset;
	var distanceToBottom = $(document).height() - $(window).height() - $(window).scrollTop();
	var isScrollingDown = ((scrollTop - lastScrollTop) > 0) ? true : false;
	var offsetTop = $('#sidebar-toc').offset().top - scrollTop;
	var offsetBottom = $('#sidebar-toc').offset().bottom;

	if (scrollTop >= (secondNavbar + tocScrollTopOffset) && isScrollingDown && currentState == 'top') {
		$('#sidebar-toc').removeClass('affix-top');
		$('#sidebar-toc').addClass('affix');
		currentState = 'middle';
	} else if (scrollTop <= (secondNavbar + tocScrollTopOffset) && !isScrollingDown && currentState == 'middle') {
		$('#sidebar-toc').removeClass('affix');
		$('#sidebar-toc').addClass('affix-top');
		currentState = 'top';
	} else if (distanceToFooter <= 10 && isScrollingDown && currentState == 'middle') {
		$('#sidebar-toc').removeClass('affix');
		$('#sidebar-toc').addClass('affix-bottom');
		currentState = 'bottom';
	} else if (distanceToFooter >= 10  && !isScrollingDown && currentState == 'bottom') {
		$('#sidebar-toc').removeClass('affix-bottom');
		$('#sidebar-toc').addClass('affix');
		currentState = 'middle';
	}

	if (currentState == 'bottom') {
		$('#sidebar-toc').css('bottom', ($('#footer').outerHeight() + 10) - distanceToBottom - ($('#sidebar-ad').length?$('#sidebar-ad').outerHeight():-10) - 18);
	}
	
	$('#sidebar-toc > .nav').css('max-height', ($(window).height() - (tocTopOffset + secondNavbar + 18) - (navMaxHeightAd?($('#sidebar-ad').length?($('#sidebar-ad').outerHeight() + 35):35):tocHeightModifier) + tocBottomOffset) + 'px');

	lastScrollTop = $(window).scrollTop();
}

!function ($) {

	$(function () {
		var $window = $(window);
		var $body   = $(document.body);

		$body.scrollspy({
			target: '#sidebar-toc',
			offset: 20 // required to select the right thing. if this is smaller then you are at the top of one section
					   // but the next section is highlighted
		});

		$window.on('load', function () {
			$body.scrollspy('refresh');
			$('#sidebar-toc-column').css('height', $('#main-content-column').height() + 12);
			$('#sidebar-toc-column').css('margin-left', $('#main-content-column').offset().left - 310);
			$('#sidebar-toc-column').addClass('visible-lg visible-xl');
		});

		$(window).scroll(function() {
			adjustSidebar();
		});

		$(window).resize(function() {
			$('#sidebar-toc-column').css('height', $('#main-content-column').height() + 12);
			$('#sidebar-toc-column').css('margin-left', Math.max($('#main-content-column').offset().left - 310, 0));
			adjustSidebar();
		});

//		setTimeout(function () {
//			$('#sidebar-toc').affix({
//					offset: {
//					top: 55
//					bottom: 10
//				}
//			})
//		}, 100);

	})

}(jQuery)
