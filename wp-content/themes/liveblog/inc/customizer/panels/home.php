<?php
/**
* Home Options for Theme Customizer
*/

if ( ! function_exists( 'liveblog_home_panel' ) ) {
	function liveblog_home_panel( $wp_customize ) {
        $wp_customize->add_panel( 'home_options', array(
            'priority'    => 98,
            'capability'  => 'edit_theme_options',
            'title'       => __('Homepage', 'liveblog'),
            'description' => __('Here you can change typography of theme', 'liveblog'),
        ) );
        
        /*-----------------------------------------------------------*
        * Home Content section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'liveblog_home_content_section', array(
            'title'         => __('Home Content', 'liveblog'),
            'description'   => __('Change settings that affect homepage of your blog.', 'liveblog'),
            'priority'      => 1,
            'panel'         => 'home_options',
        ) );
        
        // Home Content
        $wp_customize->add_setting( 'liveblog_home_content', array(
            'default'           => 'excerpt',
            'sanitize_callback' => 'liveblog_sanitize_choices'
        ) );
        $wp_customize->add_control( 'liveblog_home_content', array(
            'type'          => 'radio',
            'label'         => __('Home Content', 'liveblog'),
            'section'       => 'liveblog_home_content_section',
            'choices'       => array(
                'excerpt'       => __('Excerpt', 'liveblog'),
                'full_content'  => __('Full Content', 'liveblog'),
            ),
        ) );
        
        // Excerpt Length
        $wp_customize->add_setting( 'liveblog_excerpt_length', array(
            'default'           => '40',
            'sanitize_callback' => 'liveblog_sanitize_text'
        ) );
        $wp_customize->add_control( 'liveblog_excerpt_length', array(
            'section'       => 'liveblog_home_content_section',
            'label'         => __('Excerpt Length', 'liveblog'),
            'type'          => 'text'
        ) );
        
        /*-----------------------------------------------------------*
        * Featured section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'liveblog_featured_section', array(
            'title'         => __('Featured Slider', 'liveblog'),
            'description'   => __('Show or hide featured slider below header on homepage.', 'liveblog'),
            'priority'      => 5,
            'panel'         => 'home_options',
        ) );
        
        // Show Featured Slider
        $wp_customize->add_setting( 'featured_slider', array(
            'default'           => 0,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'featured_slider', array(
            'priority' => 10,
            'section'  => 'liveblog_featured_section',
            'label'    => __('Show Featured Slider', 'liveblog'),
            'type'     => 'checkbox'
        ) );
        
        // Featured Slider Posts Count
        $wp_customize->add_setting( 'f_slider_posts_count', array(
            'default'           => '4',
            'sanitize_callback' => 'liveblog_sanitize_text'
        ) );
        $wp_customize->add_control( 'f_slider_posts_count', array(
            'section'  => 'liveblog_featured_section',
            'label'    => __('Featured Slider Posts Count', 'liveblog'),
            'type'     => 'text'
        ) );
        
        // Featured Slider Cat
        $wp_customize->add_setting( 'featured_slider_cat', array(
            'default'           => 'uncategorized',
            'sanitize_callback' => 'liveblog_sanitize_cat'
        ) );
        $wp_customize->add_control( 'featured_slider_cat', array(
            'settings' => 'featured_slider_cat',
            'label'    => __('Featured Slider Cat', 'liveblog'),
            'section'  => 'liveblog_featured_section',
            'type'     => 'select',
            'choices'  => liveblog_get_categories_select()
        ) );
        
        // Featured Posts
        $wp_customize->add_section( 'liveblog_featured_posts_section', array(
            'title'         => __('Featured Posts', 'liveblog'),
            'description'   => __('Show or hide featured posts on homepage.', 'liveblog'),
            'priority'      => 10,
            'panel'         => 'home_options',
        ) );
        // Show Featured Posts
        $wp_customize->add_setting( 'featured_posts', array(
            'default'           => 0,
            'sanitize_callback' => 'liveblog_sanitize_checkbox'
        ) );
        $wp_customize->add_control( 'featured_posts', array(
            'priority'  => 10,
            'section'   => 'liveblog_featured_posts_section',
            'label'     => __('Show Featured Posts', 'liveblog'),
            'type'      => 'checkbox'
        ) );
        
        // Featured Posts Cat
        $wp_customize->add_setting( 'featured_posts_cat', array(
            'default'           => 'uncategorized',
            'sanitize_callback' => 'liveblog_sanitize_cat'
        ) );
        $wp_customize->add_control( 'featured_posts_cat', array(
            'settings'  => 'featured_posts_cat',
            'label'     => __('Featured Posts Cat', 'liveblog'),
            'section'   => 'liveblog_featured_posts_section',
            'type'      => 'select',
            'choices'   => liveblog_get_categories_select()
        ) );
    }
}
add_action( 'customize_register', 'liveblog_home_panel' );
?>