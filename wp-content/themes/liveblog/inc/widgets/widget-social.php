<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Social Widget
	Plugin URI: http://www.themespie.com
	facebookription: A widget that displays links to your social profiles.
	Version: 1.0

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'liveblog_social_widget' );  

// Register Widget
function liveblog_social_widget() {
    register_widget( 'liveblog_social_widget' );
}

// Widget Class
class liveblog_social_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'social_widget', 

        // Widget name will appear in UI
        __('(ThemesPie) Social Widget', 'liveblog'), 

        // Widget description
        array( 'description' => __('A widget that displays links to your social profiles', 'liveblog'), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : __('Social Media', 'liveblog');
		$social_target = isset( $instance[ 'social_target' ] ) ? esc_attr( $instance[ 'social_target' ] ) : 1;
		$facebook = isset ( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '';
		$twitter = isset ( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '';
		$gplus = isset ( $instance['gplus'] ) ? esc_url( $instance['gplus'] ) : '';
		$rss = isset ( $instance['rss'] ) ? esc_url( $instance['rss'] ) : '';
		$pinterest = isset ( $instance['pinterest'] ) ? esc_url( $instance['pinterest'] ) : '';
		$linkedin = isset ( $instance['linkedin'] ) ? esc_url( $instance['linkedin'] ) : '';
		$flickr = isset ( $instance['flickr'] ) ? esc_url( $instance['flickr'] ) : '';
		$instagram = isset ( $instance['instagram'] ) ? esc_url( $instance['instagram'] ) : '';
		$youtube = isset ( $instance['youtube'] ) ? esc_url( $instance['youtube'] ) : '';
		$tumblr = isset ( $instance['tumblr'] ) ? esc_url( $instance['tumblr'] ) : '';
		$dribble = isset ( $instance['dribble'] ) ? esc_url( $instance['dribble'] ) : '';
		$git = isset ( $instance['git'] ) ? esc_url( $instance['git'] ) : '';
		$xing = isset ( $instance['xing'] ) ? esc_url( $instance['xing'] ) : '';
		
		// Before Widget
		echo $before_widget;
		
		?>
		<!-- START WIDGET -->
		<div class="social-widget">
			<?php		
				// Display the widget title  
				if ( $title )
					echo $before_title . $title . $after_title;
			?>
			<ul>
				<?php if ( $facebook ) { ?>
					<li class="facebook uppercase"><a href="<?php echo esc_url( $facebook ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-facebook"></span></a></li>
				<?php } ?>
				<?php if ( $twitter ) { ?>
					<li class="twitter uppercase"><a href="<?php echo esc_url( $twitter ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-twitter"></span></a></li>
				<?php } ?>
				<?php if ( $gplus ) { ?>
					<li class="gplus uppercase"><a href="<?php echo esc_url( $gplus ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-google-plus"></span></a></li>
				<?php } ?>
				<?php if ( $rss ) { ?>
					<li class="rss uppercase"><a href="<?php echo esc_url( $rss ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-rss"></span></a></li>
				<?php } ?>
				<?php if ( $pinterest ) { ?>
					<li class="pinterest uppercase"><a href="<?php echo esc_url( $pinterest ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-pinterest"></span></a></li>
				<?php } ?>
				<?php if ( $linkedin ) { ?>
					<li class="linkedin uppercase"><a href="<?php echo esc_url( $linkedin ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-linkedin"></span></a></li>
				<?php } ?>
				<?php if ( $flickr ) { ?>
					<li class="flickr uppercase"><a href="<?php echo esc_url( $flickr ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-flickr"></span></a></li>
				<?php } ?>
				<?php if ( $instagram ) { ?>
					<li class="instagram uppercase"><a href="<?php echo esc_url( $instagram ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-instagram"></span></a></li>
				<?php } ?>
				<?php if ( $youtube ) { ?>
					<li class="youtube uppercase"><a href="<?php echo esc_url( $youtube ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-youtube-play"></span></a></li>
				<?php } ?>
				<?php if ( $tumblr ) { ?>
					<li class="tumblr uppercase"><a href="<?php echo esc_url( $tumblr ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-tumblr"></span></a></li>
				<?php } ?>
				<?php if ( $git ) { ?>
					<li class="git uppercase"><a href="<?php echo esc_url( $git ); ?>"><span class="fa fa-github"></span></a></li>
				<?php } ?>
				<?php if ( $dribble ) { ?>
					<li class="dribble uppercase"><a href="<?php echo esc_url( $dribble ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-dribbble"></span></a></li>
				<?php } ?>
				<?php if ( $xing ) { ?>
					<li class="xing uppercase"><a href="<?php echo esc_url( $xing ); ?>"><span class="fa fa-xing-square"></span></a></li>
				<?php } ?>
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
		
		$instance['social_target'] = intval( $new_instance['social_target'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = stripslashes( $new_instance['id']);
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['gplus'] = $new_instance['gplus'];
		$instance['rss'] = $new_instance['rss'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['dribble'] = $new_instance['dribble'];
		$instance['git'] = $new_instance['git'];
		$instance['xing'] = $new_instance['xing'];
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => __('Social Media', 'liveblog'),
			'social_target' => 1,
			'facebook' => '',
			'twitter' => '',
			'gplus' => '',
			'rss' => '',
			'pinterest' => '',
			'linkedin' => '',
			'flickr' => '',
			'instagram' => '',
			'youtube' => '',
			'tumblr' => '',
			'dribble' => '',
			'git' => '',
			'xing' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$social_target = isset( $instance[ 'social_target' ] ) ? esc_attr( $instance[ 'social_target' ] ) : 1;

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("social_target"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("social_target"); ?>" name="<?php echo $this->get_field_name("social_target"); ?>" value="1" <?php if (isset($instance['social_target'])) { checked( 1, $instance['social_target'], true ); } ?> />
				<?php _e( 'Open Links in New Window', 'liveblog'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>"><?php _e('Google+ URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo $instance['gplus']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('RSS URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('Instagram URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('YouTube URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('tumblr URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo $instance['tumblr']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'dribble' ); ?>"><?php _e('Dribbble URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'dribble' ); ?>" name="<?php echo $this->get_field_name( 'dribble' ); ?>" value="<?php echo $instance['dribble']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'git' ); ?>"><?php _e('GitHub URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'git' ); ?>" name="<?php echo $this->get_field_name( 'git' ); ?>" value="<?php echo $instance['git']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'xing' ); ?>"><?php _e('Xing URL','liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'xing' ); ?>" name="<?php echo $this->get_field_name( 'xing' ); ?>" value="<?php echo $instance['xing']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}
}
?>