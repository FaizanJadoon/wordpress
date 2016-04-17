<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
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
						<h1 class="category-title uppercase">
							<?php
								if ( is_tag() ) :
									printf( __( 'Tag Archives: %s', 'liveblog' ), single_tag_title( '', false ) );

								elseif ( is_day() ) :
									printf( __( 'Daily Archives: %s', 'liveblog' ), get_the_date() );

								elseif ( is_month() ) :
									printf( __( 'Monthly Archives: %s', 'liveblog' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'liveblog' ) ) );

								elseif ( is_year() ) :
									printf( __( 'Yearly Archives: %s', 'liveblog' ), get_the_date( _x( 'Y', 'yearly archives date format', 'liveblog' ) ) );

								else :
									_e( 'Archives', 'liveblog' );

								endif;
							?>
						</h1>
						<div class="content content-archive">
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