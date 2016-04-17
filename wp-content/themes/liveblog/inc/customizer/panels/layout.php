<?php
/**
* Layout Options for Theme Customizer
*/

if ( ! function_exists( 'liveblog_layout_panel' ) ) {
	function liveblog_layout_panel( $wp_customize ) {
        $wp_customize->add_panel( 'layout_panel', array(
            'priority'       => 91,
            'capability'     => 'edit_theme_options',
            'title'          => __('Layout Options', 'liveblog'),
            'description'    => __('Here you can change layout options of theme', 'liveblog'),
        ) );
        $wp_customize->add_section( 'layout_options', array(
            'title'       => __('General Layout Settings', 'liveblog'),
            'description' => __('Change settings related to layout of home, archive or single pages.', 'liveblog'),
            'priority'    => 1,
            'panel'       => 'layout_panel',
        ) );
        
        // Responsive Layout
        $wp_customize->add_setting( 'responsive_layout', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'responsive_layout', array(
            'section'   => 'layout_options',
            'label'     => __('Enable Responsive Layout?', 'liveblog'),
            'type'      => 'checkbox'
        ) );
        
        // Layout Type
        $wp_customize->add_setting( 'layout_type', array(
            'default'           => 'full',
            'sanitize_callback' => 'liveblog_sanitize_layout'
        ) );
        $wp_customize->add_control( 'layout_type', array(
            'type'      => 'radio',
            'label'     => __('Layout Type', 'liveblog'),
            'section'   => 'layout_options',
            'choices'   => array(
                'full'  => __('Full Width', 'liveblog'),
                'boxed' => __('Boxed', 'liveblog'),
            ),
        ) );
        
        // Main Layout
        $wp_customize->add_section( 'main_layout_section', array(
            'title'       => __('Main Layout', 'liveblog'),
            'description' => __('Change main layout of homepage and search results pages.', 'liveblog'),
            'priority'    => 5,
            'panel'       => 'layout_panel',
        ) );
        $wp_customize->add_setting( 'main_layout', array(
            'default'   => 'cblayout',
            'sanitize_callback' => 'liveblog_sanitize_layout'
        ) );
        $wp_customize->add_control(
            new liveblog_Layout_Picker_Custom_Control ( $wp_customize, 'main_layout', array(
                'label'     => __('Main Layout', 'liveblog'),
                'section'   => 'main_layout_section',
                'settings'  => 'main_layout',
                'choices'   => array(
                    'cblayout' => __('Main 2 Col', 'liveblog'),
                    'bclayout' => __('Main 2 Col Left Sidebar', 'liveblog'),
                )
            )
        ) );
        
        // Archive Layout
        $wp_customize->add_section( 'archive_layout_section', array(
            'title'       => __('Archive Layout', 'liveblog'),
            'description' => __('Change layout of archives (Categories, author pages, tags etc).', 'liveblog'),
            'priority'    => 10,
            'panel'       => 'layout_panel',
        ) );
        $wp_customize->add_setting( 'archive_layout', array(
            'default'   => 'cblayout',
            'sanitize_callback' => 'liveblog_sanitize_layout'
        ) );
        $wp_customize->add_control(
            new liveblog_Layout_Picker_Custom_Control ( $wp_customize, 'archive_layout', array(
                'label'     => __('Archive Layout', 'liveblog'),
                'section'   => 'archive_layout_section',
                'settings'  => 'archive_layout',
                'choices'   => array(
                    'cblayout' => __('Archive 2 Col', 'liveblog'),
                    'bclayout' => __('Archive 2 Col Left Sidebar', 'liveblog'),
                )
            )
        ) );
        
        // Single Layout
        $wp_customize->add_section( 'single_layout_section', array(
            'title'       => __('Single Layout', 'liveblog'),
            'description' => __('Change layout of single posts and pages.', 'liveblog'),
            'priority'    => 15,
            'panel'       => 'layout_panel',
        ) );
        $wp_customize->add_setting( 'single_layout', array(
            'default'   => 'cblayout',
            'sanitize_callback' => 'liveblog_sanitize_layout'
        ) );
        $wp_customize->add_control(
            new liveblog_Layout_Picker_Custom_Control ( $wp_customize, 'single_layout', array(
                'label'     => __('Single Layout', 'liveblog'),
                'section'   => 'single_layout_section',
                'settings'  => 'single_layout',
                'choices'   => array(
                    'cblayout' => __('Single 2 Col', 'liveblog'),
                    'bclayout' => __('Single 2 Col Left Sidebar', 'liveblog'),
                )
            )
        ) );
    }
}
add_action( 'customize_register', 'liveblog_layout_panel' );
?>