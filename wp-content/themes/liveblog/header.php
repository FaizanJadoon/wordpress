<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body id="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
	<div class="st-container">
		<div class="main-container<?php if( get_theme_mod( 'layout_type' ) == 'boxed' ) { echo ' boxed-layout'; } ?> <?php liveblog_layout_class(); ?>">
			<div class="menu-pusher">
				<!-- START HEADER -->
                <?php
                    $liveblog_header_style = get_theme_mod( 'header_style' );
					if ( !empty( $liveblog_header_style ) )  {
						$liveblog_header_style = get_theme_mod( 'header_style' );
					} else {
						$liveblog_header_style = '1';
					}
                    get_template_part( 'template-parts/header-'.intval($liveblog_header_style ));

                    // Featured Slider
                    if ( is_home() || is_front_page() ) {
                        if(get_theme_mod('featured_slider')) {
                            if(!is_paged()) {
                                get_template_part('template-parts/featured-slider');
                            }
                        }
                    }
                ?>
				<!-- END HEADER -->
                <div class="main-wrapper clearfix">