<?php 
/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 
 
/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 *
 * @since 1.0.0
 */
function optionsframework_admin_init() 
{
	// Rev up the Options Machine
	global $of_options, $options_machine, $smof_data, $smof_details;
	if (!isset($options_machine))
		$options_machine = new bresponZive_themepacific_Options_Machine($of_options);

	do_action('optionsframework_admin_init_before', array(
			'of_options'		=> $of_options,
			'options_machine'	=> $options_machine,
			'smof_data'			=> $smof_data
		));
	
	if (empty($smof_data['smof_init'])) { // Let's set the values if the theme's already been active
		of_save_options($options_machine->Defaults);
		of_save_options(date('r'), 'smof_init');
		$smof_data = of_get_options();
		$options_machine = new bresponZive_themepacific_Options_Machine($of_options);
	}

	do_action('optionsframework_admin_init_after', array(
			'of_options'		=> $of_options,
			'options_machine'	=> $options_machine,
			'smof_data'			=> $smof_data
		));

}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function optionsframework_add_admin() {
	
        $of_page = add_theme_page( THEMENAME, 'Theme Options', 'edit_theme_options', 'tpcrn_framework', 'optionsframework_options_page');
	    $of_page2 = add_theme_page(  'Theme Doc', 'Theme Documentation', 'edit_theme_options', 'theme-documentaion', 'bresponZive_themepacific_theme_doc');

 	/* Add framework functionaily to the head individually*/
	add_action("admin_print_scripts-$of_page", 'of_load_only');
 	add_action("admin_print_styles-$of_page",'of_style_only');
	add_action("admin_print_styles-$of_page",'of_style_only');
	
}

/**
 * Build Theme Documetaion Themepacific.com
 *
 * @since 1.0.0
 */
 
function bresponZive_themepacific_theme_doc(){
		echo '
		
<div id="theme-doc" class="about-wrap">

	<div class="theme-thumbnail" style="float:left; margin-right:30px; "><img src="'. get_template_directory_uri() . '/screenshot.png" width="250" height="200" /></div>

	<div class="welcome-panel-content">
	
	<h1>Welcome to '.wp_get_theme().' WordPress theme!</h1>
	
	<p> BresponZive Mag is a Free WordPress theme that has come with Magazine/blog style layout. It is an easy-to-customize and fully featured WordPress Theme. It has 2 columns, unlimited homepage Widgetized sections. Theme has come with WP Nav menus, Widgetized sidebars and Popular Widgets. Theme is built on advanced solid framework which includes lots of advanced features and functions. </p>
	
 
 
				
		 
		<h3>Theme License </h3>
		<p>	The PHP code of the theme is licensed under the GPL license as is WordPress itself. You can read it here: http://codex.wordpress.org/GPL </p>
		<p>Text of License : http://www.gnu.org/licenses/old-licenses/gpl-2.0.html</p>
		<ul>
 		</ul>
 
				
<p>For Theme Support and any other Instructions Visit themepacific.com</p>
	<p>WordPress theme designed by <a href="http://themepacific.com">ThemePacific.com</a>.</p>
	<p>This theme is copyrighted to ThemePacific.</p>
	</div>
	</div>
		
		';
		

} 
 
/**
 * Build Options page
 *
 * @since 1.0.0
 */
function optionsframework_options_page(){
	
	global $options_machine;
	
	/*
	//for debugging

	$smof_data = of_get_options();
	print_r($smof_data);

	*/	
	
	include_once( ADMIN_PATH . 'front-end/options.php' );

}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function of_style_only(){
	wp_enqueue_style('admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
	//wp_enqueue_style('color-picker', ADMIN_DIR . 'assets/css/colorpicker.css');
	wp_enqueue_style('jquery-ui-custom-admin', ADMIN_DIR .'assets/css/jquery-ui-custom.css');

	if ( !wp_style_is( 'wp-color-picker','registered' ) ) {
		wp_register_style( 'wp-color-picker', ADMIN_DIR . 'assets/css/color-picker.min.css' );
	}
	wp_enqueue_style( 'wp-color-picker' );
	do_action('of_style_only_after');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function of_load_only() 
{
	//add_action('admin_head', 'smof_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-input-mask', ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	//wp_enqueue_script('color-picker', ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('smof', ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));


	// Enqueue colorpicker scripts for versions below 3.5 for compatibility
	if ( !wp_script_is( 'wp-color-picker', 'registered' ) ) {
		wp_register_script( 'iris', ADMIN_DIR .'assets/js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_register_script( 'wp-color-picker', ADMIN_DIR .'assets/js/color-picker.min.js', array( 'jquery', 'iris' ) );
	}
	wp_enqueue_script( 'wp-color-picker' );
	

	/**
	 * Enqueue scripts for file uploader
	 */
	
	if ( function_exists( 'wp_enqueue_media' ) )
		wp_enqueue_media();

	do_action('of_load_only_after');

}


/**
 * Ajax Save Options
 *
 * @uses get_option()
 *
 * @since 1.0.0
 */
function of_ajax_callback() 
{
	global $options_machine, $of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = of_get_options();
	
	$save_type = $_POST['type'];
	
	//echo $_POST['data'];
	
	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			of_save_options($upload_image);
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			of_save_options($delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		of_save_options($backup, BACKUPS) ;
			
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
			
		$smof_data = of_get_options(BACKUPS);

		of_save_options($smof_data);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){


		$smof_data = unserialize($_POST['data']); 
		of_save_options($smof_data);

		
		die('1'); 
	}
	elseif ($save_type == 'save')
	{

		wp_parse_str(stripslashes($_POST['data']), $smof_data);
		unset($smof_data['security']);
		unset($smof_data['of_save']);
		of_save_options($smof_data);
		
		
		die('1');
	}
	elseif ($save_type == 'reset')
	{
		of_save_options($options_machine->Defaults);
		
        die('1'); //options reset
	}

  	die();
}
