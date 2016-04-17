<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: 125 Ad Widget
	Plugin URI: http://www.themespie.com
	Description: A widget that displays 125x125px ad.
	Version: 1.0

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'liveblog_125_ad_widget' );  

// Register Widget
function liveblog_125_ad_widget() {
    register_widget( 'liveblog_125_widget' );
}

// Widget Class
class liveblog_125_widget extends WP_Widget {

     function __construct() {
        parent::__construct(
        // Base ID of your widget
        'liveblog_125_widget', 

        // Widget name will appear in UI
        __('(ThemesPie) 125x125 Ad Widget', 'liveblog'), 

        // Widget description
        array( 'description' => __('A widget that displays 125x125 ad', 'liveblog'), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : '';
		$banner1 = isset ( $instance['banner1'] ) ? esc_url( $instance['banner1'] ) : get_template_directory_uri().'/assets/images/125x125.png';
		$banner2 = isset ( $instance['banner2'] ) ? esc_url( $instance['banner2'] ) : get_template_directory_uri().'/assets/images/125x125.png';
		$banner3 = isset ( $instance['banner3'] ) ? esc_url( $instance['banner3'] ) : get_template_directory_uri().'/assets/images/125x125.png';
		$banner4 = isset ( $instance['banner4'] ) ? esc_url( $instance['banner4'] ) : get_template_directory_uri().'/assets/images/125x125.png';
		$link1 = isset ( $instance['link1'] ) ? esc_url( $instance['link1'] ) : 'https://themespie.com/';
		$link2 = isset ( $instance['link2'] ) ? esc_url( $instance['link2'] ) : 'https://themespie.com/';
		$link3 = isset ( $instance['link3'] ) ? esc_url( $instance['link3'] ) : 'https://themespie.com/';
		$link4 = isset ( $instance['link4'] ) ? esc_url( $instance['link4'] ) : 'https://themespie.com/';
		
		// Before Widget
		echo $before_widget;
		
		// Display the widget title  
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		<!-- START WIDGET -->
		<div class="widget ad-125-widget">
			<ul>
			<?php
				// Ad1
				if ( $link1 )
					echo '<li class="adleft"><a href="' . esc_url( $link1 ) . '"><img src="' . esc_url( $banner1 ) . '" width="125" height="125" alt="" /></a></li>';
					
				elseif ( $banner1 )
					echo '<li class="adleft"><img src="' . esc_url( $banner1 ) . '" width="125" height="125" alt="" /></li>';
					
				// Ad2
				if ( $link2 )
					echo '<li class="adright"><a href="' . esc_url( $link2 ) . '"><img src="' . esc_url( $banner2 ) . '" width="125" height="125" alt="" /></a></li>';
					
				elseif ( $banner2 )
					echo '<li class="adright"><img src="' . esc_url( $banner2 ) . '" width="125" height="125" alt="" /></li>';
					
				// Ad3
				if ( $link3 )
					echo '<li class="adleft"><a href="' . esc_url( $link3 ) . '"><img src="' . esc_url( $banner3 ) . '" width="125" height="125" alt="" /></a></li>';
					
				elseif ( $banner3 )
					echo '<li class="adleft"><img src="' . esc_url( $banner3 ) . '" width="125" height="125" alt="" /></li>';
					
				// Ad4
				if ( $link4 )
					echo '<li class="adright"><a href="' . esc_url( $link4 ) . '"><img src="' . esc_url( $banner4 ) . '" width="125" height="125" alt="" /></a></li>';
					
				elseif ( $banner4 )
					echo '<li class="adright"><img src="' . esc_url( $banner4 ) . '" width="125" height="125" alt="" /></li>';
			?>
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
		$instance['link1'] = esc_url( $new_instance['link1'] );
		$instance['link2'] = esc_url( $new_instance['link2'] );
		$instance['link3'] = esc_url( $new_instance['link3'] );
		$instance['link4'] = esc_url( $new_instance['link4'] );
		$instance['banner1'] = esc_url( $new_instance['banner1'] );
		$instance['banner2'] = esc_url( $new_instance['banner2'] );
		$instance['banner3'] = esc_url( $new_instance['banner3'] );
		$instance['banner4'] = esc_url( $new_instance['banner4'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 
			'title' => '',
			'link1' => 'https://themespie.com/',
			'banner1' => get_template_directory_uri()."/assets/images/125x125.png",
			'link2' => 'https://themespie.com/',
			'banner2' => get_template_directory_uri()."/assets/images/125x125.png",
			'link3' => 'https://themespie.com/',
			'banner3' => get_template_directory_uri()."/assets/images/125x125.png",
			'link4' => 'https://themespie.com/',
			'banner4' => get_template_directory_uri()."/assets/images/125x125.png",
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'liveblog'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(!empty($instance['title'])) { echo $instance['title']; } ?>" class="widefat" type="text" />
		</p>
		<!-- Ad1 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Ad1 Link URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" class="widefat" type="text" />
		</p>
		<!-- Ad1 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner1' ); ?>"><?php _e('Ad1 Banner URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner1' ); ?>" name="<?php echo $this->get_field_name( 'banner1' ); ?>" value="<?php echo $instance['banner1']; ?>" class="widefat" type="text" />
		</p>
		
		<!-- Ad2 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Ad2 Link URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" class="widefat" type="text" />
		</p>
		<!-- Ad2 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner2' ); ?>"><?php _e('Ad2 Banner URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner2' ); ?>" name="<?php echo $this->get_field_name( 'banner2' ); ?>" value="<?php echo $instance['banner2']; ?>" class="widefat" type="text" />
		</p>
		
		<!-- Ad3 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Ad3 Link URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" class="widefat" type="text" />
		</p>
		<!-- Ad3 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner3' ); ?>"><?php _e('Ad3 Banner URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner3' ); ?>" name="<?php echo $this->get_field_name( 'banner3' ); ?>" value="<?php echo $instance['banner3']; ?>" class="widefat" type="text" />
		</p>
		
		<!-- Ad4 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Ad4 Link URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" class="widefat" type="text" />
		</p>
		<!-- Ad4 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner4' ); ?>"><?php _e('Ad4 Banner URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner4' ); ?>" name="<?php echo $this->get_field_name( 'banner4' ); ?>" value="<?php echo $instance['banner4']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}
}
?>