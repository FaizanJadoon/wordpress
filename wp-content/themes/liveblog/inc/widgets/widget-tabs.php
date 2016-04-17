<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Tabbed Widget
	Plugin URI: http://www.themespie.com
	Description: A widget that displays tabs.
	Version: 1.0

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'liveblog_tabs_widget' );  

// Register Widget
function liveblog_tabs_widget() {
    register_widget( 'liveblog_tabs' );
}

// Widget Class
class liveblog_tabs extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'tabs_widget', 

        // Widget name will appear in UI
        __('(ThemesPie) Tabs Widget', 'liveblog'), 

        // Widget description
        array( 'description' => __('A widget that displays tabbed widget on your blog', 'liveblog'), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
        $recent_posts_count = isset ( $instance['recent_posts_count'] ) ? intval( $instance['recent_posts_count'] ) : '4';
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? esc_attr( $instance[ 'show_thumb' ] ) : 1;
		$show_cat = isset( $instance[ 'show_cat' ] ) ? esc_attr( $instance[ 'show_cat' ] ) : 0;
		$show_author = isset( $instance[ 'show_author' ] ) ? esc_attr( $instance[ 'show_author' ] ) : 0;
		$show_date = isset( $instance[ 'show_date' ] ) ? esc_attr( $instance[ 'show_date' ] ) : 1;
		$show_comments = isset( $instance[ 'show_comments' ] ) ? esc_attr( $instance[ 'show_comments' ] ) : 0;
		
		// Before Widget
		echo $before_widget;
		?>
		<!-- START WIDGET -->
		<div id="tabs-widget">
			<ul id="tabs">
				<li class="active"><a href="#tab1"><?php _e('Popular','liveblog'); ?></a></li>
				<li class="recent-tab"><a href="#tab2"><?php _e('Recent','liveblog'); ?></a></li>
			</ul>
			<div id="tabs-content">
				<div id="tab1" class="popular-posts tab-content">
					<ul>
						<?php
							$popularposts = new WP_Query('showposts='.$recent_posts_count.'&orderby=comment_count&ignore_sticky_posts=1');
						?>
						<?php if($popularposts->have_posts()) : while ($popularposts->have_posts()) : $popularposts->the_post(); ?>
							<li>
								<?php if ( $show_thumb == 1 ) { ?>
                                    <?php if(has_post_thumbnail()): ?>
                                        <div class="thumbnail">
                                            <a class="widgetthumb" href='<?php the_permalink(); ?>'>
                                                <?php the_post_thumbnail('liveblog-widgetthumb'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
								<?php } ?>
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
						<?php endif; ?>
					</ul>
				</div>
				<div id="tab2" class="recent-posts tab-content">
					<ul>
						<?php 
							$the_query = new WP_Query( 'showposts='.$recent_posts_count.'&ignore_sticky_posts=1' );
							while ($the_query -> have_posts()) : $the_query -> the_post();
						?>
							<li>
								<?php if ( $show_thumb == 1 ) { ?>
                                    <?php if(has_post_thumbnail()): ?>
                                        <div class="thumbnail">
                                            <a class="widgetthumb" href='<?php the_permalink(); ?>'>
                                                <?php the_post_thumbnail('liveblog-widgetthumb'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
								<?php } ?>
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
						<?php endwhile;?>
					</ul>
				</div>
			</div>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		echo $after_widget;
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['recent_posts_count'] = intval( $new_instance['recent_posts_count'] );
		$instance['show_thumb'] = intval( $new_instance['show_thumb'] );
		$instance['show_cat'] = intval( $new_instance['show_cat'] );
		$instance['show_author'] = intval( $new_instance['show_author'] );
		$instance['show_date'] = intval( $new_instance['show_date'] );
		$instance['show_comments'] = intval( $new_instance['show_comments'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => __('Popular Posts', 'liveblog'),
			'recent_posts_count' => 4,
			'show_thumb' => 1,
			'show_cat' => 0,
			'show_author' => 0,
			'show_date' => 1,
			'show_comments' => 0
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? esc_attr( $instance[ 'show_thumb' ] ) : 1;
		$show_cat = isset( $instance[ 'show_cat' ] ) ? esc_attr( $instance[ 'show_cat' ] ) : 1;
		$show_author = isset( $instance[ 'show_author' ] ) ? esc_attr( $instance[ 'show_author' ] ) : 1;
		$show_date = isset( $instance[ 'show_date' ] ) ? esc_attr( $instance[ 'show_date' ] ) : 1;

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'recent_posts_count' ); ?>"><?php _e('Number of posts to show:','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'recent_posts_count' ); ?>" name="<?php echo $this->get_field_name( 'recent_posts_count' ); ?>" value="<?php echo $instance['recent_posts_count']; ?>" class="widefat" type="text" />
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