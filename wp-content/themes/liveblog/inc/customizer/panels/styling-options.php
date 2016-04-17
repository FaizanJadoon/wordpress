<?php
/**
* Styling Options for Theme Customizer
*/

if ( ! function_exists( 'liveblog_styling_panel' ) ) {
	function liveblog_styling_panel( $wp_customize ) {
        $wp_customize->add_panel( 'styling_options', array(
            'priority'       => 88,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Styling Options', 'liveblog'),
            'description'    => __('Here you can change typography of theme', 'liveblog'),
        ) );

        /*-----------------------------------------------------------*
        * Primary Color Scheme
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'color_scheme_section', array(
            'title'    => __('Color Scheme', 'liveblog'),
            'priority' => 40,
            'panel'    => 'styling_options',
        ) );
        // Color Scheme
        $wp_customize->add_setting( 'color_scheme', array(
            'default'           => '#e74c3c',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, 'color_scheme', array(
                'priority' => 20,
                'label'    => __('Primary Color Scheme', 'liveblog'),
                'section'  => 'color_scheme_section',
                'settings' => 'color_scheme'
            )
        ) );

        /*-----------------------------------------------------------*
        * Header Styling Section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'header_styling_options', array(
            'title'    => __('Header', 'liveblog'),
            'priority' => 40,
            'panel'    => 'styling_options',
        ) );
        $wp_customize->add_setting( 'header_background_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ) );
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
                'priority' => 80,
                'label'    => __('Header Background Color', 'liveblog'),
                'section'  => 'header_styling_options',
                'settings' => 'header_background_color'
            )
        ) );

        /*-----------------------------------------------------------*
        * Navigation Styling Section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'nav_styling_options', array(
            'title'    => __('Navigation Menu', 'liveblog'),
            'priority' => 40,
            'panel'    => 'styling_options',
        ) );
        
        // Navigation Background Color
        $wp_customize->add_setting( 'liveblog_nav_background_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ) );
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, 'liveblog_nav_background_color', array(
                'priority' => 88,
                'label'    => __('Navigation Background Color', 'liveblog'),
                'section'  => 'nav_styling_options',
                'settings' => 'liveblog_nav_background_color'
            )
        ) );
        
        // Navigation Links Color
        $wp_customize->add_setting( 'nav_links_color', array(
            'default'           => '#404040',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ) );
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, 'nav_links_color', array(
                'priority' => 90,
                'label'    => __('Navigation Links Color', 'liveblog'),
                'section'  => 'nav_styling_options',
                'settings' => 'nav_links_color'
            )
        ) );

        /*-----------------------------------------------------------*
        * Footer Styling Section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'footer_styling_options', array(
            'title'    => __('Footer', 'liveblog'),
            'priority' => 40,
            'panel'    => 'styling_options',
        ) );
        
        // Footer Background Color
        $wp_customize->add_setting( 'footer_background_color', array(
            'default'           => '#404040',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ) );
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
                'priority' => 96,
                'label'    => __('Footer Background Color', 'liveblog'),
                'section'  => 'footer_styling_options',
                'settings' => 'footer_background_color'
            )
        ) );
        
        // Footer Widget Title Color
        $wp_customize->add_setting( 'footer_title_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ) );
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, 'footer_title_color', array(
                'priority' => 100,
                'label'    => __('Footer Widget Title Color', 'liveblog'),
                'section'  => 'footer_styling_options',
                'settings' => 'footer_title_color'
            )
        ) );
        
        // Footer Links and Text Color
        $wp_customize->add_setting( 'footer_links_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ) );
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, 'footer_links_color', array(
                'priority' => 100,
                'label'    => __('Footer Links and Text Color', 'liveblog'),
                'section'  => 'footer_styling_options',
                'settings' => 'footer_links_color'
            )
        ) );
	
        /*-----------------------------------------------------------*
        * Defining our own 'Custom CSS' section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'liveblog_custom_codes', array(
            'title' => __('Custom CSS', 'liveblog'),
            'description' => __('You can add your custom CSS here.', 'liveblog'),
            'priority'    => 120,
            'panel'       => 'styling_options',
        ) );
        
        // Custom CSS
        $wp_customize->add_setting( 'liveblog_custom_css', array(
            'default'           => '',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
        ) );
        $wp_customize->add_control( 'liveblog_custom_css', array(
            'type'     => 'textarea',
            'label'    => __('Custom CSS', 'liveblog'),
            'section'  => 'liveblog_custom_codes',
            'settings' => 'liveblog_custom_css'
        ) );
    }
}
add_action( 'customize_register', 'liveblog_styling_panel' );
?>