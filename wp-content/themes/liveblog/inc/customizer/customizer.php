<?php
/**
* Registers options with the Theme Customizer
*
* @param object $wp_customize The WordPress Theme Customizer
* @version 1.0.0
*/

$liveblog_customizer_dir = get_template_directory() .'/inc/customizer/';

function liveblog_get_categories_select() {
 $the_cats = get_categories();
    $results;
    $count = count( $the_cats );
    for ( $i=0; $i < $count; $i++ ) {
      if ( isset( $the_cats[$i] ) )
        $results[ $the_cats[$i]->slug ] = $the_cats[ $i ]->name;
      else
        $count++;
    }
  return $results;
}

function liveblog_register_theme_customizer( $wp_customize ) {

    $liveblog_customizer_dir = get_template_directory() .'/inc/customizer/';
    
    // Rearrange Background Settings
    $wp_customize->get_section( 'background_image' )->title       = __('Body Background','liveblog');
    $wp_customize->get_section( 'background_image' )->description = __('Change the background color and image for body of theme','liveblog');
    $wp_customize->get_control( 'background_color' )->section     = 'background_image';
    
    // Move Background Color and Image section to Styling Options panel
    $wp_customize->get_section( 'background_image' )->panel = 'styling_options';
    $wp_customize->get_section( 'background_image' )->priority = 10;
    $wp_customize->get_section( 'header_image' )->panel = 'styling_options';
    $wp_customize->get_control( 'header_image' )->section = 'header_styling_options';


	//$wp_customize->get_section('static_front_page')->priority = 24;
	//$wp_customize->get_section('nav')->priority = 25;
	
	// Custom Divide Control
	class liveblog_Customize_Divide_Control extends WP_Customize_Control {
		public $type = 'divide';
	 
		public function render_content() {
			?>
				<h3 class="customize-divide"><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}
	
	// Custom Layout Control
	class liveblog_Layout_Picker_Custom_Control extends WP_Customize_Control {
		  /**
		   * Render the content on the theme customizer page
		   */
		public function render_content() {
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul>
				<?php
				foreach ( $this->choices as $key => $value ) {
					?>
					<li class="customizer-control-row">
							<input type="radio" value="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php echo esc_url( $this->link() ); ?> <?php if( $this->value() === $key ) echo 'checked="checked"'; ?>>
						<label for="<?php echo esc_attr( $key ) ?>"></label>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		}
	}
	
} // end liveblog_register_theme_customizer
add_action( 'customize_register', 'liveblog_register_theme_customizer' );


/**
* Include Customizer Panels
*/
    
get_template_part( 'inc/customizer/fonts' );
get_template_part( 'inc/customizer/panels/typography' );
get_template_part( 'inc/customizer/general' );
get_template_part( 'inc/customizer/panels/general-settings' );
get_template_part( 'inc/customizer/panels/layout' );
get_template_part( 'inc/customizer/panels/styling-options' );
get_template_part( 'inc/customizer/panels/home' );

/**
 * Checkbox Sanitization
 */
function liveblog_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function liveblog_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/**
* Sanitizes the custom layout control
*/
function liveblog_sanitize_layout( $value ) {
    if ( in_array( $value, array( 'cblayout', 'bclayout', 'full', 'boxed' ) ) ) {
        return esc_attr( $value );
    }
}

/**
* Sanitizes the custom layout control
*/
function liveblog_sanitize_text_transform( $value ) {
    if ( in_array( $value, array( 'none', 'uppercase', 'lowercase', 'capitalize' ) ) ) {
        return esc_attr( $value );
    }
}

/**
* Sanitizes Font Select Field
*/
function liveblog_sanitize_fonts( $input ) {
    global $liveblog_fonts_list;
    $valid = $liveblog_fonts_list;
 
    if ( array_key_exists( $input, $valid ) ) {
        return esc_attr( $input );
    } else {
        return '';
    }
}

/**
* Sanitizes Categories Select Field
*/
function liveblog_sanitize_cat( $input ) {
    $valid = liveblog_get_categories_select();
 
    if ( array_key_exists( $input, $valid ) ) {
        return esc_attr( $input );
    } else {
        return '';
    }
}

/**
* Sanitizes Text Fields
*/
function liveblog_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
* Writes styles out the '<head>' element of the page based on the configuration options
* saved in the Theme Customizer.
*/
function liveblog_google_fonts() {
	$fonts = array();
    
	$liveblog_body_font = get_theme_mod( 'liveblog_body_font_family', 'PT Sans' );
	$liveblog_logo_font_family = get_theme_mod( 'liveblog_logo_font_family', 'Lobster' );
	$liveblog_nav_font = get_theme_mod( 'liveblog_nav_font_family', 'Oswald' );
	$liveblog_headings_font = get_theme_mod( 'liveblog_headings_font_family', 'Oswald' );
	$liveblog_entry_title_font_family = get_theme_mod( 'liveblog_entry_title_font_family', 'Oswald' );
	$liveblog_single_title_font_family = get_theme_mod( 'liveblog_single_title_font_family', 'Oswald' );
	$liveblog_post_content_font_family = get_theme_mod( 'liveblog_post_content_font_family', 'PT Sans' );
	$liveblog_widgets_title_font_family = get_theme_mod( 'liveblog_widgets_title_font_family', 'Oswald' );
    
	if ( '' != $liveblog_body_font) {
		if ( !in_array( $liveblog_body_font, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_body_font ) );
		}
	}
	if ( '' != $liveblog_logo_font_family) {
		if ( !in_array( $liveblog_logo_font_family, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_logo_font_family ) );
		}
	}
	if ( '' != $liveblog_headings_font) {
		if ( !in_array( $liveblog_headings_font, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_headings_font ) );
		}
	}
	if ( '' != $liveblog_nav_font) {
		if ( !in_array( $liveblog_nav_font, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_nav_font ) );
		}
	}
	if ( '' != $liveblog_entry_title_font_family) {
		if ( !in_array( $liveblog_entry_title_font_family, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_entry_title_font_family ) );
		}
	}
	if ( '' != $liveblog_single_title_font_family) {
		if ( !in_array( $liveblog_single_title_font_family, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_single_title_font_family ) );
		}
	}
	if ( '' != $liveblog_post_content_font_family) {
		if ( !in_array( $liveblog_post_content_font_family, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_post_content_font_family ) );
		}
	}
	if ( '' != $liveblog_widgets_title_font_family) {
		if ( !in_array( $liveblog_widgets_title_font_family, $fonts ) ) {
			array_push( $fonts, esc_attr( $liveblog_widgets_title_font_family ) );
		}
	}
	
	$liveblog_google_font = implode(':400,500,600,700,800|', $fonts);
	$liveblog_google_fonts_url = '//fonts.googleapis.com/css?family='.$liveblog_google_font.':400,500,600,700,800';
	wp_enqueue_style( 'liveblog-google-font', $liveblog_google_fonts_url );
}
add_action( 'wp_enqueue_scripts', 'liveblog_google_fonts' );

function liveblog_customizer_css() {
    
	// Color Scheme
    $color_scheme = get_theme_mod( 'color_scheme' );
	
	// Hex to RGB
	$liveblog_hex = $color_scheme;
	list($liveblog_r, $liveblog_g, $liveblog_b) = sscanf($liveblog_hex, "#%02x%02x%02x");
    
    /*-----------------------------------------------------------*
    * Fonts
    *-----------------------------------------------------------*/
    $liveblog_body_font = '';
    $liveblog_logo_font = '';
    $liveblog_nav_font = '';
    $liveblog_entry_title_font = '';
    $liveblog_post_content_font = '';
    $liveblog_widgets_title_font = '';
    $liveblog_single_title_font = '';
	$liveblog_body_font_family = get_theme_mod( 'liveblog_body_font_family', 'PT Sans' );
    
    $liveblog_body_font = 'body { font-family: '. $liveblog_body_font_family .'}';
    
    // Logo Font
	$liveblog_logo_font_family = get_theme_mod( 'liveblog_logo_font_family' );
	$liveblog_logo_font_style = get_theme_mod( 'liveblog_logo_font_style' );
	$liveblog_logo_font_weight = get_theme_mod( 'liveblog_logo_font_weight' );
	$liveblog_logo_text_transform = get_theme_mod( 'liveblog_logo_text_transform' );
	$liveblog_logo_font_size = get_theme_mod( 'liveblog_logo_font_size' );
	$liveblog_logo_line_height = get_theme_mod( 'liveblog_logo_line_height' );
    
    $liveblog_logo_font .= '.header #logo {';
    if ( $liveblog_logo_font_family == 'default' ) { } else {
        $liveblog_logo_font .= 'font-family: '. $liveblog_logo_font_family .';';
    }
    if ( $liveblog_logo_font_style == 'default' ) { } else {
        $liveblog_logo_font .= 'font-style: '. $liveblog_logo_font_style . ';';
    }
    if ( $liveblog_logo_font_weight == 'default' ) { } else {
        $liveblog_logo_font .= 'font-weight: '. $liveblog_logo_font_weight . ';';
    }
    if ( $liveblog_logo_font_size == '' || $liveblog_logo_font_size == '' ) { } else {
        $liveblog_logo_font .= 'font-size: '. $liveblog_logo_font_size . ';';
    }
    if ( $liveblog_logo_line_height == '' || $liveblog_logo_line_height == '' ) { } else {
        $liveblog_logo_font .= 'line-height: '. $liveblog_logo_line_height . ';';
    }
    if ( $liveblog_logo_text_transform == 'default' || $liveblog_logo_text_transform == '' ) { } else {
        $liveblog_logo_font .= 'text-transform: '. $liveblog_logo_text_transform . ';';
    }
    $liveblog_logo_font .= '}';
    
    // Navigation Font
	$liveblog_nav_font_family = get_theme_mod( 'liveblog_nav_font_family', 'Oswald' );
	$liveblog_nav_font_style = get_theme_mod( 'liveblog_nav_font_style', 'normal' );
	$liveblog_nav_font_weight = get_theme_mod( 'liveblog_nav_font_weight', '400' );
	$liveblog_nav_text_transform = get_theme_mod( 'liveblog_nav_text_transform', 'uppercase' );
	$liveblog_nav_font_size = get_theme_mod( 'liveblog_nav_font_size', '13' );
	$liveblog_nav_line_height = get_theme_mod( 'liveblog_nav_line_height', '20' );
    
    $liveblog_nav_font .= '.nav-menu {';
    if ( $liveblog_nav_font_family == 'default' ) { } else {
        $liveblog_nav_font .= 'font-family: '. $liveblog_nav_font_family .';';
    }
    if ( $liveblog_nav_font_style == 'default' ) { } else {
        $liveblog_nav_font .= 'font-style: '. $liveblog_nav_font_style . ';';
    }
    if ( $liveblog_nav_font_weight == 'default' ) { } else {
        $liveblog_nav_font .= 'font-weight: '. $liveblog_nav_font_weight . ';';
    }
    if ( $liveblog_nav_font_size == '' || $liveblog_nav_font_size == '30' ) { } else {
        $liveblog_nav_font .= 'font-size: '. $liveblog_nav_font_size . ';';
    }
    if ( $liveblog_nav_line_height == '' || $liveblog_nav_line_height == '40' ) { } else {
        $liveblog_nav_font .= 'line-height: '. $liveblog_nav_line_height . ';';
    }
    if ( $liveblog_nav_text_transform == 'default' || $liveblog_nav_text_transform == '' ) { } else {
        $liveblog_nav_font .= 'text-transform: '. $liveblog_nav_text_transform . ';';
    }
    $liveblog_nav_font .= '}';
    
    // Headings Font
    $liveblog_headings_font_family = get_theme_mod( 'liveblog_headings_font_family', 'Oswald' );
    if ( $liveblog_headings_font_family == 'default' ) { } else {
        $liveblog_headings_font = 'h1,h2,h3,h4,h5,h6, .widgettitle, .search-button, #commentform #submit { font-family: '. $liveblog_headings_font_family .'}';
    }
    
    // Post: Entry Title Font
    $liveblog_entry_title_font_family = get_theme_mod( 'liveblog_entry_title_font_family', 'Oswald' );
    $liveblog_entry_title_font_style = get_theme_mod( 'liveblog_entry_title_font_style', 'normal' );
    $liveblog_entry_title_font_weight = get_theme_mod( 'liveblog_entry_title_font_weight', '700' );
    $liveblog_entry_title_font_size = get_theme_mod( 'liveblog_entry_title_font_size', '30' );
    $liveblog_entry_title_line_height = get_theme_mod( 'liveblog_entry_title_line_height', '40' );
    $liveblog_entry_title_transform = get_theme_mod( 'liveblog_entry_title_transform', 'uppercase' );
    
    $liveblog_entry_title_font .= '.entry-title {';
    if ( $liveblog_entry_title_font_family == 'default' ) { } else {
        $liveblog_entry_title_font .= 'font-family: '. $liveblog_entry_title_font_family .';';
    }
    if ( $liveblog_entry_title_font_style == 'default' ) { } else {
        $liveblog_entry_title_font .= 'font-style: '. $liveblog_entry_title_font_style . ';';
    }
    if ( $liveblog_entry_title_font_weight == 'default' ) { } else {
        $liveblog_entry_title_font .= 'font-weight: '. $liveblog_entry_title_font_weight . ';';
    }
    if ( $liveblog_entry_title_font_size == '' || $liveblog_entry_title_font_size == '30' ) { } else {
        $liveblog_entry_title_font .= 'font-size: '. $liveblog_entry_title_font_size . ';';
    }
    if ( $liveblog_entry_title_line_height == '' || $liveblog_entry_title_line_height == '40' ) { } else {
        $liveblog_entry_title_font .= 'line-height: '. $liveblog_entry_title_line_height . ';';
    }
    if ( $liveblog_entry_title_transform == 'default' ) { } else {
        $liveblog_entry_title_font .= 'text-transform: '. $liveblog_entry_title_transform . ';';
    }
    $liveblog_entry_title_font .= '}';
    
    // Post: Single Title Font
    $liveblog_single_title_font_family = get_theme_mod( 'liveblog_single_title_font_family', 'Oswald' );
    $liveblog_single_title_font_style = get_theme_mod( 'liveblog_single_title_font_style', 'normal' );
    $liveblog_single_title_font_weight = get_theme_mod( 'liveblog_single_title_font_weight', '700' );
    $liveblog_single_title_font_size = get_theme_mod( 'liveblog_single_title_font_size', '30' );
    $liveblog_single_title_line_height = get_theme_mod( 'liveblog_single_title_line_height', '40' );
    
    $liveblog_single_title_font .= '.single-title {';
    if ( $liveblog_single_title_font_family == 'default' ) { } else {
        $liveblog_single_title_font .= 'font-family: '. $liveblog_single_title_font_family .';';
    }
    if ( $liveblog_single_title_font_style == 'default' ) { } else {
        $liveblog_single_title_font .= 'font-style: '. $liveblog_single_title_font_style . ';';
    }
    if ( $liveblog_single_title_font_weight == 'default' ) { } else {
        $liveblog_single_title_font .= 'font-weight: '. $liveblog_single_title_font_weight . ';';
    }
    if ( $liveblog_single_title_font_size == '' || $liveblog_single_title_font_size == '30' ) { } else {
        $liveblog_single_title_font .= 'font-size: '. $liveblog_single_title_font_size . ';';
    }
    if ( $liveblog_single_title_line_height == '' || $liveblog_single_title_line_height == '40' ) { } else {
        $liveblog_single_title_font .= 'line-height: '. $liveblog_single_title_line_height . ';';
    }
    $liveblog_single_title_font .= '}';
    
    // Post: Content Title Font
    $liveblog_post_content_font_family = get_theme_mod( 'liveblog_post_content_font_family', 'PT Sans' );
    $liveblog_post_content_font_style = get_theme_mod( 'liveblog_post_content_font_style', 'normal' );
    $liveblog_post_content_font_weight = get_theme_mod( 'liveblog_post_content_font_weight', '400' );
    $liveblog_post_content_font_size = get_theme_mod( 'liveblog_post_content_font_size', '16' );
    $liveblog_post_content_line_height = get_theme_mod( 'liveblog_post_content_line_height', '26' );
    
    $liveblog_post_content_font .= '.post-content {';
    if ( $liveblog_post_content_font_family == 'default' ) { } else {
        $liveblog_post_content_font .= 'font-family: '. $liveblog_post_content_font_family .';';
    }
    if ( $liveblog_post_content_font_style == 'default' ) { } else {
        $liveblog_post_content_font .= 'font-style: '. $liveblog_post_content_font_style . ';';
    }
    if ( $liveblog_post_content_font_weight == 'default' ) { } else {
        $liveblog_post_content_font .= 'font-weight: '. $liveblog_post_content_font_weight . ';';
    }
    if ( $liveblog_post_content_font_size == '' || $liveblog_post_content_font_size == '16' ) { } else {
        $liveblog_post_content_font .= 'font-size: '. $liveblog_post_content_font_size . ';';
    }
    if ( $liveblog_post_content_line_height == '' || $liveblog_post_content_line_height == '26' ) { } else {
        $liveblog_post_content_font .= 'line-height: '. $liveblog_post_content_line_height . ';';
    }
    $liveblog_post_content_font .= '}';
    
    // Widgets Title Font
    $liveblog_widgets_title_font_family = get_theme_mod( 'liveblog_widgets_title_font_family', 'Oswald' );
    $liveblog_widgets_title_font_style = get_theme_mod( 'liveblog_widgets_title_font_style', 'normal' );
    $liveblog_widgets_title_font_weight = get_theme_mod( 'liveblog_widgets_title_font_weight', '700' );
    $liveblog_widgets_title_font_size = get_theme_mod( 'liveblog_widgets_title_font_size', '20' );
    $liveblog_widgets_title_line_height = get_theme_mod( 'liveblog_widgets_title_line_height', '26' );
    $liveblog_widgets_title_transform = get_theme_mod( 'liveblog_widgets_title_transform', 'uppercase' );
    
    $liveblog_widgets_title_font .= '.widget-title, #tabs li, .section-heading {';
    if ( $liveblog_widgets_title_font_family == 'default' ) { } else {
        $liveblog_widgets_title_font .= 'font-family: '. $liveblog_widgets_title_font_family .';';
    }
    if ( $liveblog_widgets_title_font_style == 'default' ) { } else {
        $liveblog_widgets_title_font .= 'font-style: '. $liveblog_widgets_title_font_style . ';';
    }
    if ( $liveblog_widgets_title_font_weight == 'default' ) { } else {
        $liveblog_widgets_title_font .= 'font-weight: '. $liveblog_widgets_title_font_weight . ';';
    }
    if ( $liveblog_widgets_title_font_size == '' || $liveblog_widgets_title_font_size == '20' ) { } else {
        $liveblog_widgets_title_font .= 'font-size: '. $liveblog_widgets_title_font_size . ';';
    }
    if ( $liveblog_widgets_title_line_height == '' || $liveblog_widgets_title_line_height == '26' ) { } else {
        $liveblog_widgets_title_font .= 'line-height: '. $liveblog_widgets_title_line_height . ';';
    }
    if ( $liveblog_widgets_title_transform == 'default' ) { } else {
        $liveblog_widgets_title_font .= 'text-transform: '. $liveblog_widgets_title_transform . ';';
    }
    $liveblog_widgets_title_font .= '}';
    
    /*-----------------------------------------------------------*
    * Header Colors
    *-----------------------------------------------------------*/
    $liveblog_header_css = '';
    
    // Header Background Image
    $header_image = get_header_image();
    
    $liveblog_header_bg_color = get_theme_mod( 'header_background_color' );
    if ( $liveblog_header_bg_color == '' ) { } else {
        $liveblog_header_css .= '.main-header { background: '. $liveblog_header_bg_color . '; }';
    }
    if ( !empty( $header_image ) ) {
        $liveblog_header_css .= '.main-header { background: url('. $header_image . ') no-repeat 100% 50%; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }';
    }
    
    /*-----------------------------------------------------------*
    * Navigation Colors
    *-----------------------------------------------------------*/
    $liveblog_nav_css = '';
    $liveblog_nav_background_color = get_theme_mod( 'liveblog_nav_background_color' );
    $liveblog_nav_links_color = get_theme_mod( 'nav_links_color' );
    if ( $liveblog_nav_background_color == '#ffffff' || $liveblog_nav_background_color == '' ) { } else {
        $liveblog_nav_css .= '.main-menu { background: '. $liveblog_nav_background_color . '; }';
    }
    if ( $liveblog_nav_links_color == '#404040' || $liveblog_nav_links_color == '' ) { } else {
        $liveblog_nav_css .= '.main-nav a { color: '. $liveblog_nav_links_color . '; }';
    }
    
    /*-----------------------------------------------------------*
    * Footer Colors
    *-----------------------------------------------------------*/
    $liveblog_footer_css = '';
    $liveblog_footer_bg_color = get_theme_mod( 'footer_background_color' );
    if ( $liveblog_footer_bg_color == '#404040' || $liveblog_footer_bg_color == '' ) { } else {
        $liveblog_footer_css .= '.footer, .copyright { background: '. $liveblog_footer_bg_color . '; }';
    }
    $liveblog_footer_title_color = get_theme_mod( 'footer_title_color' );
    if ( $liveblog_footer_title_color == '#ffffff' || $liveblog_footer_title_color == '' ) { } else {
        $liveblog_footer_css .= '.footer-widget .widget-title { color: '. $liveblog_footer_title_color . '; }';
    }
    $liveblog_footer_links_color = get_theme_mod( 'footer_links_color' );
    if ( $liveblog_footer_links_color == '#ffffff' || $liveblog_footer_links_color == '' ) { } else {
        $liveblog_footer_css .= '.footer a { color: '. $liveblog_footer_links_color . '; }';
    }
?>
	<style type="text/css">
	<?php
    echo esc_attr( $liveblog_body_font ) . esc_attr( $liveblog_logo_font ) . esc_attr( $liveblog_nav_font ) . esc_attr( $liveblog_headings_font ) . esc_attr( $liveblog_entry_title_font ) . esc_attr( $liveblog_single_title_font ) . esc_attr( $liveblog_post_content_font ) . esc_attr( $liveblog_widgets_title_font ) . esc_attr( $liveblog_header_css ) . esc_attr( $liveblog_nav_css ) . esc_attr( $liveblog_footer_css );
    if ( $color_scheme != '' ) { ?>
	.main-nav ul li a:before, .tagcloud a:hover, .pagination span, .pagination a:hover, .read-more a:hover, .post-format-quote, .flex-direction-nav a, .search-button, #subscribe-widget input[type='submit'], #wp-calendar caption, #wp-calendar td#today, #commentform #submit, .wpcf7-submit, .off-canvas-search { background-color:<?php echo esc_attr( $color_scheme ); ?>; }
	a, a:hover, .title a:hover, .sidebar a:hover, .breadcrumbs a:hover, .meta a:hover, .post-meta a:hover, .post .post-content ul li:before, .content-page .post-content ul li:before, .reply:hover i, .reply:hover a, .edit-post a, .error-text, .footer a:hover, .post-type i, .post-meta .post-type i, .post-navigation a:hover {
		color:<?php echo esc_attr( $color_scheme ); ?>;
	}
	.pagination span, .pagination a:hover, .post-content blockquote, .tagcloud a:hover, .post blockquote, .comment-reply-link:hover, .post-type, .post-meta .post-type, #tabs li.active a {
		border-color:<?php echo esc_attr( $color_scheme ); ?>;
	}
    <?php }
        echo wp_filter_nohtml_kses( get_theme_mod('liveblog_custom_css') );
    ?>
	</style>
<?php
} // end liveblog_customizer_css
add_action( 'wp_head', 'liveblog_customizer_css' );

/**
* Registers the Theme Customizer Preview with WordPress.
*
* @since 1.0
* @version 1.0
*/
function liveblog_customizer_live_preview() {
	wp_enqueue_script(
		'liveblog-customizer',
		get_template_directory_uri() . '/assets/js/theme-customizer.js',
		array( 'jquery', 'customize-preview' ),
		'1.0.0',
		true
	);
} // end liveblog_customizer_live_preview
add_action( 'customize_preview_init', 'liveblog_customizer_live_preview' );