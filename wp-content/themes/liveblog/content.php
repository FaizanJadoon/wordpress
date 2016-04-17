<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
        <header>
            <h2 class="title entry-title">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
        </header><!--.header-->
        <?php
            if ( has_post_thumbnail() ) { ?>
               <div class="post-common-type">
                    <div class="post-meta-dark clearfix">
                        <?php
                          // Post Meta
                          get_template_part('template-parts/post-meta');
                        ?>
                   </div>
                   <?php if ( has_post_format ('image')) { ?>
                        <?php $liveblog_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                        <a href="<?php echo esc_url( $liveblog_url ); ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail featured-thumbnail-big">
                            <?php the_post_thumbnail('liveblog-featured'); ?>
                        </a>
                   <?php } else { ?>
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail featured-thumbnail-big">
                            <?php the_post_thumbnail('liveblog-featured'); ?>
                        </a>
                   <?php } ?>
                </div><?php
            } else {
                // Post Meta
                get_template_part('template-parts/post-meta');
            }
        ?>
        <div class="post-inner">
            <?php if ( is_search() ) { ?>
                <div class="post-content entry-summary clearfix">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php } else { ?>
                <div class="post-content entry-content clearfix">
                    <?php
                    $liveblog_home_content = get_theme_mod( 'liveblog_home_content', '1' );
                    if( $liveblog_home_content == 'full_content' ) {
                        the_content( sprintf(
                            __( 'Contonue Reading %s', 'liveblog' ),
                            the_title( '<span class="screen-reader-text">', '</span>', false )
                        ) );
                    } else {
                        the_excerpt(); ?>
                        <div class="read-more">
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php _e('Continue Reading','liveblog'); ?> <span class="screen-reader-text"><?php the_title(); ?></span></a>
                        </div>
                    <?php } ?>
                </div><!--post-content-->
            <?php } ?>	
        </div><!--.post-inner-->
	</div><!--.post-box-->
</article>