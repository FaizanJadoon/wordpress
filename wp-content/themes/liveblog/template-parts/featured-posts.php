<div class="featured-posts clearfix">
    <?php
        $featured_cat = get_theme_mod('featured_posts_cat');
		$fcount = 1;
		$featured_a = new WP_Query("category_name=".$featured_cat."&orderby=date&order=DESC&ignore_sticky_posts=1&showposts=3");
	
		if($featured_a->have_posts()) : while ($featured_a->have_posts()) : $featured_a->the_post(); ?>
		
			<div <?php post_class("featured-post"); ?>>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('liveblog-featured390');
						} else {
							echo '<img alt="Featured Image" width="390" height="210" src="' . get_stylesheet_directory_uri() . '/images/390x210.png" />';
						} ?>
					<div class="featured-content">
						<div class="post-inner">
							<?php if ( get_theme_mod( 'post_cats', '1' ) ) { ?>
									<?php
										$category = get_the_category();
										if ($category) {
											get_template_part('template-parts/post-format-icons');						
																					
										}
									?>
							<?php } ?>
							<header>
								<h2 class="title f-title uppercase">
									<?php the_title(); ?>
								</h2>
							</header><!--.header-->
                            <div class="post-date">
                                <i class="fa fa-calendar"></i>
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" title="<?php echo esc_html( get_the_date() ); ?>">
                                    <?php the_time('F d, Y'); ?>
                                </time>
                            </div>
                            <div class="read-more">
                                <?php _e('Read More','liveblog'); ?>
                            </div>
						</div><!-- .post-inner -->
					</div><!--.featured-content-->
				</a>
			</div><!--.featured-post-->
		<?php $fcount++; endwhile; wp_reset_postdata(); endif; ?>
</div><!--.featured-posts-->