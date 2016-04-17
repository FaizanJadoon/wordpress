<?php
if ( ! function_exists( 'liveblog_main_panel' ) ) {
	function liveblog_main_panel( $wp_customize ) {
        /*-----------------------------------------------------------*
        * Defining our own 'Social Profiles' section
        *-----------------------------------------------------------*/
        $wp_customize->add_section( 'social_profiles', array(
            'title'       => __('Social Profiles','liveblog'),
            'description' => __('Enter links to your social profiles here to display them in header.', 'liveblog'),
            'priority'    => 105
        ) );
        
		// Facebook
		$wp_customize->add_setting( 'facebook_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'facebook_url', array(
            'section'  => 'social_profiles',
            'label'    => __('Facebook', 'liveblog'),
            'priority' => 10,
            'type'     => 'text'
        ) );
        
		// Twitter
		$wp_customize->add_setting( 'twitter_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'twitter_url', array(
            'section'   => 'social_profiles',
            'label'     => __('Twitter', 'liveblog'),
            'priority'  => 20,
            'type'      => 'text'
        ) );
        
		// Google Plus
		$wp_customize->add_setting( 'gplus_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'gplus_url', array(
            'section'  => 'social_profiles',
            'label'    => __('Google Plus', 'liveblog'),
            'priority' => 30,
            'type'     => 'text'
        ) );
        
		// Instagram
		$wp_customize->add_setting( 'instagram_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'instagram_url', array(
            'section'  => 'social_profiles',
            'label'    => __('Instagram', 'liveblog'),
            'priority' => 40,
            'type'     => 'text'
        ) );
        
		// YouTube
		$wp_customize->add_setting( 'youtube_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'youtube_url', array(
            'section'  => 'social_profiles',
            'label'    => __('YouTube', 'liveblog'),
            'priority' => 50,
            'type'     => 'text'
        ) );
        
		// Pinterest
		$wp_customize->add_setting( 'pinterest_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'pinterest_url', array(
            'section'  => 'social_profiles',
            'label'    => __('Pinterest', 'liveblog'),
            'priority' => 60,
            'type'     => 'text'
        ) );
        
		// Flickr
		$wp_customize->add_setting( 'flickr_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'flickr_url', array(
            'section'  => 'social_profiles',
            'label'    => __('Flickr', 'liveblog'),
            'priority' => 70,
            'type'     => 'text'
        ) );
        
		// RSS
		$wp_customize->add_setting( 'rss_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'rss_url', array(
            'section'  => 'social_profiles',
            'label'    => __('RSS', 'liveblog'),
            'priority' => 70,
            'type'     => 'text'
        ) );
		// LinkedIn
		$wp_customize->add_setting( 'linkedIn_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'linkedIn_url', array(
            'section'  => 'social_profiles',
            'label'    => __('LinkedIn', 'liveblog'),
            'priority' => 80,
            'type'     => 'text'
        ) );
		// Reddit
		$wp_customize->add_setting( 'reddit_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'reddit_url', array(
            'section'  => 'social_profiles',
            'label'    => __('Reddit', 'liveblog'),
            'priority' => 90,
            'type'     => 'text'
        ) );
		// Tumblr
		$wp_customize->add_setting( 'tumblr_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        ) );
		$wp_customize->add_control( 'tumblr_url', array(
            'section'  => 'social_profiles',
            'label'    => __('Tumblr', 'liveblog'),
            'priority' => 100,
            'type'     => 'text'
        ) );
    }
}
add_action( 'customize_register', 'liveblog_main_panel' );
?>