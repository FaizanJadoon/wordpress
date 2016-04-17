<?php
/**
* General Settings for Theme Customizer
*/

if ( ! function_exists( 'liveblog_general_panel' ) ) {
	function liveblog_general_panel( $wp_customize ) {
        $wp_customize->add_panel( 'general_settings', array(
            'priority'       => 85,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('General Settings','liveblog'),
            'description'    => __('Here you can change general settings of theme','liveblog'),
        ) );
        $wp_customize->add_section( 'main_settings', array(
            'title'         => __('Main Settings', 'liveblog'),
            'description'   => __('Common settings for your theme', 'liveblog'),
            'priority'      => 10,
            'panel'         => 'general_settings',
        ) );

        // Regular Logo
        $wp_customize->add_setting( 'liveblog_image_logo', array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control(
            new WP_Customize_Image_Control( $wp_customize, 'liveblog_image_logo', array(
                'priority'  => 10,
                'label'     => __('Regular Logo','liveblog'),
                'section'   => 'main_settings',
                'settings'  => 'liveblog_image_logo'
            )
        ) );

        // Pagination Type
        $wp_customize->add_setting( 'pagination_type', array(
            'default'  => 'num',
            'sanitize_callback' => 'liveblog_sanitize_choices'
        ) );
        $wp_customize->add_control( 'pagination_type', array(
            'priority' => 40,
            'type'     => 'radio',
            'label'    => __('Pagination Type','liveblog'),
            'section'  => 'main_settings',
            'choices'  => array(
                'num'      => __('Numbered','liveblog'),
                'nextprev' => __('Next/Prev','liveblog'),
            ),
        ) );

        // Scroll to Top Button
        $wp_customize->add_setting( 'scroll_top', array(
            'default'  => 'show',
            'sanitize_callback' => 'liveblog_sanitize_choices'
        ) );
        $wp_customize->add_control( 'scroll_top', array(
            'priority' => 50,
            'type'     => 'radio',
            'label'    => __('Scroll to Top Button','liveblog'),
            'section'  => 'main_settings',
            'choices'  => array(
                'show' => __('Show','liveblog'),
                'hide' => __('Hide','liveblog'),
            ),
        ) );
        
        /*-----------------------------------------------------------*
        * Header section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'liveblog_header_options', array(
            'title'       => __('Header','liveblog' ),
            'description' => __('Show or hide various elements available on header.','liveblog' ),
            'priority'    => 100,
            'panel'       => 'general_settings',
        ) );
        
        // Header Style
        $wp_customize->add_setting( 'header_style', array(
            'default'           => '1',
            'sanitize_callback' => 'liveblog_sanitize_choices'
        ) );
        $wp_customize->add_control( 'header_style', array(
            'type'    => 'radio',
            'label'   => __('Header Style','liveblog' ),
            'section' => 'liveblog_header_options',
            'choices' => array(
                '1' => __('Style 1','liveblog' ),
                '2' => __('Style 2','liveblog' ),
                '3' => __('Style 3','liveblog' ),
            ),
        ) );
        
        // Tagline
        $wp_customize->add_setting( 'tagline', array(
            'default'           => 'hide',
            'sanitize_callback' => 'liveblog_sanitize_choices'
        ) );
        $wp_customize->add_control( 'tagline', array(
            'type'    => 'radio',
            'label'   => __('Tagline','liveblog'),
            'section' => 'liveblog_header_options',
            'choices' => array(
                'show' => __('Show','liveblog'),
                'hide' => __('Hide','liveblog'),
            ),
        ) );
        
        // Sticky Menu
        $wp_customize->add_setting( 'sticky_menu', array(
            'default' => 'disable',
            'sanitize_callback' => 'liveblog_sanitize_choices'
        ) );
        $wp_customize->add_control( 'sticky_menu', array(
            'type'    => 'radio',
            'label'   => __('Sticky Menu','liveblog'),
            'section' => 'liveblog_header_options',
            'choices' => array(
                'enable'  => __('Enable','liveblog'),
                'disable' => __('Disable','liveblog'),
            ),
        ) );

        /*-----------------------------------------------------------*
        * Post Options section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'post_options', array(
            'title'     => __('Post Options','liveblog'),
            'priority'  => 90,
            'panel'     => 'general_settings',
        ) );
        
        // Show Featured Content
        $wp_customize->add_setting( 'liveblog_featured_content', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'liveblog_featured_content', array(
            'priority' => 10,
            'section'  => 'post_options',
            'label'    => __('Show Featured Content on Detail Post','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Post Icon
        $wp_customize->add_setting( 'post_icon', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'post_icon', array(
            'priority' => 12,
            'section'  => 'post_options',
            'label'    => __('Show Post Format Icon','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Post Author
        $wp_customize->add_setting( 'post_author', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'post_author', array(
            'priority' => 20,
            'section'  => 'post_options',
            'label'    => __('Show Post Author','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Post Date
        $wp_customize->add_setting( 'post_date', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'post_date', array(
            'priority' => 22,
            'section'  => 'post_options',
            'label'    => __('Show Post Date','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Post Tags
        $wp_customize->add_setting( 'post_tags', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'post_tags', array(
            'priority' => 22,
            'section'  => 'post_options',
            'label'    => __('Show Post Tags','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Post Comments
        $wp_customize->add_setting( 'post_comments', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'post_comments', array(
            'priority' => 24,
            'section'  => 'post_options',
            'label'    => __('Show Post Comments','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Post Categories
        $wp_customize->add_setting( 'post_cats', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'post_cats', array(
            'priority' => 28,
            'section'  => 'post_options',
            'label'    => __('Show Post Categories','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Breadcrumbs
        $wp_customize->add_setting( 'breadcrumbs', array(
            'default'           => 'true',
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'breadcrumbs', array(
            'priority' => 30,
            'section'  => 'post_options',
            'label'    => __('Enable Breadcrumbs?','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Author Info Box
        $wp_customize->add_setting( 'author_box', array(
            'default'           => 'true',
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'author_box', array(
            'priority' => 40,
            'section'  => 'post_options',
            'label'    => __('Author Info Box','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Next/Prev Article Links
        $wp_customize->add_setting( 'next_prev_links', array(
            'default'           => 'true',
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'next_prev_links', array(
            'priority' => 50,
            'section'  => 'post_options',
            'label'    => __('Next/Prev Article Links','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Related Posts Divide
        $wp_customize->add_setting( 'divide_related', array(
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control(
            new liveblog_Customize_Divide_Control( $wp_customize, 'divide_related', array(
                'priority' => 52,
                'label'    => __('Related Posts','liveblog'),
                'section'  => 'post_options',
                'settings' => 'divide_related'
            )
        ) );
        
        // Related Posts
        $wp_customize->add_setting( 'related_posts', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'related_posts', array(
            'priority' => 60,
            'section'  => 'post_options',
            'label'    => __('Show Related Posts','liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Related Posts By
        $wp_customize->add_setting( 'related_posts_by', array(
            'default'           => 'categories',
            'sanitize_callback' => 'liveblog_sanitize_choices'
        ) );
        $wp_customize->add_control( 'related_posts_by', array(
            'priority' => 70,
            'section'  => 'post_options',
            'label'    => __('Related Posts By','liveblog'),
            'type'     => 'radio',
            'choices'  => array(
                'categories' => __('Categories','liveblog'),
                'tags'       => __('Tags','liveblog'),
            )
        ) );
        
        // Related Posts Count
        $wp_customize->add_setting( 'related_posts_count', array(
            'default'           => '3',
            'sanitize_callback' => 'absint',
        ) );
        $wp_customize->add_control( 'related_posts_count', array(
            'priority' => 80,
            'section'  => 'post_options',
            'label'    => __('Number of Related Posts','liveblog'),
            'type'     => 'text'
        ) );

        /*-----------------------------------------------------------*
        * Footer section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'footer_section', array(
            'title'     => __('Footer','liveblog'),
            'priority'  => 120,
            'panel'     => 'general_settings',
        ) );
        
        // Show Footer Credit
        $wp_customize->add_setting( 'footer_credit', array(
            'default'           => 1,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'footer_credit', array(
            'priority' => 10,
            'section'  => 'footer_section',
            'label'    => __('Show Footer Credit','liveblog'),
            'type'     => 'checkbox'
        ) );
    }
}
add_action( 'customize_register', 'liveblog_general_panel' );
?>