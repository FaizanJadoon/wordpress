<?php get_header(); ?>
	<div id="page">
		<div class="detail-page">
			<div class="main-content">
				<div id="content" class="content-area single-content-area">
					<div class="content-single">
						<div class="content-detail">
						<?php
							if (have_posts()) : while (have_posts()) : the_post();
                                if ( get_theme_mod( 'breadcrumbs', '1' ) == '1' ) { ?>
                                    <div class="breadcrumbs">
                                        <?php liveblog_breadcrumb(); ?>
                                    </div><?php
                                } ?>
                                <div class="single-content">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <div class="post-box">
                                            <header>
                                                <h1 class="title entry-title single-title"><?php the_title(); ?></h1>
                                            </header><!--.header-->
                                            <?php
                                                // Post Meta
                                                get_template_part('template-parts/post-meta');

                                                if ( get_theme_mod( 'liveblog_featured_content', '1' ) ) {
                                                    if ( has_post_thumbnail() ) { ?>
                                                       <div class="post-common-type">
                                                            <div class="featured-single">
                                                                <?php the_post_thumbnail('liveblog-featured'); ?>
                                                            </div>
                                                        </div><?php
                                                    }
                                                }
                                            ?>
                                            <div class="post-inner">
                                                <div class="post-content entry-content single-post-content">

                                                    <?php the_content(); ?>
                                                    
                                                    <?php the_tags(); ?>

                                                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'liveblog' ), 'after' => '</div>' ) ); ?>
                                                </div><!--.single-post-content-->
                                            </div><!--.post-inner-->
                                        </div><!--.post-box-->
                                    </article>
                                </div><!--.single-content-->
						  </div>
                            <?php 
                                if ( get_theme_mod( 'next_prev_links', '1' ) == '1' ) {
                                    // Previous/next post navigation.
                                    liveblog_post_nav();
                                }

								if ( get_theme_mod( 'author_box', '1' ) == '1' ) {
									get_template_part('template-parts/author-box');
								}

								// Related Posts
								get_template_part('template-parts/related-posts');
								
								// Comments Template
								comments_template();

								endwhile;
								
								else :
									// If no content, include the "No posts found" template.
									get_template_part( 'template-parts/post-formats/content', 'none' );
									
								endif;
							?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div><!--.detail-page-->
		</div><!--.main-content-->
<?php get_footer();?>