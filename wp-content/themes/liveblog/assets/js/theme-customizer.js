(function( $ ) {
	"use strict";

	var sFont;

	wp.customize( 'tcx_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'a' ).css( 'color', to );
		} );
	});

	wp.customize( 'tcx_display_header', function( value ) {
		value.bind( function( to ) {
			false === to ? $( '#header' ).hide() : $( '#header' ).show();
		} );
	});
	
	// Copyright Text
	wp.customize( 'copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '.copyright-text' ).text( to );
		});
	});
	
	// Color Scheme
	wp.customize( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( '.read-more a:hover, .share-button, #subscribe-widget input[type="submit"], .search-button, .pagination span, .pagination a:hover, .flex-direction-nav a' ).css( 'background', to );
		} );
	});
	wp.customize( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title a:hover, .post-author a, .post-type i, .post-meta .post-type i' ).css( 'color', to );
		} );
	});
	wp.customize( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( '.post-type, .post-meta .post-type, .pagination span, .pagination a:hover, #tabs li.active a' ).css( 'border-color', to );
		} );
	});
	
	// Layout Type
	wp.customize( 'layout_type', function( value ) {
		value.bind( function( to ) {
			$('body').attr('class', to);
		} );
	} );

	// Background Color
	wp.customize( 'tpie_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-color', to );
		} );
	});
	wp.customize( 'footer_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer-widget .widget-title' ).css( 'color', to );
		} );
	});
	wp.customize( 'footer_links_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer a' ).css( 'color', to );
		} );
	});
	
	// Background Image
	wp.customize( 'tpie_background_image', function( value ) {
		value.bind( function( to ) {

			0 === $.trim( to ).length ?
				$( 'body' ).css( 'background-image', '' ) :
				$( 'body' ).css( 'background-image', 'url( ' + to + ')' );

		});
	});

	// Header Background Color
	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-header' ).css( 'background-color', to );
		} );
	});

	// Navigation Background Color
	wp.customize( 'liveblog_nav_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-menu' ).css( 'background-color', to );
		} );
	});
    
	// Navigation Link Color
	wp.customize( 'nav_links_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-menu a' ).css( 'color', to );
		} );
	});

	// Footer Background Color
	wp.customize( 'footer_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer, .copyright' ).css( 'background-color', to );
		} );
	});

	wp.customize( 'tcx_example_file', function( value ) {
		value.bind( function( to ) {

			0 === $.trim( to ).length ?
				$( '#file-download' ).hide() :
				$( '#file-download' ).show();

		});
	});
    
    /*-----------------------------------------------------------*
    * Typography
    *-----------------------------------------------------------*/
    // Logo Font
	wp.customize( 'tpie_logo_font_style', function( value ) {
		value.bind( function( to ) {
			$( '.header #logo' ).css( 'font-style', to );
		} );
	});
	wp.customize( 'tpie_logo_font_weight', function( value ) {
		value.bind( function( to ) {
			$( '.header #logo' ).css( 'font-weight', to );
		} );
	});
	wp.customize( 'tpie_logo_text_transform', function( value ) {
		value.bind( function( to ) {
			$( '.header #logo' ).css( 'text-transform', to );
		} );
	});
	wp.customize( 'tpie_logo_font_size', function( value ) {
		value.bind( function( to ) {
			$( '.header #logo' ).css( 'font-size', to );
		} );
	});
	wp.customize( 'tpie_logo_line_height', function( value ) {
		value.bind( function( to ) {
			$( '.header #logo' ).css( 'line-height', to );
		} );
	});
    
    // Navigation Font
	wp.customize( 'tpie_nav_font_style', function( value ) {
		value.bind( function( to ) {
			$( '.nav-menu' ).css( 'font-style', to );
		} );
	});
	wp.customize( 'tpie_nav_font_weight', function( value ) {
		value.bind( function( to ) {
			$( '.nav-menu' ).css( 'font-weight', to );
		} );
	});
	wp.customize( 'tpie_nav_text_transform', function( value ) {
		value.bind( function( to ) {
			$( '.nav-menu' ).css( 'text-transform', to );
		} );
	});
	wp.customize( 'tpie_nav_font_size', function( value ) {
		value.bind( function( to ) {
			$( '.nav-menu' ).css( 'font-size', to );
		} );
	});
	wp.customize( 'tpie_nav_line_height', function( value ) {
		value.bind( function( to ) {
			$( '.nav-menu' ).css( 'line-height', to );
		} );
	});
    
    // Post: Entry Title Font
	wp.customize( 'tpie_entry_title_font_style', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).css( 'font-style', to );
		} );
	});
	wp.customize( 'tpie_entry_title_font_weight', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).css( 'font-weight', to );
		} );
	});
	wp.customize( 'tpie_entry_title_transform', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).css( 'text-transform', to );
		} );
	});
	wp.customize( 'tpie_entry_title_font_size', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).css( 'font-size', to );
		} );
	});
	wp.customize( 'tpie_entry_title_line_height', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).css( 'line-height', to );
		} );
	});
    
    // Widgets Title Font
	wp.customize( 'tpie_widgets_title_font_style', function( value ) {
		value.bind( function( to ) {
			$( '.widget-title' ).css( 'font-style', to );
		} );
	});
	wp.customize( 'tpie_widgets_title_font_weight', function( value ) {
		value.bind( function( to ) {
			$( '.widget-title' ).css( 'font-weight', to );
		} );
	});
	wp.customize( 'tpie_widgets_title_transform', function( value ) {
		value.bind( function( to ) {
			$( '.widget-title' ).css( 'text-transform', to );
		} );
	});
	wp.customize( 'tpie_widgets_title_font_size', function( value ) {
		value.bind( function( to ) {
			$( '.widget-title' ).css( 'font-size', to );
		} );
	});
	wp.customize( 'tpie_widgets_title_line_height', function( value ) {
		value.bind( function( to ) {
			$( '.widget-title' ).css( 'line-height', to );
		} );
	});

})( jQuery );
