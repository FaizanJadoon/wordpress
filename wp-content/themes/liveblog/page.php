<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 */

get_header(); ?>
	<div id="page">
		<div class="main-content">
			<div class="detail-page">
				<div class="content-area single-content-area">
					<div class="content-page">
						<div class="content-detail">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php if ( true == get_theme_mod( 'breadcrumbs', true )) { ?>
									<div class="breadcrumbs">
										<?php liveblog_breadcrumb(); ?>
									</div>
								<?php }?>
								<div class="page-content">
									<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
										<div class="post-box">
											<header>
												<h1 class="title page-title"><?php the_title(); ?></h1>
											</header>
											
											<div class="post-content single-page-content">
												<?php the_content(); ?>
												<?php edit_post_link( __( 'Edit', 'liveblog' ), '<span class="edit-link">', '</span>' ); ?>
												<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
											</div>
										</div><!--.post-box-->
									</article><!--blog post-->
								</div>	
								<?php
									comments_template();
									
									endwhile;
									
									else :
										// If no content, include the "No posts found" template.
										get_template_part( 'template-parts/post-formats/content', 'none' );
									endif;
								?>
						</div>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div><!--.detail-page-->
		</div><!--.main-content-->
<?php get_footer();?>