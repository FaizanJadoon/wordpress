<header class="main-header clearfix">
    <div class="top-border">
        <span class="border-list"></span>
        <span class="border-list"></span>
        <span class="border-list"></span>
        <span class="border-list"></span>
        <span class="border-list"></span>
        <span class="border-list"></span>
    </div>
    <div class="header clearfix">
        <div class="container">
            <div class="logo-wrap">
                <?php $liveblog_image_logo = get_theme_mod( 'liveblog_image_logo' ); ?>
                <?php if (!empty($liveblog_image_logo)) { ?>
                    <div id="logo">
                        <a href="<?php echo esc_url(home_url( '/' )); ?>">
                            <img src="<?php echo esc_url( $liveblog_image_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                <?php } else { ?>
                    <?php if( is_front_page() || is_home() || is_404() ) { ?>
                        <h1 id="logo">
                            <a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
                        </h1>
                    <?php } else { ?>
                        <h2 id="logo">
                            <a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
                        </h2>
                    <?php } ?>
                <?php } ?>
                <?php if (get_theme_mod( 'tagline' ) == 'show') { ?>
                    <span class="tagline">
                        <?php bloginfo( 'description' ); ?>
                    </span>
                <?php } ?>
            </div>
        </div><!-- .container -->
    </div><!-- .header -->
    <div class="main-menu menu-two clearfix">
        <?php get_template_part('template-parts/nav-menu'); ?>
    </div><!--.main-menu-->
</header>