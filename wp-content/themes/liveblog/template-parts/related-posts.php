<?php 
    if ( true == get_theme_mod( 'related_posts', true )) {
        $orig_post = $post;
        global $post;

        $categories = '';
        $tags = '';

        $related_count = get_theme_mod( 'related_posts_count', '3' );
        //Related Posts By Categories
        if (get_theme_mod( 'related_posts_by', 'categories' ) == 'categories') {
            $categories = get_the_category($post->ID);
            if ($categories) {
                $category_ids = array();
                foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                $args=array(
                    'category__in'        => $category_ids,
                    'post__not_in'        => array($post->ID),
                    'posts_per_page'      => intval( $related_count ), // Number of related posts that will be shown.
                    'ignore_sticky_posts' =>1
                );
            }
        }
        //Related Posts By Tags
        else {
            $tags = wp_get_post_tags($post->ID);        
            if ($tags) {
                $tag_ids = array();  
                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
                $args=array(
                    'tag__in'             => $tag_ids,  
                    'post__not_in'        => array($post->ID),  
                    'posts_per_page'      => intval( $related_count ), // Number of related posts to display.  
                    'ignore_sticky_posts' =>1 
                ); 
            }
        }
        if ($categories || $tags) {
            $my_query = new wp_query( $args );
            if( $my_query->have_posts() ) {
                echo '<div class="relatedposts"><h3 class="section-heading uppercase"><span>' . __('Related Posts','liveblog') . '</span></h3><ul class="slides">';
                while( $my_query->have_posts() ) {
                    $my_query->the_post();?>
                    <li>
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow">
                            <div class="relatedthumb">
                                <?php if ( has_post_thumbnail() ) { ?> 
                                    <?php the_post_thumbnail('liveblog-related'); ?>
                                <?php } else { ?>
                                    <img width="240" height="185" src="<?php echo get_template_directory_uri(); ?>/assets/images/240x185.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
                                <?php } ?>
                            </div>
                            <div class="related-content">
                                <header>
                                    <h2 class="title title18">
                                        <?php the_title(); ?>
                                    </h2>
                                </header><!--.header-->		
                                <div class="r-meta">
                                    <?php if ( get_theme_mod( 'post_date', '1' ) ) { ?>
                                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php echo esc_html( get_the_date() ); ?></time>
                                    <?php } ?>
                                </div>
                            </div><!--.related-content-->
                        </a>
                    </li>
                    <?php
                }
                echo '</ul></div>';
            }
        }
        $post = $orig_post;
        wp_reset_postdata();
    }
?>