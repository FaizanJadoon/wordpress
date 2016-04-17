<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{ 
	  	$framework = 'tpcrn_';

 		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
$of_options[] = array( "name" => __('General Settings','bresponZive'),
                    "type" => "heading");
$of_options[] = array( "name" => "General",
					"desc" => "",
					"id" => "introduction",
					"std" => __('<h3>General Settings</h3>','bresponZive'),
					"icon" => true,
					"type" => "info");
					
					
$of_options[] = array( "name" => __('Custom Favicon','bresponZive'),
					"desc" =>  __('Upload a 16px x 16px Png/Gif image that will represent your website favicon','bresponZive'),
					"id" => "custom_favicon",
					"std" => "",
					"type" => "media"); 
$logo = get_template_directory_uri() . '/images/logo.png';					
$of_options[] = array( "name" => __('Custom Logo','bresponZive'),
					"desc" => __('Upload a Png/Gif image that will represent your website Logo.','bresponZive'),
					"id" => "custom_logo",
					"std" => $logo,
					"type" => "media"); 
 					
$of_options[] = array( "name" => __('Show Footer Widgets Section', 'bresponZive'),
					"desc" => __('Select to show the Footer Widgets.', 'bresponZive'),
					"id" => "shw_footer_widg",				 
					"std" 		=> 0,
					"on" 		=> "Show",
					"off" 		=> "Hide",
					"type" 		=> "switch"					
					);	
 			

$of_options[] = array( "name" => __('Home Settings','bresponZive'),
					"type" => "heading");
 
 					
$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "introduction",
					"std" => __('<h3>Home Page Content Organizer</h3>','bresponZive'),
					"icon" => true,
					"type" => "info");
 
 

$of_options[] = array( "name" => __('HomePage Slider','bresponZive'),
					"desc" => __('Show HomePage slider Options','bresponZive'),
					"id" => "offline_feat_slide",
					"std" => 0,
          			"folds" => 1,
					"type" => "switch"
					
					);  						
$of_options[] = array( "name" => __('Select a Category','bresponZive'),
					"desc" => __('Select category for slider. If you want to use theme slider options,then leave it to default option.','bresponZive'),
					"id" => "feat_slide_category",
					"std" => "0",
					"fold" => "offline_feat_slide",  
					"type" => "select",
					"options" => $of_categories);
 
 
  					
$of_options[] = array( "name" =>__('Single Posts','bresponZive'),
					"type" => "heading");
$of_options[] = array( "name" => "General",
					"desc" => "",
					"id" => "introduction",
					"std" => __('<h3>Single Posts Settings</h3>','bresponZive'),
					"icon" => true,
					"type" => "info");
 
$of_options[] = array( "name" => __('Show Single Post Next/Prev navigation','bresponZive'),
					"desc" => '',
					"id" => "posts_navigation",
					"std" => "Off",
					"type" => "radio",
					"options" => array(
						'On' => 'On',
						'Off' => 'Off'
						)); 
$of_options[] = array( "name" => __('Show Breadcrumbs','bresponZive'),
					"desc" => '',
					"id" => "posts_bread",
					"std" => "Off",
					"type" => "radio",
					"options" => array(
						'On' => 'On',
						'Off' => 'Off'
						));						
  						
$of_options[] = array( "name" => __('Show Tags on posts','bresponZive'),
					"desc" =>'',
					"id" => "posts_tags",
					"std" => "Off",
					"type" => "radio",
					"options" => array(
						'On' => 'On',
						'Off' => 'Off'
						)); 						
  
 
					
					
$of_options[] = array( "name" => __('Backup Options','bresponZive'),
					"type" => "heading");
$of_options[] = array( "name" => "General",
					"desc" => "",
					"id" => "introduction",
					"std" => __('<h3>Backup and Restore</h3>','bresponZive'),
					"icon" => true,
					"type" => "info");
										
$of_options[] = array( "name" => __('Backup and Restore Options','bresponZive'),
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.','bresponZive'),
					);
					
$of_options[] = array( "name" => __('Transfer Theme Options Data','bresponZive'),
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						','bresponZive'),
					);
					
	}
}
?>