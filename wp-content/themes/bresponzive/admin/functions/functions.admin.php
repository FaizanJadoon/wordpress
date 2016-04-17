<?php
/**
 * SMOF Admin
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 

/**
 * Head Hook
 *
 * @since 1.0.0
 */
function of_head() { do_action( 'of_head' ); }

/**
 * Add default options upon activation else DB does not exist
 *
 * DEPRECATED, Class_options_machine now does this on load to ensure all values are set
 *
 * @since 1.0.0
 */
function of_option_setup()	
{
	global $of_options, $options_machine;
	$options_machine = new bresponZive_themepacific_Options_Machine($of_options);
		
	if (!of_get_options())
	{
		of_save_options($options_machine->Defaults);
	}
}

/**
 * Change activation message
 *
 * @since 1.0.0
 */
function optionsframework_admin_message() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
    	
        var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=tpcrn_framework'); ?>">ThemePacific options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
	
}

/**
 * Get header classes
 *
 * @since 1.0.0
 */
function of_get_header_classes_array() 
{
	global $of_options;
	
	foreach ($of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}

/**
 * Get options from the database and process them with the load filter hook.
 *
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @return array
 */
function of_get_options($key = null, $bresponZive_tpcrn_data = null) {
	global $smof_data;

	do_action('of_get_options_before', array(
		'key'=>$key, 'data'=>$bresponZive_tpcrn_data
	));
	if ($key != null) { // Get one specific value
		$bresponZive_tpcrn_data = get_theme_mod($key, $bresponZive_tpcrn_data);
	} else { // Get all values
		$bresponZive_tpcrn_data = get_theme_mods();	
	}
	$bresponZive_tpcrn_data = apply_filters('of_options_after_load', $bresponZive_tpcrn_data);
	if ($key == null) {
		$smof_data = $bresponZive_tpcrn_data;
	} else {
		$smof_data[$key] = $bresponZive_tpcrn_data;
	}
	do_action('of_option_setup_before', array(
		'key'=>$key, 'data'=>$bresponZive_tpcrn_data
	));
	return $bresponZive_tpcrn_data;

}

/**
 * Save options to the database after processing them
 *
 * @param $bresponZive_tpcrn_data Options array to save
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @uses update_option()
 * @return void
 */

function of_save_options($bresponZive_tpcrn_data, $key = null) {
	global $smof_data;
    if (empty($bresponZive_tpcrn_data))
        return;	
    do_action('of_save_options_before', array(
		'key'=>$key, 'data'=>$bresponZive_tpcrn_data
	));
	$bresponZive_tpcrn_data = apply_filters('of_options_before_save', $bresponZive_tpcrn_data);
	if ($key != null) { // Update one specific value
		if ($key == BACKUPS) {
			unset($bresponZive_tpcrn_data['smof_init']); // Don't want to change this.
		}
		set_theme_mod($key, $bresponZive_tpcrn_data);
	} else { // Update all values in $bresponZive_tpcrn_data
		foreach ( $bresponZive_tpcrn_data as $k=>$v ) {
			if (!isset($smof_data[$k]) || $smof_data[$k] != $v) { // Only write to the DB when we need to
				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key=>$val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
	  	}
	}
    do_action('of_save_options_after', array(
		'key'=>$key, 'data'=>$bresponZive_tpcrn_data
	));

}


/**
 * For use in themes
 *
 * @since forever
 */



$bresponZive_tpcrn_data = of_get_options();
if (!isset($smof_details))
	$smof_details = array();