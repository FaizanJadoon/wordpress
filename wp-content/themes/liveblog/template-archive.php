<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>

<div class="main-wrapper clearfix">
	<div id="page">
		<div class="main-content">
			<div class="content-area">
				<div class="content-page">
					<div class="content-detail">
						<div class="page-content">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
								<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
									<div class="post-home">
										<header>
											<h1 class="title page-title"><?php the_title(); ?></h1>
										</header>
										<div class="post-content single-page-content">
											<?php the_content(); ?>
										</div>
									</div>
								</article>
								<?php endwhile; ?>
								<?php else : ?>
									<div class="post">
										<div class="single-page-content error-page-content">
											<p><strong><?php _e('Nothing Found', 'liveblog'); ?></strong></p>
											<?php get_search_form(); ?>
										</div><!--noResults-->
									</div>
								<?php endif; ?>
								<div class="post-home">
									<div class="archive-template-content">
										<div class="archive-col">
											<h3 class="widget-title uppercase"><?php _e('Recent Posts','liveblog'); ?></h3>
											<ul>
												<?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 20, 'format' => 'html' ) ); ?>
											</ul>
										</div>
										<div class="archive-col">
											<h3 class="widget-title uppercase"><?php _e('Archives by Categories','liveblog'); ?></h3>
											<ul>
												<?php wp_list_categories('title_li='); ?>
											</ul>
										</div>
										<div class="archive-col">
											<h3 class="widget-title uppercase"><?php _e('Archives by Month','liveblog'); ?></h3>
											<ul>
												<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>
											</ul>
										</div>
										<div class="archive-col">
											<h3 class="widget-title uppercase"><?php _e('Archives by Year','liveblog'); ?></h3>
											<ul>
												<?php wp_get_archives( array( 'type' => 'yearly', 'limit' => 12 ) ); ?>
											</ul>
										</div>
										<div class="archive-col">
											<h3 class="widget-title uppercase"><?php _e('Archives by Tags','liveblog'); ?></h3>
											<ul>
											<?php
												$tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );
												foreach ( (array) $tags as $tag ) {
												echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a></li>';
												}
											?>
											</ul>
										</div>
										<div class="archive-col">
											<h3 class="widget-title uppercase"><?php _e('Authors','liveblog'); ?></h3>
											<ul>
												<?php wp_list_authors(); ?>
											</ul>
										</div>
									</div><!--.archive-template-content-->
							</div>
						</div><!--.page-content-->
					</div><!--.content-detail-->
				</div>
			</div><!--content-area-->
			<?php get_sidebar(); ?>
		</div><!--.main-->
<?php get_footer(); ?>