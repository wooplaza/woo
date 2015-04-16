//load main functions
jQuery( document ).ready(function( $ ) {

	$(window).scroll( function() {
		trigger_hover();
		trigger_zoom_in_out();
	});
	
	$('.widget.jehanne_image .wrapper.hover-all').each(function( index ) {
		$( this ).mouseover(function(){
			$( this ).find('.element').addClass('trigger-hover');
		})
		$( this ).mouseleave(function(){
			$( this ).find('.element').removeClass('trigger-hover');
		});		
	});
	
	
	function trigger_zoom_in_out() {
	
		$( '.widget.jehanne_image .wrapper .element.element-zoomed-once' ).each(function( index ) {
			var widget = $( this );
			if(isElementOutOfTheScreen( $( this ) )) {
				$( this ).removeClass('element-zoomed-once'); 	
			}
		});
		
		$( '.widget.jehanne_image .wrapper .element.zoom:not(.element-zoomed-once)' ).each(function( index ) {
			var widget = $( this );
			if( isElementOnTheScreen ( $( this ) ) ) {
				$( this ).addClass('trigger-zoom').addClass('element-zoomed-once'); 				
				setTimeout(function() {
					widget.removeClass('trigger-zoom');
					if (widget.hasClass('once')) 
						widget.removeClass('zoom');
				}, 300 );
			}
		});
	}
	function trigger_hover() {
		
		$( '.widget.jehanne_image .wrapper .element.element-hovered-once' ).each(function( index ) {
			var widget = $( this );
			if(isElementOutOfTheScreen( $( this ) )) {
				$( this ).removeClass('element-hovered-once'); 	
			}
		});
		
		$( '.widget.jehanne_image .wrapper.all .element.animate:not(.element-hovered-once)' ).each(function( index ) {
			var widget = $( this );
			if( isElementOnTheScreen ( $( this ) ) ) {
				$( this ).addClass('trigger-hover').addClass('element-hovered-once'); 				
				setTimeout(function() {
					widget.removeClass('trigger-hover');
					if (widget.hasClass('once')) 
						widget.removeClass('animate');

				}, 5000 );
			}
		});
		
		$( '.widget.jehanne_image .wrapper.step' ).each(function( index ) {
			var top = $( this ).offset().top;
			var currentPos = $( window ).scrollTop();
			var widget = $( this );
			if( isElementOnTheScreen ( $( this ) ) ) {
						
				var delay = $( this ).find('.element.animate').size()*1000 + 2000;			
				
				$( this ).find('.element.animate:not(.element-hovered-once)').each(function( index ) {
					var element = $( this );
					element.addClass('element-hovered-once');
					setTimeout(function() {	
						element.addClass('trigger-hover');
					}, index*1000 );
				});
				
				var wrap = $( this );
				
				setTimeout(function() {
					var element = wrap.find('.element.animate');	
					element.removeClass('trigger-hover');	
					if (element.hasClass('once'))
						element.removeClass('animate');
				}, delay );
			}
		});
	}
	function isElementOnTheScreen( $element ) {
		var top = $element.offset().top;
		var currentPos = $( window ).scrollTop();
		if( (( currentPos + $( window ).height()/2 > top) || 
							(currentPos + $( window ).height() > top + $element.height()
							&& currentPos + $( window ).height()/2 < top )) 
					&& currentPos < top )
			return true;
		return false;
	}
	
	function isElementOutOfTheScreen( $element ) {
		var top = $element.offset().top;
		var currentPos = $( window ).scrollTop();
		if( currentPos + $( window ).height() < top || currentPos > top + $( $element ).height() ) 	
			return true;
		return false;
	}
});