( function( $ ) {
	// Site title and description.	
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-title a' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );				
				$( '.site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			}
		} );
	} );
	
//link
	wp.customize( 'link', function( value ) {
		value.bind( function( to ) {
			$( '.site-navigation a' ).css( 'color', to);
			$( '.image-and-cats a' ).css( 'color', to);
			$( '.post-date a' ).css( 'color', to);
			$( '.column .widget a' ).css( 'color', to);
			$( '.entry-header .entry-title a' ).css( 'color', to);
			$( '.content a' ).css( 'color', to);	
		} );
	} );
//headers
	wp.customize( 'heading', function( value ) {
		value.bind( function( to ) {
			$( '.content h1' ).css( 'color', to);
			$( '.content h2' ).css( 'color', to);
			$( '.content h3' ).css( 'color', to);
			$( '.content h4' ).css( 'color', to);
			$( '.content h5' ).css( 'color', to);
			$( '.content h6' ).css( 'color', to);	
		} );
	} );
//menu background		
	wp.customize( 'first_menu_color', function( value ) {
		value.bind( function( to ) {
			$( '#top-1-navigation' ).css( 'background', to);
		} );
	} );

//menu background		
	wp.customize( 'second_menu_color', function( value ) {
		value.bind( function( to ) {
			$( '#top-navigation' ).css( 'background', to);
		} );
	} );
	
//menu background		
	wp.customize( 'footer_menu_color', function( value ) {
		value.bind( function( to ) {
			$( '#footer-navigation' ).css( 'background', to);
		} );
	} );

//footer sidebar background		
	wp.customize( 'footer_sidebar_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer' ).css( 'background-color', to);
		} );
	} );
//footer sidebar text
	wp.customize( 'footer_sidebar_text', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer .widget-wrap .widget' ).css( 'color', to);
		} );
	} );
	
//footer sidebar link
	wp.customize( 'footer_sidebar_link', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer .widget-wrap .widget a' ).css( 'color', to);
		} );
	} );
	
//top sidebar background		
	wp.customize( 'top_sidebar_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-top' ).css( 'background-color', to);
			$( '.sidebar-top-full' ).css( 'background-color', to);
		} );
	} );
//top sidebar text
	wp.customize( 'top_sidebar_text', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-top .widget-wrap .widget' ).css( 'color', to);
			$( '.sidebar-top-full .widget-wrap .widget' ).css( 'color', to);
		} );
	} );
	
//top sidebar link
	wp.customize( 'top_sidebar_link', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-top .widget-wrap .widget a' ).css( 'color', to);
			$( '.sidebar-top-full .widget-wrap .widget a' ).css( 'color', to);
		} );
	} );
	
	
	wp.customize( 'layout', function( value ) {
		value.bind( function( to ) {
			if( to == 'boxed' )
				$( '.site' ).css( 'width', '94%');
			else
				$( '.site' ).css( 'width', '100%');
		} );
	} );
	
	wp.customize( 'margin_bottom', function( value ) {
		value.bind( function( to ) {
			$( '.site' ).css( 'margin-bottom', to+'px');
		} );
	} );	
	
	wp.customize( 'max_width', function( value ) {
		value.bind( function( to ) {
			$( '.site' ).css( 'max-width', to+'px');
		} );
	} );	
	
	wp.customize( 'margin_top', function( value ) {
		value.bind( function( to ) {
			$( '.site' ).css( 'margin-top', to+'px');
		} );
	} );	
//column
	wp.customize( 'column_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-main-info' ).css( 'background-color', to);
		} );
	} );
	wp.customize( 'column_link', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget a' ).css( 'color', to);
		} );
	} );	
	wp.customize( 'column_text', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget' ).css( 'color', to);
		} );
	} );	
	wp.customize( 'widget_back', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget' ).css( 'background-color', to);
		} );
	} );	
	

	
//change color scheme
	var api = parent.wp.customize;
	function SetColor(cname, newColor) {
		//update colors in picker
	    var control = api.control(cname); 
		if(control){
			control.setting.set(newColor);	
			picker = control.container.find('.color-picker-hex');
			if(picker)
				if(newColor == '')
					picker.val( control.setting() ).wpColorPicker().trigger( 'clear' );
				else
					picker.val( control.setting() ).wpColorPicker().trigger( 'change' );
		}
		return;
	}
	function SetControlVal(name, newVal) {
	    var control = api.control(name); 
		if( control ){
			control.setting.set( newVal );
		}
		return;
	}	
	function hideControl(cname) {
	    var control = api.control(cname); 
		if(control){
			control.container.toggle( 0 );
		}
	}
	function showControl(cname) {
	    var control = api.control(cname); 
		if(control){
			control.container.toggle( 1 );
		}
	}
	function removeHeader(name) {
		var control = api.control(name);
		if( control ) {
			control.removeImage();
		}
	}
	function SetHeader(name, newImage, height, width) {
		var control = api.control(name);
		if( control ) {
			var choice, data = {};
			data.url = newImage;
			data.attachment_id = 0;
			data.thumbnail_url = newImage;
			data.timestamp = _.now();
			if (width) {
				data.width = width;
			}
			if (height) {
				data.height = height;
			}
			choice = new api.HeaderTool.ImageModel({
				header: data,
				choice: newImage.split('/').pop()
			});
			api.HeaderTool.currentHeader.set(choice.toJSON());
			choice.save();
		}
		return;
	}
	function jehanne_refresh_colors( color_skin ) {
	
		if ('blue' == color_skin ) {
		
			SetColor('rgba', '0');
			SetColor('main_rgba_color', '#fff');
			SetColor('opacity', '0.7');
			
			SetColor('first_menu_color', '#fff');
			SetColor('first_menu_link', '#1e73be');
			SetColor('second_menu_link_hover', '#fff');
			SetColor('first_menu_link_hover_back', '#1e73be');
			SetColor('second_menu_color', '#000066');
			SetColor('second_menu_link', '#fff');
			SetColor('second_menu_link_hover', '#fff');
			SetColor('second_menu_link_hover_back', '#1e73be');
			
			SetColor('footer_menu_color', '#000066');
			SetColor('footer_menu_link', '#fff');
			SetColor('footer_menu_link_hover', '#fff');
			SetColor('footer_menu_link_hover_back', '#1e73be');
			SetColor('column_header_color', '#000066');
			SetColor('column_header_text', '#fff');
			SetColor('column_color', '#fff');
			SetColor('column_link', '#1e73be');
			SetColor('column_hover', '#000066');
			SetColor('column_text', '#666');
			SetColor('widget_back', '#fff');

			SetColor('top_sidebar_color', '#fff');
			SetColor('top_sidebar_link', '#1e73be');
			SetColor('top_sidebar_link_hover', '#339900');
			SetColor('top_sidebar_text', '#757575');
			SetColor('footer_sidebar_color', '#63add0');
			SetColor('footer_sidebar_link', '#fff');
			SetColor('footer_sidebar_link_hover', '#000066');
			SetColor('footer_sidebar_text', '#e3e3e3');
			
			SetColor('header_textcolor', '#d6d6d6');		
		}
		else if ( 'red' == color_skin ) {
		
			SetColor('rgba', 'linear');
			SetColor('main_rgba_color', '#111');
			SetColor('opacity', '1');
			
			SetColor('first_menu_color', '#dd1111');
			SetColor('first_menu_link', '#fff');
			SetColor('first_menu_link_hover', '#600000');
			SetColor('first_menu_link_hover_back', '#d8d215');
			SetColor('second_menu_color', '#dd1111');
			SetColor('second_menu_link', '#fff');
			SetColor('second_menu_link_hover', '#fff');
			SetColor('second_menu_link_hover_back', '#600000');
			SetColor('footer_menu_color', '#600000');
			SetColor('footer_menu_link', '#fff');
			SetColor('footer_menu_link_hover', '#fff');
			SetColor('footer_menu_link_hover_back', '#600000');
			
			SetColor('column_header_color', '#dd3333');
			SetColor('column_header_text', '#fff');
			SetColor('column_color', '#212121');
			SetColor('column_link', '#000');
			SetColor('column_hover', '#333');
			SetColor('column_text', '#666');
			SetColor('widget_back', '#d6d6d6');

			SetColor('top_sidebar_color', '#333333');
			SetColor('top_sidebar_link', '#eeeeee');
			SetColor('top_sidebar_link_hover', '#dd3333');
			SetColor('top_sidebar_text', '#cccccc');
			SetColor('footer_sidebar_color', '#600000');
			SetColor('footer_sidebar_link', '#cccccc');
			SetColor('footer_sidebar_link_hover', '#dd3333');
			SetColor('footer_sidebar_text', '#cccccc');
			
			SetColor('header_textcolor', '#afafaf');	
		}		
		else if (color_skin == 'black') {
			SetColor('rgba', 'linear');
			SetColor('main_rgba_color', '#000');
			SetColor('opacity', '1');
			
			SetColor('first_menu_color', '#595959');
			SetColor('first_menu_link', '#ddd');
			SetColor('first_menu_link_hover', '#aaa');
			SetColor('first_menu_link_hover_back', '#595959');
			SetColor('second_menu_color', '#595959');
			SetColor('second_menu_link', '#ddd');
			SetColor('second_menu_link_hover', '#aaa');
			SetColor('second_menu_link_hover_back', '#595959');
			SetColor('footer_menu_color', '#600000');
			SetColor('footer_menu_link', '#fff');
			SetColor('footer_menu_link_hover', '#fff');
			SetColor('footer_menu_link_hover_back', '#600000');
			
			SetColor('column_header_color', '#595959');
			SetColor('column_header_text', '#ccc');
			SetColor('column_color', '#212121');
			SetColor('column_link', '#aaa');
			SetColor('column_hover', '#fff');
			SetColor('column_text', '#969696');
			SetColor('widget_back', '#2b2b2b');

			SetColor('top_sidebar_color', '#333333');
			SetColor('top_sidebar_link', '#eeeeee');
			SetColor('top_sidebar_link_hover', '#dd3333');
			SetColor('top_sidebar_text', '#cccccc');
			SetColor('footer_sidebar_color', '#600000');
			SetColor('footer_sidebar_link', '#cccccc');
			SetColor('footer_sidebar_link_hover', '#dd3333');
			SetColor('footer_sidebar_text', '#cccccc');

			SetColor('header_textcolor', '#afafaf');		
		}
	};
			
	parent.wp.customize( 'color_skin', function( value ) {
		value.bind( function( to ) {
		
			jehanne_refresh_colors(to);

			});
		});
		
	parent.wp.customize( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			if( 'light' == to) {
				SetControlVal('color_skin', 'blue');
				SetColor('link', '#1e73be');
				SetColor('heading', '#000');
			}
			else if( 'dark' == to) {
				SetControlVal('color_skin', 'red');
				SetColor('link', '#eee');
				SetColor('heading', '#dddddd');
			}
			});
		});
	
} )( jQuery );
