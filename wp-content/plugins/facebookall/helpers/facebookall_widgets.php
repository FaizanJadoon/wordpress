<?php
// Login widget.
class FacebookAllLoginWidget extends WP_Widget {
	/** class constructor */ 
	function FacebookAllLoginWidget() { 
		parent::WP_Widget('facebookalllogin', 'FacebookAll Login', array('description' => __( 'Login or register using Facebook and post on their wall on login.', 'facebookall' )) 
			); 
	}  
    function widget( $args, $instance ) { 
		extract( $args ); 
		 
		if($instance['hide_for_logged_in']==1 && is_user_logged_in()) return; 
		 
		echo $before_widget;  

		if( !empty( $instance['title'] ) ){ 
			$title = apply_filters( 'widget_title', $instance[ 'title' ] ); 
			echo $before_title . $title . $after_title; 
		}  

		if( !empty( $instance['before_widget_content'] ) ){ 
			echo $instance['before_widget_content']; 
		}  

		facebookall_render_widget_button();
		if( !empty( $instance['after_widget_content'] ) ){ 
			echo $instance['after_widget_content']; 
		}  

		echo $after_widget; 
	}  
    function update( $new_instance, $old_instance ) { 
      $instance = $old_instance; 
      $instance['title'] = strip_tags( $new_instance['title'] ); 
      $instance['before_widget_content'] = $new_instance['before_widget_content']; 
      $instance['after_widget_content'] = $new_instance['after_widget_content']; 
      $instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  
      return $instance; 
	}  
    function form( $instance ) { 
	  $defaults = array( 'title' => 'Login with', 'before_widget_content' => '', 'after_widget_content' => '' );  
      foreach( $instance as $key => $value )  
        $instance[ $key ] = esc_attr( $value );  
        $instance = wp_parse_args( (array)$instance, $defaults ); ?> 
		<p> 
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'before_widget_content' ); ?>"><?php _e( 'Before widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'before_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'before_widget_content' ); ?>" type="text" value="<?php echo $instance['before_widget_content']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'after_widget_content' ); ?>"><?php _e( 'After widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'after_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'after_widget_content' ); ?>" type="text" value="<?php echo $instance['after_widget_content']; ?>" /> 
			<br /><br /><label for="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>"><?php _e( 'Hide for logged in users:', 'facebookall' ); ?></label> 
	<input type="checkbox" id="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'hide_for_logged_in' ); ?>" type="text" value="1" <?php if($instance['hide_for_logged_in']==1) echo 'checked="checked"'; ?> /> 
		</p> 
<?php 
  } 
} 
add_action( 'widgets_init', create_function( '', 'return register_widget( "FacebookAllLoginWidget" );')); 

// Page Plugin widget.

class FacebookAllFanboxWidget extends WP_Widget {
	/** class constructor */ 
	function FacebookAllFanboxWidget() { 
		parent::WP_Widget('facebookallfanbox', 'FacebookAll Page Plugin', array('description' => __( 'Page Plugin enables Facebook Page owners to attract and gain Likes from their own website.', 'facebookall' )) 
			); 
	}  
    function widget( $args, $instance ) { 
		extract( $args ); 
		 
		if($instance['hide_for_logged_in']==1 && is_user_logged_in()) return; 
		 
		echo $before_widget;  

		if( !empty( $instance['title'] ) ){ 
			$title = apply_filters( 'widget_title', $instance[ 'title' ] ); 
			echo $before_title . $title . $after_title; 
		}  

		if( !empty( $instance['before_widget_content'] ) ){ 
			echo $instance['before_widget_content']; 
		}  

		facebookall_render_fanbox();

		if( !empty( $instance['after_widget_content'] ) ){ 
			echo $instance['after_widget_content']; 
		}  

		echo $after_widget; 
	}  
    function update( $new_instance, $old_instance ) { 
      $instance = $old_instance; 
      $instance['title'] = strip_tags( $new_instance['title'] ); 
      $instance['before_widget_content'] = $new_instance['before_widget_content']; 
      $instance['after_widget_content'] = $new_instance['after_widget_content']; 
      $instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  
      return $instance; 
	}  
    function form( $instance ) { 
	  $defaults = array( 'title' => 'FacebookAll Page Plugin', 'before_widget_content' => '', 'after_widget_content' => '' );  
      foreach( $instance as $key => $value )  
        $instance[ $key ] = esc_attr( $value );  
        $instance = wp_parse_args( (array)$instance, $defaults ); ?> 
		<p> 
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'before_widget_content' ); ?>"><?php _e( 'Before widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'before_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'before_widget_content' ); ?>" type="text" value="<?php echo $instance['before_widget_content']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'after_widget_content' ); ?>"><?php _e( 'After widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'after_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'after_widget_content' ); ?>" type="text" value="<?php echo $instance['after_widget_content']; ?>" /> 
			<br /><br /><label for="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>"><?php _e( 'Hide for logged in users:', 'facebookall' ); ?></label> 
	<input type="checkbox" id="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'hide_for_logged_in' ); ?>" type="text" value="1" <?php if($instance['hide_for_logged_in']==1) echo 'checked="checked"'; ?> /> 
		</p> 
<?php 
  } 
} 
add_action( 'widgets_init', create_function( '', 'return register_widget( "FacebookAllFanboxWidget" );')); 

// Follow button widget.

class FacebookAllFollowWidget extends WP_Widget {
	/** class constructor */ 
	function FacebookAllFollowWidget() { 
		parent::WP_Widget('facebookallfollow', 'FacebookAll Follow Button', array('description' => __( 'The Follow button lets people subscribe to the public updates of others on Facebook.', 'facebookall' ))); 
	}  
    function widget( $args, $instance ) { 
		extract( $args ); 
		 
		if($instance['hide_for_logged_in']==1 && is_user_logged_in()) return; 
		 
		echo $before_widget;  

		if( !empty( $instance['title'] ) ){ 
			$title = apply_filters( 'widget_title', $instance[ 'title' ] ); 
			echo $before_title . $title . $after_title; 
		}  

		if( !empty( $instance['before_widget_content'] ) ){ 
			echo $instance['before_widget_content']; 
		}  

		facebookall_render_fbutton();  

		if( !empty( $instance['after_widget_content'] ) ){ 
			echo $instance['after_widget_content']; 
		}  

		echo $after_widget; 
	}  
    function update( $new_instance, $old_instance ) { 
      $instance = $old_instance; 
      $instance['title'] = strip_tags( $new_instance['title'] ); 
      $instance['before_widget_content'] = $new_instance['before_widget_content']; 
      $instance['after_widget_content'] = $new_instance['after_widget_content']; 
      $instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  
      return $instance; 
	}  
    function form( $instance ) { 
	  $defaults = array( 'title' => 'FacebookAll Follow Button', 'before_widget_content' => '', 'after_widget_content' => '' );  
      foreach( $instance as $key => $value )  
        $instance[ $key ] = esc_attr( $value );  
        $instance = wp_parse_args( (array)$instance, $defaults ); ?> 
		<p> 
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'before_widget_content' ); ?>"><?php _e( 'Before widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'before_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'before_widget_content' ); ?>" type="text" value="<?php echo $instance['before_widget_content']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'after_widget_content' ); ?>"><?php _e( 'After widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'after_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'after_widget_content' ); ?>" type="text" value="<?php echo $instance['after_widget_content']; ?>" /> 
			<br /><br /><label for="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>"><?php _e( 'Hide for logged in users:', 'facebookall' ); ?></label> 
	<input type="checkbox" id="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'hide_for_logged_in' ); ?>" type="text" value="1" <?php if($instance['hide_for_logged_in']==1) echo 'checked="checked"'; ?> /> 
		</p> 
<?php 
  } 
} 
add_action( 'widgets_init', create_function( '', 'return register_widget( "FacebookAllFollowWidget" );')); 

// Send Button widget.

class FacebookAllSendWidget extends WP_Widget {
	/** class constructor */ 
	function FacebookAllSendWidget() { 
		parent::WP_Widget('facebookallsendbutton', 'FacebookAll Send Button', array('description' => __( 'The Send button lets people privately send content on your site to one or more friends in a Facebook message, to an email address, or share it with a Facebook group.', 'facebookall' )) 
			); 
	}  
    function widget( $args, $instance ) { 
		extract( $args ); 
		 
		if($instance['hide_for_logged_in']==1 && is_user_logged_in()) return; 
		 
		echo $before_widget;  

		if( !empty( $instance['title'] ) ){ 
			$title = apply_filters( 'widget_title', $instance[ 'title' ] ); 
			echo $before_title . $title . $after_title; 
		}  

		if( !empty( $instance['before_widget_content'] ) ){ 
			echo $instance['before_widget_content']; 
		}  

		facebookall_render_send();  

		if( !empty( $instance['after_widget_content'] ) ){ 
			echo $instance['after_widget_content']; 
		}  

		echo $after_widget; 
	}  
    function update( $new_instance, $old_instance ) { 
      $instance = $old_instance; 
      $instance['title'] = strip_tags( $new_instance['title'] ); 
      $instance['before_widget_content'] = $new_instance['before_widget_content']; 
      $instance['after_widget_content'] = $new_instance['after_widget_content']; 
      $instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  
      return $instance; 
	}  
    function form( $instance ) { 
	  $defaults = array( 'title' => 'FacebookAll Send Button', 'before_widget_content' => '', 'after_widget_content' => '' );  
      foreach( $instance as $key => $value )  
        $instance[ $key ] = esc_attr( $value );  
        $instance = wp_parse_args( (array)$instance, $defaults ); ?> 
		<p> 
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'before_widget_content' ); ?>"><?php _e( 'Before widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'before_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'before_widget_content' ); ?>" type="text" value="<?php echo $instance['before_widget_content']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'after_widget_content' ); ?>"><?php _e( 'After widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'after_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'after_widget_content' ); ?>" type="text" value="<?php echo $instance['after_widget_content']; ?>" /> 
			<br /><br /><label for="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>"><?php _e( 'Hide for logged in users:', 'facebookall' ); ?></label> 
	<input type="checkbox" id="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'hide_for_logged_in' ); ?>" type="text" value="1" <?php if($instance['hide_for_logged_in']==1) echo 'checked="checked"'; ?> /> 
		</p> 
<?php 
  } 
} 
add_action( 'widgets_init', create_function( '', 'return register_widget( "FacebookAllSendWidget" );'));

// Embedded Posts widget.

class FacebookAllEmbedWidget extends WP_Widget {
	/** class constructor */ 
	function FacebookAllEmbedWidget() { 
		parent::WP_Widget('facebookallembed', 'FacebookAll Embedded Posts', array('description' => __( 'Embedded Posts are a simple way to put public posts - by a Page or a person on Facebook - into the content of your web site or web page.', 'facebookall' )) 
			); 
	}  
    function widget( $args, $instance ) { 
		extract( $args ); 
		 
		if($instance['hide_for_logged_in']==1 && is_user_logged_in()) return; 
		 
		echo $before_widget;  

		if( !empty( $instance['title'] ) ){ 
			$title = apply_filters( 'widget_title', $instance[ 'title' ] ); 
			echo $before_title . $title . $after_title; 
		}  

		if( !empty( $instance['before_widget_content'] ) ){ 
			echo $instance['before_widget_content']; 
		}  

		facebookall_render_embedded();  

		if( !empty( $instance['after_widget_content'] ) ){ 
			echo $instance['after_widget_content']; 
		}  

		echo $after_widget; 
	}  
    function update( $new_instance, $old_instance ) { 
      $instance = $old_instance; 
      $instance['title'] = strip_tags( $new_instance['title'] ); 
      $instance['before_widget_content'] = $new_instance['before_widget_content']; 
      $instance['after_widget_content'] = $new_instance['after_widget_content']; 
      $instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  
      return $instance; 
	}  
    function form( $instance ) { 
	  $defaults = array( 'title' => 'FacebookAll Embedded Posts', 'before_widget_content' => '', 'after_widget_content' => '' );  
      foreach( $instance as $key => $value )  
        $instance[ $key ] = esc_attr( $value );  
        $instance = wp_parse_args( (array)$instance, $defaults ); ?> 
		<p> 
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'before_widget_content' ); ?>"><?php _e( 'Before widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'before_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'before_widget_content' ); ?>" type="text" value="<?php echo $instance['before_widget_content']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'after_widget_content' ); ?>"><?php _e( 'After widget content:', 'facebookall' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'after_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'after_widget_content' ); ?>" type="text" value="<?php echo $instance['after_widget_content']; ?>" /> 
			<br /><br /><label for="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>"><?php _e( 'Hide for logged in users:', 'facebookall' ); ?></label> 
	<input type="checkbox" id="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'hide_for_logged_in' ); ?>" type="text" value="1" <?php if($instance['hide_for_logged_in']==1) echo 'checked="checked"'; ?> /> 
		</p> 
<?php 
  } 
} 
add_action( 'widgets_init', create_function( '', 'return register_widget( "FacebookAllEmbedWidget" );'));