<?php
/**
* Typography for Theme Customizer
*/


if ( ! function_exists( 'liveblog_typography_panel' ) ) {
	function liveblog_typography_panel( $wp_customize ) {
    global $liveblog_fonts_list;

    $wp_customize->add_panel( 'typography_options', array(
        'priority'       => 94,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Typography Options', 'liveblog'),
        'description'    => __('Here you can change typography of theme', 'liveblog'),
    ) );

	// Body Font
	$wp_customize->add_section( 'liveblog_typography_section_body', array(
        'title'    => __('Body Font', 'liveblog'),
        'priority' => 10,
        'panel'    => 'typography_options',
    ) );
	$wp_customize->add_setting( 'liveblog_body_font_family', array(
        'default'           => 'PT Sans',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_body_font_family', array(
		'section'  => 'liveblog_typography_section_body',
		'label'    => __('Font Family', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );

    /*-----------------------------------------------------------*
    * Logo Font
    *-----------------------------------------------------------*/
	$wp_customize->add_section( 'liveblog_logo_font_section', array(
        'title'    => __('Logo Font', 'liveblog'),
        'priority' => 15,
        'panel'    => 'typography_options',
    ) );

    // Logo Font Family
	$wp_customize->add_setting( 'liveblog_logo_font_family', array(
        'default'           => 'Lobster',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_logo_font_family', array(
		'section'  => 'liveblog_logo_font_section',
		'label'    => __('Select Font', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );

    // Logo Font Style
	$wp_customize->add_setting( 'liveblog_logo_font_style', array(
        'default'   => 'normal',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_choices'
    ) );
	$wp_customize->add_control( 'liveblog_logo_font_style', array(
		'section'  => 'liveblog_logo_font_section',
		'label'    => __('Font Style', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'normal' => __('Normal', 'liveblog'),
            'italic' => __('Italic', 'liveblog'),
        )
    ) );

    // Logo Font Weight
	$wp_customize->add_setting( 'liveblog_logo_font_weight', array(
        'default'   => '400',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_font_weight'
    ) );
	$wp_customize->add_control( 'liveblog_logo_font_weight', array(
		'section'  => 'liveblog_logo_font_section',
		'label'    => __('Font Weight', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            '400' => __('Normal: 400', 'liveblog'),
            '500' => __('Medium: 500', 'liveblog'),
            '600' => __('Semi-Bold: 600', 'liveblog'),
            '700' => __('Bold: 700', 'liveblog'),
            '800' => __('Extra-Bold: 800', 'liveblog'),
        )
    ) );

    // Logo Text Transform
	$wp_customize->add_setting( 'liveblog_logo_text_transform', array(
        'default'   => 'capitalize',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_text_transform',
    ) );
	$wp_customize->add_control( 'liveblog_logo_text_transform', array(
		'section'  => 'liveblog_logo_font_section',
		'label'    => __('Text Transform', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'none'    => __('None', 'liveblog'),
            'uppercase'  => __('Uppercase', 'liveblog'),
            'lowercase'  => __('Lowercase', 'liveblog'),
            'capitalize' => __('Capitalize', 'liveblog'),
        )
    ) );
        
    // Logo Font Size
    $wp_customize->add_setting( 'liveblog_logo_font_size', array(
        'default'           => '56px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_logo_font_size', array(
        'section'     => 'liveblog_logo_font_section',
        'label'       => __('Font Size', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );
        
    // Logo Line Height
    $wp_customize->add_setting( 'liveblog_logo_line_height', array(
        'default'           => '62px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_logo_line_height', array(
        'section'     => 'liveblog_logo_font_section',
        'label'       => __('Line Height', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );

    /*-----------------------------------------------------------*
    * Navigation Font
    *-----------------------------------------------------------*/
	$wp_customize->add_section( 'navigation_font_section', array(
        'title'    => __('Navigation Font', 'liveblog'),
        'priority' => 20,
        'panel'    => 'typography_options',
    ) );

    // Navigation Font Family
	$wp_customize->add_setting( 'liveblog_nav_font_family', array(
        'default'           => 'Oswald',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_nav_font_family', array(
		'section'  => 'navigation_font_section',
		'label'    => __('Select Font', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );

    // Navigation Font Style
	$wp_customize->add_setting( 'liveblog_nav_font_style', array(
        'default'   => 'normal',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_choices'
    ) );
	$wp_customize->add_control( 'liveblog_nav_font_style', array(
		'section'  => 'navigation_font_section',
		'label'    => __('Font Style', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'default' => __('Default', 'liveblog'),
            'normal' => __('Normal', 'liveblog'),
            'italic' => __('Italic', 'liveblog'),
        )
    ) );

    // Navigation Font Weight
	$wp_customize->add_setting( 'liveblog_nav_font_weight', array(
        'default'   => '400',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_font_weight'
    ) );
	$wp_customize->add_control( 'liveblog_nav_font_weight', array(
		'section'  => 'navigation_font_section',
		'label'    => __('Font Weight', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            '400' => __('Normal: 400', 'liveblog'),
            '500' => __('Medium: 500', 'liveblog'),
            '600' => __('Semi-Bold: 600', 'liveblog'),
            '700' => __('Bold: 700', 'liveblog'),
            '800' => __('Extra-Bold: 800', 'liveblog'),
        )
    ) );

    // Navigation Text Transform
	$wp_customize->add_setting( 'liveblog_nav_text_transform', array(
        'default'   => 'default',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_text_transform',
    ) );
	$wp_customize->add_control( 'liveblog_nav_text_transform', array(
		'section'  => 'navigation_font_section',
		'label'    => __('Text Transform', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'default'    => __('Default', 'liveblog'),
            'uppercase'  => __('Uppercase', 'liveblog'),
            'lowercase'  => __('Lowercase', 'liveblog'),
            'capitalize' => __('Capitalize', 'liveblog'),
        )
    ) );
        
    // Navigation Font Size
    $wp_customize->add_setting( 'liveblog_nav_font_size', array(
        'default'           => '13px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_nav_font_size', array(
        'section'     => 'navigation_font_section',
        'label'       => __('Font Size', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );
        
    // Navigation Line Height
    $wp_customize->add_setting( 'liveblog_nav_line_height', array(
        'default'           => '20px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_nav_line_height', array(
        'section'     => 'navigation_font_section',
        'label'       => __('Line Height', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );

    /*-----------------------------------------------------------*
    * Headings Font
    *-----------------------------------------------------------*/
	$wp_customize->add_section( 'headings_font_section', array(
        'title'    => __('Headings Font', 'liveblog'),
        'priority' => 30,
        'panel'    => 'typography_options',
    ) );
	$wp_customize->add_setting( 'liveblog_headings_font_family', array(
        'default'           => 'Oswald',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_headings_font_family', array(
		'section'  => 'headings_font_section',
		'label'    => __('Font Family', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );
	$wp_customize->add_setting( 'headings_font_style', array(
        'default'  => 'normal',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_choices'
    ) );
	$wp_customize->add_control( 'headings_font_style', array(
		'section'  => 'headings_font_section',
		'label'    => __('Font Style', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'normal'  => __('Normal', 'liveblog'),
            'italic'  => __('Italic', 'liveblog'),
        )
    ) );
	$wp_customize->add_setting( 'headings_font_weight', array(
        'default'  => '400',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_font_weight'
    ) );
	$wp_customize->add_control( 'headings_font_weight', array(
		'section'  => 'headings_font_section',
		'label'    => __('Font Weight', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            '400' => __('Normal: 400', 'liveblog'),
            '500' => __('Medium: 500', 'liveblog'),
            '600' => __('Semi-Bold: 600', 'liveblog'),
            '700' => __('Bold: 700', 'liveblog'),
            '800' => __('Extra-Bold: 800', 'liveblog'),
        )
    ) );

    /*-----------------------------------------------------------*
    * Post: Entry Title Font
    *-----------------------------------------------------------*/
	// Post: Entry Title Font Family
	$wp_customize->add_section( 'post_entry_title_font_section', array(
        'title'    => __('Post: Entry Title Font', 'liveblog'),
        'priority' => 30,
        'panel'    => 'typography_options',
    ) );
	$wp_customize->add_setting( 'liveblog_entry_title_font_family', array(
        'default'           => 'Oswald',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_entry_title_font_family', array(
		'section'  => 'post_entry_title_font_section',
		'label'    => __('Font Family', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );

    // Post: Entry Title Font Style
	$wp_customize->add_setting( 'liveblog_entry_title_font_style', array(
        'default'  => 'normal',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_choices'
    ) );
	$wp_customize->add_control( 'liveblog_entry_title_font_style', array(
		'section'  => 'post_entry_title_font_section',
		'label'    => __('Font Style', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'normal'  => __('Normal', 'liveblog'),
            'italic'  => __('Italic', 'liveblog'),
        )
    ) );

    // Post: Entry Title Font Weight
	$wp_customize->add_setting( 'liveblog_entry_title_font_weight', array(
        'default'  => '700',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_font_weight'
    ) );
	$wp_customize->add_control( 'liveblog_entry_title_font_weight', array(
		'section'  => 'post_entry_title_font_section',
		'label'    => __('Font Weight', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            '400' => __('Normal: 400', 'liveblog'),
            '500' => __('Medium: 500', 'liveblog'),
            '600' => __('Semi-Bold: 600', 'liveblog'),
            '700' => __('Bold: 700', 'liveblog'),
            '800' => __('Extra-Bold: 800', 'liveblog'),
        )
    ) );

    // Post: Entry Title Text Transform
	$wp_customize->add_setting( 'liveblog_entry_title_transform', array(
        'default'   => 'default',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_text_transform',
    ) );
	$wp_customize->add_control( 'liveblog_entry_title_transform', array(
		'section'  => 'post_entry_title_font_section',
		'label'    => __('Text Transform', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'default'    => __('Default', 'liveblog'),
            'uppercase'  => __('Uppercase', 'liveblog'),
            'lowercase'  => __('Lowercase', 'liveblog'),
            'capitalize' => __('Capitalize', 'liveblog'),
        )
    ) );
        
    // Post: Entry Title Font Size
    $wp_customize->add_setting( 'liveblog_entry_title_font_size', array(
        'default'           => '30px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_entry_title_font_size', array(
        'section'     => 'post_entry_title_font_section',
        'label'       => __('Font Size', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );
        
    // Post: Entry Title Line Height
    $wp_customize->add_setting( 'liveblog_entry_title_line_height', array(
        'default'           => '40px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_entry_title_line_height', array(
        'section'     => 'post_entry_title_font_section',
        'label'       => __('Line Height', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );

    /*-----------------------------------------------------------*
    * Post: Single Title Font
    *-----------------------------------------------------------*/
	// Post: Single Title Font Family
	$wp_customize->add_section( 'post_single_title_font_section', array(
        'title'    => __('Post: Single Title Font', 'liveblog'),
        'priority' => 30,
        'panel'    => 'typography_options',
    ) );
	$wp_customize->add_setting( 'liveblog_single_title_font_family', array(
        'default'           => 'Oswald',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_single_title_font_family', array(
		'section'  => 'post_single_title_font_section',
		'label'    => __('Font Family', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );

    // Post: Single Title Font Style
	$wp_customize->add_setting( 'liveblog_single_title_font_style', array(
        'default'  => 'normal',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_choices'
    ) );
	$wp_customize->add_control( 'liveblog_single_title_font_style', array(
		'section'  => 'post_single_title_font_section',
		'label'    => __('Font Style', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'normal'  => __('Normal', 'liveblog'),
            'italic'  => __('Italic', 'liveblog'),
        )
    ) );

    // Post: Single Title Font Weight
	$wp_customize->add_setting( 'liveblog_single_title_font_weight', array(
        'default'  => '700',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_font_weight'
    ) );
	$wp_customize->add_control( 'liveblog_single_title_font_weight', array(
		'section'  => 'post_single_title_font_section',
		'label'    => __('Font Weight', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            '400' => __('Normal: 400', 'liveblog'),
            '500' => __('Medium: 500', 'liveblog'),
            '600' => __('Semi-Bold: 600', 'liveblog'),
            '700' => __('Bold: 700', 'liveblog'),
            '800' => __('Extra-Bold: 800', 'liveblog'),
        )
    ) );

    // Post: Single Title Text Transform
	$wp_customize->add_setting( 'liveblog_single_title_transform', array(
        'default'   => 'default',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_text_transform',
    ) );
	$wp_customize->add_control( 'liveblog_single_title_transform', array(
		'section'  => 'post_single_title_font_section',
		'label'    => __('Text Transform', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'default'    => __('Default', 'liveblog'),
            'uppercase'  => __('Uppercase', 'liveblog'),
            'lowercase'  => __('Lowercase', 'liveblog'),
            'capitalize' => __('Capitalize', 'liveblog'),
        )
    ) );
        
    // Post: Single Title Font Size
    $wp_customize->add_setting( 'liveblog_single_title_font_size', array(
        'default'           => '30px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_single_title_font_size', array(
        'section'     => 'post_single_title_font_section',
        'label'       => __('Font Size', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );
        
    // Post: Single Title Line Height
    $wp_customize->add_setting( 'liveblog_single_title_line_height', array(
        'default'           => '40px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_single_title_line_height', array(
        'section'     => 'post_single_title_font_section',
        'label'       => __('Line Height', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );

    /*-----------------------------------------------------------*
    * Post: Content Font
    *-----------------------------------------------------------*/
	// Post: Content Font Family
	$wp_customize->add_section( 'post_post_content_font_section', array(
        'title'    => __('Post: Content Font', 'liveblog'),
        'priority' => 30,
        'panel'    => 'typography_options',
    ) );
	$wp_customize->add_setting( 'liveblog_post_content_font_family', array(
        'default'           => 'PT Sans',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_post_content_font_family', array(
		'section'  => 'post_post_content_font_section',
		'label'    => __('Font Family', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );

    // Post: Content Font Style
	$wp_customize->add_setting( 'liveblog_post_content_font_style', array(
        'default'  => 'normal',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_choices'
    ) );
	$wp_customize->add_control( 'liveblog_post_content_font_style', array(
		'section'  => 'post_post_content_font_section',
		'label'    => __('Font Style', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'normal'  => __('Normal', 'liveblog'),
            'italic'  => __('Italic', 'liveblog'),
        )
    ) );

    // Post: Content Font Weight
	$wp_customize->add_setting( 'liveblog_post_content_font_weight', array(
        'default'  => '400',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_font_weight'
    ) );
	$wp_customize->add_control( 'liveblog_post_content_font_weight', array(
		'section'  => 'post_post_content_font_section',
		'label'    => __('Font Weight', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            '400' => __('Normal: 400', 'liveblog'),
            '500' => __('Medium: 500', 'liveblog'),
            '600' => __('Semi-Bold: 600', 'liveblog'),
            '700' => __('Bold: 700', 'liveblog'),
            '800' => __('Extra-Bold: 800', 'liveblog'),
        )
    ) );
        
    // Post: Content Font Size
    $wp_customize->add_setting( 'liveblog_post_content_font_size', array(
        'default'           => '16px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_post_content_font_size', array(
        'section'     => 'post_post_content_font_section',
        'label'       => __('Font Size', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );
        
    // Post: Content Line Height
    $wp_customize->add_setting( 'liveblog_post_content_line_height', array(
        'default'           => '26px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_post_content_line_height', array(
        'section'     => 'post_post_content_font_section',
        'label'       => __('Line Height', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );

    /*-----------------------------------------------------------*
    * Widgets Title Font
    *-----------------------------------------------------------*/
	// Widgets Title Font Family
	$wp_customize->add_section( 'post_widgets_title_font_section', array(
        'title'    => __('Widgets Title Font', 'liveblog'),
        'priority' => 30,
        'panel'    => 'typography_options',
    ) );
	$wp_customize->add_setting( 'liveblog_widgets_title_font_family', array(
        'default'           => 'Oswald',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_fonts',
    ) );
	$wp_customize->add_control( 'liveblog_widgets_title_font_family', array(
		'section'  => 'post_widgets_title_font_section',
		'label'    => __('Font Family', 'liveblog'),
		'type'     => 'select',
		'choices'  => $liveblog_fonts_list
    ) );

    // Widgets Title Font Style
	$wp_customize->add_setting( 'liveblog_widgets_title_font_style', array(
        'default'  => 'normal',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_choices'
    ) );
	$wp_customize->add_control( 'liveblog_widgets_title_font_style', array(
		'section'  => 'post_widgets_title_font_section',
		'label'    => __('Font Style', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'normal'  => __('Normal', 'liveblog'),
            'italic'  => __('Italic', 'liveblog'),
        )
    ) );

    // Widgets Title Font Weight
	$wp_customize->add_setting( 'liveblog_widgets_title_font_weight', array(
        'default'  => '700',
        'type'     => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_font_weight'
    ) );
	$wp_customize->add_control( 'liveblog_widgets_title_font_weight', array(
		'section'  => 'post_widgets_title_font_section',
		'label'    => __('Font Weight', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            '400' => __('Normal: 400', 'liveblog'),
            '500' => __('Medium: 500', 'liveblog'),
            '600' => __('Semi-Bold: 600', 'liveblog'),
            '700' => __('Bold: 700', 'liveblog'),
            '800' => __('Extra-Bold: 800', 'liveblog'),
        )
    ) );

    // Widgets Title Text Transform
	$wp_customize->add_setting( 'liveblog_widgets_title_transform', array(
        'default'   => 'none',
        'transport' => 'postMessage',
        'type'      => 'theme_mod',
        'sanitize_callback' => 'liveblog_sanitize_text_transform',
    ) );
	$wp_customize->add_control( 'liveblog_widgets_title_transform', array(
		'section'  => 'post_widgets_title_font_section',
		'label'    => __('Text Transform', 'liveblog'),
		'type'     => 'select',
		'choices'  =>   array(
            'none'       => __('None', 'liveblog'),
            'uppercase'  => __('Uppercase', 'liveblog'),
            'lowercase'  => __('Lowercase', 'liveblog'),
            'capitalize' => __('Capitalize', 'liveblog'),
        )
    ) );
        
    // Widgets Title Font Size
    $wp_customize->add_setting( 'liveblog_widgets_title_font_size', array(
        'default'           => '20px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_widgets_title_font_size', array(
        'section'     => 'post_widgets_title_font_section',
        'label'       => __('Font Size', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );
        
    // Widgets Title Line Height
    $wp_customize->add_setting( 'liveblog_widgets_title_line_height', array(
        'default'           => '26px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'liveblog_sanitize_text',
    ) );
    $wp_customize->add_control( 'liveblog_widgets_title_line_height', array(
        'section'     => 'post_widgets_title_font_section',
        'label'       => __('Line Height', 'liveblog'),
        'description' => __('Value in pixels', 'liveblog'),
        'type'        => 'text'
    ) );
}
}
add_action( 'customize_register', 'liveblog_typography_panel' );
?>