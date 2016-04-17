<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Recent Posts Widget
	Plugin URI: http://www.themespie.com
	Description: A widget that displays recent posts.
	Version: 1.0

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'liveblog_category_posts_widget' );  

// Register Widget
function liveblog_category_posts_widget() {
    register_widget( 'liveblog_category_widget' );
}

// Widget Class
class liveblog_category_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'liveblog_cat_widget', 

        // Widget name will appear in UI
        __('(ThemesPie) Category Posts', 'liveblog'), 

        // Widget description
        array( 'description' => __('A widget that displays the recent posts from a single category', 'liveblog'), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : __('Category Posts', 'liveblog');
        $posts = isset ( $instance['posts'] ) ? intval( $instance['posts'] ) : '4';
        $cat = isset( $instance[ 'cat' ] ) ? intval( $instance[ 'cat' ] ) : 0;
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? esc_attr( $instance[ 'show_thumb' ] ) : 1;
		$show_cat = isset( $instance[ 'show_cat' ] ) ? esc_attr( $instance[ 'show_cat' ] ) : 0;
		$show_author = isset( $instance[ 'show_author' ] ) ? esc_attr( $instance[ 'show_author' ] ) : 0;
		$show_date = isset( $instance[ 'show_date' ] ) ? esc_attr( $instance[ 'show_date' ] ) : 1;
		$show_comments = isset( $instance[ 'show_comments' ] ) ? esc_attr( $instance[ 'show_comments' ] ) : 0;
		$widget_style = isset( $instance['widget_style'] ) ? esc_attr( $instance['widget_style'] ) : 'style-one';
		
		// Before Widget
		echo $before_widget;
		$i = 1;
		// Display the widget title  
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		<!-- START WIDGET -->
		<div class="category-posts-widget category_posts">
		<ul class="category-posts">
			<?php
                $cat_posts = new WP_Query('cat='.$cat.'&showposts='.$posts.'&orderby=date&order=DESC&ignore_sticky_posts=1');
				if( $cat_posts->have_posts() ) : while ( $cat_posts->have_posts() ) : $cat_posts->the_post(); ?>
				<li>
					<?php if ( $show_thumb == 1 ): ?>
						<?php if ( $widget_style == 'style-one' ): ?>
                            <?php if(has_post_thumbnail()): ?>
                                <div class="thumbnail">
                                    <a class="widgetthumb" href='<?php the_permalink(); ?>'>
                                        <?php the_post_thumbnail('liveblog-widgetthumb'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
						<?php else: ?>
                            <?php if(has_post_thumbnail()): ?>
                                <div class="thumbnail-big thumbnail clearfix">
                                    <a class="widgetthumb" href='<?php the_permalink(); ?>'>
                                    <?php the_post_thumbnail('liveblog-featured390'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
					   <?php endif; ?>
					<?php endif; ?>
					<div class="info">
						<span class="widgettitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span>
						<span class="meta">
							<?php if ( $show_author == 1 ) { ?>
								<span class="post-author"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
							<?php } ?>
							<?php if ( $show_date == 1 ) { ?>
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?></time>
							<?php } ?>
							<?php if ( $show_cat == 1 ) { ?>
								<span class="post-cats"><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
							<?php } ?>
							<?php if ( $show_comments == 1 ) { ?>
								<span class="post-comments"><i class="fa fa-comment-o"></i> <?php comments_popup_link( '0', '1', '%', 'comments-link', ''); ?></span>
							<?php } ?>
						</span>
					</div>
				</li>
			<?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</ul>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		echo $after_widget;
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['posts'] = intval( $new_instance['posts'] );
		$instance['cat'] = intval( $new_instance['cat'] );
		$instance['show_thumb'] = intval( $new_instance['show_thumb'] );
		$instance['show_cat'] = intval( $new_instance['show_cat'] );
		$instance['show_author'] = intval( $new_instance['show_author'] );
		$instance['show_date'] = intval( $new_instance['show_date'] );
		$instance['show_comments'] = intval( $new_instance['show_comments'] );
		$instance['widget_style'] = strip_tags( $new_instance['widget_style'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => __('Category Posts', 'liveblog'),
			'posts' => 4,
			'show_thumb' => 1,
			'show_cat' => 0,
			'show_author' => 0,
			'show_date' => 1,
			'show_comments' => 0,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$cat = isset( $instance[ 'cat' ] ) ? intval( $instance[ 'cat' ] ) : 0;
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? esc_attr( $instance[ 'show_thumb' ] ) : 1;
		$show_cat = isset( $instance[ 'show_cat' ] ) ? esc_attr( $instance[ 'show_cat' ] ) : 1;
		$show_author = isset( $instance[ 'show_author' ] ) ? esc_attr( $instance[ 'show_author' ] ) : 1;
		$show_date = isset( $instance[ 'show_date' ] ) ? esc_attr( $instance[ 'show_date' ] ) : 1;
		$show_comments = isset( $instance[ 'show_comments' ] ) ? esc_attr( $instance[ 'show_comments' ] ) : 1;
		$widget_style = isset( $instance['widget_style'] ) ? esc_attr( $instance['widget_style'] ) : '';

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(!empty($instance['title'])) { echo $instance['title']; } ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e('Number of posts to show:','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo intval( $instance['posts'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_style' ); ?>"><?php _e( 'Widget Style:','liveblog' ); ?></label> 
			<select id="<?php echo $this->get_field_id( 'widget_style' ); ?>" name="<?php echo $this->get_field_name( 'widget_style' ); ?>" >
				<option value="style-one" <?php selected( $widget_style, 'style-one' ); ?>><?php _e( 'Small Thumbnail','liveblog' ); ?></option>
				<option value="style-two" <?php selected( $widget_style, 'style-two' ); ?>><?php _e( 'Big Thumbnail','liveblog' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Category:','liveblog' ); ?></label> 
			<?php wp_dropdown_categories( Array(
                    'orderby'            => 'ID', 
                    'order'              => 'ASC',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'hide_if_empty'      => true,
                    'echo'               => 1,
                    'selected'           => $cat,
                    'hierarchical'       => 1, 
                    'name'               => $this->get_field_name( 'cat' ),
                    'id'                 => $this->get_field_id( 'cat' ),
                    'taxonomy'           => 'category',
                ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_thumb"); ?>" name="<?php echo $this->get_field_name("show_thumb"); ?>" value="1" <?php if (isset($instance['show_thumb'])) { checked( 1, $instance['show_thumb'], true ); } ?> />
				<?php _e( 'Show Thumbnails', 'liveblog'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_cat"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_cat"); ?>" name="<?php echo $this->get_field_name("show_cat"); ?>" value="1" <?php if (isset($instance['show_cat'])) { checked( 1, $instance['show_cat'], true ); } ?> />
				<?php _e( 'Show Categories', 'liveblog'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_author"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_author"); ?>" name="<?php echo $this->get_field_name("show_author"); ?>" value="1" <?php if (isset($instance['show_author'])) { checked( 1, $instance['show_author'], true ); } ?> />
				<?php _e( 'Show Post Author', 'liveblog'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_date"); ?>" name="<?php echo $this->get_field_name("show_date"); ?>" value="1" <?php if (isset($instance['show_date'])) { checked( 1, $instance['show_date'], true ); } ?> />
				<?php _e( 'Show Post Date', 'liveblog'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_comments"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_comments"); ?>" name="<?php echo $this->get_field_name("show_comments"); ?>" value="1" <?php if (isset($instance['show_comments'])) { checked( 1, $instance['show_comments'], true ); } ?> />
				<?php _e( 'Show Post Comments', 'liveblog'); ?>
			</label>
		</p>
		<?php
	}
}
?>