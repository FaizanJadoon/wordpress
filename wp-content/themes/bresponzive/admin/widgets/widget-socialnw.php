<?php
/*************************************************************************************
	Plugin Name: Social Network Icons Widget
	Description: It will display Social Nw Icons.
	Author: ThemePacific
	Author URI: http://themepacific.com					
***************************************************************************/
/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'bresponZive_themepacific_social_widget_box' );
/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 * 
 * @since 0.1
 */
function bresponZive_themepacific_social_widget_box() {
	register_widget( 'bresponZive_themepacific_social_widget' );
}
/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class bresponZive_themepacific_social_widget extends WP_Widget {

	function bresponZive_themepacific_social_widget() {
		$widget_ops = array( 'classname' => 'tpcrn-social-icons-widget', 'description' => __('Display Social Icons', 'bresponZive') );
		$control_ops = array($control_ops = array('id_base' => 'bresponZive_themepacific_social_icons-widget'));
		$this->WP_Widget( 'social',__('ThemePacific: Social Icons','bresponZive'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );		 		
		$fb = $instance['fb'];		 		
		$gp = $instance['gp'];		 		
		$rss = $instance['rss'];		 		
		$tw = $instance['tw'];		
/* Before widget (defined by themes). */
		echo $before_widget;
		if($title)
			echo $before_title . $title . $after_title;
		/* Display the widget title if one was input (before and after defined by themes). */ 		
  ?>
  
			<div class="widget">
			<div class="social-icons">
		<?php
		$icons_path =  get_stylesheet_directory_uri().'/images/social-icons';
		 $rss = get_bloginfo('rss2_url'); 
			?><a   title="Rss" href="<?php echo $rss ; ?>" ><img src="<?php echo $icons_path; ?>/rss.png" alt="RSS"  /></a> 
		 
		 <a  title="Google+" href="<?php echo $gp; ?>" ><img src="<?php echo $icons_path; ?>/gp.png" alt="Google+"  /></a> 
		 <a  title="Facebook" href="<?php echo $fb; ?>" ><img src="<?php echo $icons_path; ?>/fb.png" alt="Facebook"  /></a> 
		 
		 <a  title="Twitter" href="<?php echo $tw ; ?>" ><img src="<?php echo $icons_path; ?>/tw.png" alt="Twitter"  /></a> 
			</div>
			</div>
		 		<?php	
	/* After widget (defined by themes). */
		echo $after_widget;		
	
	}
	
function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['rss'] = strip_tags( $new_instance['rss'] );
		$instance['fb'] = strip_tags( $new_instance['fb'] );
		$instance['gp'] = strip_tags( $new_instance['gp'] );
		$instance['tw'] = strip_tags( $new_instance['tw'] );
 		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Social' , 'bresponZive') , 'rss' =>__('RSS' , 'bresponZive') , 'fb' =>__('Facebook' , 'bresponZive') , 'gp' =>__('Google+' , 'bresponZive') , 'tw' =>__('Twitter' , 'bresponZive')   );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'bresponZive'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('Rss', 'bresponZive'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fb' ); ?>"><?php _e('Facebook', 'bresponZive'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'fb' ); ?>" name="<?php echo $this->get_field_name( 'fb' ); ?>" value="<?php echo $instance['fb']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gp' ); ?>"><?php _e('Google+', 'bresponZive'); ?>: </label>
			<input id="<?php echo $this->get_field_id( 'gp' ); ?>" name="<?php echo $this->get_field_name( 'gp' ); ?>" value="<?php echo $instance['gp']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tw' ); ?>"><?php _e('Twitter', 'bresponZive'); ?> </label>
			<input id="<?php echo $this->get_field_id( 'tw' ); ?>" name="<?php echo $this->get_field_name( 'tw' ); ?>" value="<?php echo $instance['tw']; ?>" class="widefat" type="text" />
		</p>

	<?php
	}
}
?>