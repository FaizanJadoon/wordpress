<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

get_header(); ?>
	<div id="page">
		<?php
		if(get_theme_mod('featured_posts')) {
			if(!is_paged()) {
				get_template_part('template-parts/featured-posts');
			}
		} ?>
		<div class="main-content clearfix">
            <div id="content" class="content-area home-content-area">
                <div class="content-home">
                    <div class="content">
                        <?php
                            if (have_posts()) : while (have_posts()) : the_post();

                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */

                            get_template_part( 'content', get_post_format() );

                            endwhile;

                            else:
                                // If no content, include the "No posts found" template.
                                get_template_part( 'content', 'none' );

                            endif;
                        ?>
                    </div><!--content-->
                    <?php 
                        // Previous/next page navigation.
                        liveblog_paging_nav();
                    ?>
                </div><!--content-page-->
            </div><!--content-area-->
		<?php
			$liveblog_layout_array = array(
				'clayout',
				'glayout',
				'flayout'
			);

			if(!in_array(get_theme_mod('main_layout'),$liveblog_layout_array)) {
				get_sidebar();
			}
		?>
		</div><!--.main-->
    </div><!--#page-->
<?php get_footer();?>