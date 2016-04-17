<div class="post-meta">
	<?php 
        if ( get_theme_mod( 'post_icon', '1' ) ) {
            // Post Format Icons
            get_template_part('template-parts/post-format-icons');
        }
        if ( get_theme_mod( 'post_author', '1' ) ) { ?>
            <span class="post-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span><?php
        }
        if ( get_theme_mod( 'post_date', '1' ) ) { ?>
            <span class="post-date">
                <i class="fa fa-calendar"></i>
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" title="<?php echo esc_html( get_the_date() ); ?>">
                    <?php the_time('F d, Y'); ?>
                </time>
            </span><?php
        }
        if ( get_theme_mod( 'post_cats', '1' ) ) { ?>
		  <span class="post-cats"><i class="fa fa-tag"></i> <?php the_category(', '); ?></span><?php
        }
        if ( get_theme_mod( 'post_comments', '1' ) ) { ?>
		  <span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'Leave a Comment', 'liveblog' ), __( '1 Comment', 'liveblog' ), __( '% Comments', 'liveblog' ), 'comments-link', __( 'Comments are off', 'liveblog' )); ?></span><?php
        }
        edit_post_link( __( 'Edit', 'liveblog' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' ); ?>
</div><!--.post-meta-->