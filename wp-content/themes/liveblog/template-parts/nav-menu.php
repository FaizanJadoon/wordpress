<div class="center-width clearfix">
    <div class="menu-btn off-menu fa fa-align-justify" data-effect="st-effect-4"></div>
    <div class="main-nav">
        <nav class="nav-menu" >
            <div id="close-button"><i class="fa fa-times"></i></div>
            <?php if ( has_nav_menu( 'main-menu' ) ) {
                wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'container' => '' ) );
            } ?>
        </nav>
    </div><!-- .main-nav -->
    <?php if ( get_theme_mod( 'header_social_links' ) == 'show' ) {
        get_template_part('template-parts/social-links');
    } ?>
</div>