<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

get_header(); ?>
	<div id="page">
		<div class="main-content">
			<div class="archive-page">
				<div id="content" class="content-area archive-content-area">
					<div class="content-archive">
						<div class="author-box author-desc-box">
							<h4 class="author-box-title widget-title uppercase"><?php _e('Author Description','liveblog'); ?></h4>
							<div class="author-box-content">
								<div class="author-box-avtar">
									<?php echo get_avatar( get_the_author_meta('email'), '140' ); ?>
								</div>
								<div class="author-info-container">
									<div class="author-info">
										<div class="author-head">
											<h5><?php the_author_meta('display_name'); ?></h5>
										</div>
										<p><?php the_author_meta('description') ?></p>
									</div>
								</div>
							</div>
						</div><!--.author-desc-box-->
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
									get_template_part( 'template-parts/post-formats/content', 'none' );

								endif;
							?>
						</div><!--.content-->
						<?php 
							// Previous/next page navigation.
							liveblog_paging_nav();
						?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div><!--.archive-page-->
		</div><!--.main-content-->
    </div><!--#page-->
<?php get_footer(); ?>