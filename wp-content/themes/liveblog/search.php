<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage piework
 * @since PieWork 1.0
 */

get_header(); ?>
<div class="main-wrapper clearfix">
	<div id="page">
		<div class="main-content">
		<div class="content-area home-content-area">
			<div class="content-home">
				<h1 class="section-heading uppercase"><?php _e('Search Results', 'liveblog'); ?></h1>
				<div class="content">
					<?php
						// Start the Loop.
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
		<?php get_sidebar(); ?>
		</div><!--.main-->
	<?php get_footer(); ?>