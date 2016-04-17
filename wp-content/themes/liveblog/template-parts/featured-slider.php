<div class="featured-section clearfix loading">
	<div class="featuredslider">
		<ul class="slides">
			<?php
				$featured_slider_cat = get_theme_mod('featured_slider_cat');
				$featured_slider_posts = get_theme_mod('f_slider_posts_count', '4');
				$featured_posts = new WP_Query("category_name=".$featured_slider_cat."&ignore_sticky_posts=1&orderby=date&order=DESC&showposts=".$featured_slider_posts);
				
				if($featured_posts->have_posts()) : while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
				<li <?php post_class(); ?>>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
						<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail('liveblog-slider');
							} else {
								echo '<img alt="Featured Image" src="' . get_stylesheet_directory_uri() . '/images/770x355.png" width="770"/>';
							} ?>
						<div class="featured-content">
							<div class="post-inner">
								<?php if ( get_theme_mod( 'post_cats', '1' ) ) { ?>
									<div class="slider-meta">
										<?php
											$category = get_the_category();
											if ($category) {
												get_template_part('template-parts/post-format-icons');
												?>
                                        <div class="post-date">
                                            <i class="fa fa-calendar"></i>
                                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" title="<?php echo esc_html( get_the_date() ); ?>">
                                                <?php the_time('F d, Y'); ?>
                                            </time>
                                        </div>
                                        
                                        
                                        <?php
                                                
											}
										?>
									</div>
								<?php } ?>
								<header>
									<h2 class="f-title uppercase">
										<?php the_title(); ?>
									</h2>
								</header><!--.header-->
                                <div class="post-content entry-summary">
                                    <?php echo '<p>' . liveblog_excerpt('20') . '</p>'; ?>
                                </div><!-- .entry-summary -->
                                <div class="read-more">
                                    <?php _e('Read More','liveblog'); ?>
                                </div>
							</div>
						</div><!--.featured-content-->
					</a>
				</li>
			<?php endwhile; wp_reset_postdata(); endif; ?>
		</ul>
	</div><!--.featuredslider-->
</div>