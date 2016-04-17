<?php
/*************************************************************************************
	Plugin Name: Social Subscriber Count Widget
	Description: Tweets Widget will display your Latest Tweets in your sidebar .
	Author: ThemePacific
	Author URI: http://themepacific.com					
***************************************************************************/
/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action('widgets_init', 'bresponZive_themepacific_email_news_subscribe_widget');
/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 * 
 * @since 0.1
 */
function bresponZive_themepacific_email_news_subscribe_widget()
{
	register_widget('bresponZive_themepacific_news_subscribe_widget');
}
/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class bresponZive_themepacific_news_subscribe_widget extends WP_Widget {
/**
* Widget setup.
*/
function bresponZive_themepacific_news_subscribe_widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'tpcrn_news_subs', 'description' => __('Subscribe to Feedburner Newsletter Widget', 'bresponZive'));
		/* Widget control settings. */
		$control_ops = array('id_base' => 'tpcrn_news_subs-widget');
		/* Create the widget. */
		$this->WP_Widget('tpcrn_news_subs-widget', __('ThemePacific: NewsLetter Subscribe','bresponZive'), $widget_ops, $control_ops);
    }
/**
* Display the widget 
*/		
function widget($args, $instance){
		extract($args);
		/* Our Arguments in widget settings. */

		$title = apply_filters('widget_title', $instance['title']);

		$feedb_url = $instance['feedb_url'];
 
		echo $before_widget;
		
	/* Display the widget title if it has*/

		if($title) {

			echo $before_title.$title.$after_title;

		}
 ?>
 <div class="email-subs">

<div class="newsletter">
 <form class="subsform" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedb_url; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
 				
					<input type="hidden" value="<?php echo $feedb_url; ?>" name="uri">				   
					<input type="text"   name="Email" value="Email Address" class="subsfield" onclick="if (this.defaultValue==this.value) this.value=''" onblur="if (this.value=='') this.value=this.defaultValue">
					<input type="submit" value="Subscribe" class="nletterbutton">
					 <input type="hidden" name="loc" value="en_US">
 			</form>				</div>
  			 			</div>

			
			
		<?php
		echo $after_widget;
		
	}
/**
* Update the widget settings.
*/	
function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
 		$instance['feedb_url'] = $new_instance['feedb_url'];
 		return $instance;
	}
/**
* Displays the widget settings controls on the widget panel.
**/ 
function form($instance)
	{
		$defaults = array('title' => 'News Letter Subscribe','feedb_url' => '','feedb_con' => __('Signup for Free for Our Newsletters!', 'bresponZive'));
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bresponZive'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('feedb_con'); ?>"><?php _e('Enter Text:', 'bresponZive'); ?></label>
           <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('feedb_con'); ?>" name="<?php echo $this->get_field_name('feedb_con'); ?>"><?php echo $instance['feedb_con']; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('feedb_url'); ?>"><?php _e('Feedburner ID', 'bresponZive'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('feedb_url'); ?>" name="<?php echo $this->get_field_name('feedb_url'); ?>" value="<?php echo $instance['feedb_url']; ?>" />
		</p>
	 
	<?php }
}
?>