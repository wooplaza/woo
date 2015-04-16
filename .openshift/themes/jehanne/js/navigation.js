/**
 * Handles toggling the navigation menu for small screens 
 */
( function() {
	var nav = [], button = [], menu = [], nav_class = [];
	for ( i = 0; i < 4; i++ ) {
		nav[i]= document.getElementById( 'menu-' + ( i + 1 ) );
		nav_class[i] = ( 2 === i ? 'nav-menu' : 'nav-horizontal' );
		if ( ! nav[i] ) {
			continue;
		}
		button[i] = nav[i].getElementsByTagName( 'div' )[0];
		menu[i]   = nav[i].getElementsByTagName( 'ul' )[0];
		if ( ! button[i] ) {
			continue;
		}

		// Hide button if menu is missing or empty.
		if ( ! menu[i] || ! menu[i].childNodes.length ) {
			button[i].style.display = 'none';
			continue;
		}

		button[i].onclick = function(x) {
			return function() { 	

			if ( -1 === menu[x].className.indexOf( nav_class[x] ) ) {

				menu[x].className = nav_class[x];
				
			}
			if ( -1 !== this.className.indexOf( 'toggled-on' ) ) {
				this.className = this.className.replace( ' toggled-on', '' );
				menu[x].className = menu[x].className.replace( ' toggled-on', '' );
			} else {
				this.className += ' toggled-on';
				menu[x].className += ' toggled-on';
			} }
        }(i);
	}
} )();
/**
 * The same for top sidebars
 */
( function() {
	var nav = [], button = [], menu = [], nav_class = [];
	for ( i = 0; i < 7; i++ ) {

		nav[i]= document.getElementById( 'sidebar-' + ( i + 1 ) );
		nav_class[i] = 'widget-area';
		if ( ! nav[i] ) {
			continue;
		}
		button[i] = nav[i].getElementsByTagName( 'div' )[0];
		menu[i]   = nav[i].getElementsByTagName( 'div' )[0];
		if ( ! button[i] ) {
			continue;
		}

		// Hide button if menu is missing or empty.
		if ( ! menu[i] || ! menu[i].childNodes.length ) {
			button[i].style.display = 'none';
			continue;
		}

		button[i].onclick = function(x) {
			return function() { 	

			if ( -1 === menu[x].className.indexOf( nav_class[x] ) ) {

				menu[x].className = nav_class[x];
				
			}
			if ( -1 !== this.className.indexOf( 'toggled-on' ) ) {
				this.className = this.className.replace( ' toggled-on', '' );
				menu[x].className = menu[x].className.replace( ' toggled-on', '' );
			} else {
				this.className += ' toggled-on';
				menu[x].className += ' toggled-on';
			} }
        }(i);
	}
} )();

//Keep sub menu within screen
jQuery( document ).ready(function( $ ) {

	$('.site-navigation li').bind('mouseover', jehanne_openSubMenu);
	$('.nav-horizontal li').bind('mouseover', jehanne_openSubMenu);

	function jehanne_openSubMenu() {
		var all = $(window).width();
		if(parseInt(all) < 740) 
			return;
		var left = $(this).offset().left;
		var width = $(this).outerWidth(true);

		var offset = all - (left + width + 100);
		if( offset < 0 ) {
			$(this).find( 'ul' ).css('left','-50%').css('top','100%').css('width','200');
		}
	}
		
	var adm = 0;
	if(parseInt($('#wpadminbar')) != 'undefined')
		adm = parseInt($('#wpadminbar').css('height'));
	
	var topheader = adm;
	
	$('.sticky-top-menu #top-navigation').addClass('original').clone().insertAfter('#top-navigation').addClass('cloned').css('position','fixed').css('top','0').css('margin-top',adm).css('z-index','500').removeClass('original').hide();
	$('.sticky-header .header-wrap').addClass('original-header').clone().insertAfter('.header-wrap').addClass('cloned-header').css('position','fixed').css('top','0').css('margin-top',topheader).css('z-index','500').removeClass('original-header').hide();
	
	$(window).scroll( function(){
		if ( $(this).scrollTop() > 200 ) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
		
		stickIt();
		stickHeader();
	});
	
	$(window).resize( function(){
		stickIt();
		stickHeader();
	});
	
	$('.scrollup').click( function(){
		$('html, body').animate({scrollTop : 0}, 1000);
		return false;
	});
	
	function stickIt() {
		var orgElement = $('.original');
		if( orgElement.size() <= 0)
			return;

		var orgElementPos = $('.original').offset();
		var orgElementTop = orgElementPos.top;               

		if ($(window).scrollTop() >= (orgElementTop) && parseInt($(window).width()) > 740 ) {
		// scrolled past the original position; now only show the cloned, sticky element.

			// Cloned element should always have same left position and width as original element.     
			var coordsOrgElement = orgElement.offset();
			var leftOrgElement = coordsOrgElement.left;  
			var widthOrgElement = parseInt(orgElement.css('width')) + 2;
			$('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
			$('.original').css('visibility','hidden');
			} else {
			// not scrolled past the menu; only show the original menu.
				$('.cloned').hide();
				$('.original').css('visibility','visible');
				}
		}
		
	function stickHeader() {
	
		if( $('.sticky-header .header-wrap').size() <= 0)
			return;
			
		var orgElement = $('.site-main-info');
			
		var admtop = 0;
		if($('#wpadminbar') != 'undefined')
			admtop = (parseInt($('#wpadminbar').css('height')) != 'NaN' ? admtop : parseInt($('#wpadminbar').css('height')));		
		if($('.sticky-top-menu #top-navigation') != 'undefined')
			admtop += (parseInt($('.sticky-top-menu #top-navigation').css('height')) != 'NaN' ? parseInt($('.sticky-top-menu #top-navigation').css('height')) : 0 );
			
		var orgElementPos = parseInt($('.site-main-info').offset().top) + parseInt($('.site-main-info').css('height'));
		var orgElementTop = $('.site-main-info').offset().top;  
		var siteContentEnd = parseInt($('.site-content').offset().top) + parseInt($('.site-content').css('height'));
		
		if ($(window).scrollTop() >= (orgElementPos) && ($(window).scrollTop() + parseInt($('.header-wrap').css('height') + admtop)  <= siteContentEnd)
			&& parseInt($(window).width()) > 740) {
    
			if($('.cloned-header').hasClass('visible'))
				return;
				
			var coordsOrgElement = orgElement.offset();
			var leftOrgElement = coordsOrgElement.left;  
			var widthOrgElement = parseInt(orgElement.css('width'));
			$('.cloned-header').css('left',leftOrgElement+'px').css('top', admtop).css('width',widthOrgElement).show(100).addClass('visible');
			$('.original-header').css('visibility','hidden');
		} else {
			if($('.cloned-header').hasClass('visible')) {

				$('.cloned-header').hide(1000).removeClass('visible');
				$('.original-header').css('visibility','visible');
				
			}
		}
	}
	
});