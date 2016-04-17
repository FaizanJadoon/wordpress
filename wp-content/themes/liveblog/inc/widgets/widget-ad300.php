<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: 300 Ad Widget
	Plugin URI: http://www.themespie.com
	Description: A widget that displays 300x250px ad.
	Version: 1.0

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'liveblog_300_ad_widget' );  

// Register Widget
function liveblog_300_ad_widget() {
    register_widget( 'liveblog_300_widget' );
}

// Widget Class
class liveblog_300_widget extends WP_Widget {

     function __construct() {
        parent::__construct(
        // Base ID of your widget
        'liveblog_300_widget', 

        // Widget name will appear in UI
        __('(ThemesPie) 300x250 Ad Widget', 'liveblog'), 

        // Widget description
        array( 'description' => __('A widget that displays 300x250 ad', 'liveblog'), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		/* $title = apply_filters('widget_title', $instance['title'] ); */
        $banner = isset ( $instance['banner'] ) ? esc_url( $instance['banner'] ) : get_template_directory_uri().'/assets/images/300x250.png';
        $link = isset ( $instance['link'] ) ? esc_url( $instance['link'] ) : 'https://themespie.com/';
		
		// Before Widget
		echo $before_widget;
		
		// Display the widget title  
		/* if ( $title )
			echo $before_title . $title . $after_title; */
		
		?>
		<!-- START WIDGET -->
		<div class="ad-300-widget">
			<?php
				if ( $link )
					echo '<a href="' . esc_url( $link ) . '"><img src="' . esc_url( $banner ) . '" width="300" height="250" alt="" /></a>';
					
				elseif ( $banner )
					echo '<img src="' . esc_url( $banner ) . '" width="300" height="250" alt="" />';
			?>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		echo $after_widget;
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* $instance['title'] = strip_tags( $new_instance['title'] ); */
		$instance['link'] = esc_url( $new_instance['link'] );
		$instance['banner'] = esc_url( $new_instance['banner'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'link' => 'http://themespie.com/',
			'banner' => get_template_directory_uri()."/assets/images/300x250.png",
			'ad_code' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Ad Link URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_url($instance['link']); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'banner' ); ?>"><?php _e('Ad Banner URL:', 'liveblog') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner' ); ?>" name="<?php echo $this->get_field_name( 'banner' ); ?>" value="<?php echo esc_url($instance['banner']); ?>" class="widefat" type="text" />
		</p>
		<?php
	}
}
?>