<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://wenthemes.com
 * @since      1.0.0
 *
 * @package    WEN_Responsive_Columns
 * @subpackage WEN_Responsive_Columns/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    WEN_Responsive_Columns
 * @subpackage WEN_Responsive_Columns/admin
 * @author     WEN Themes <info@wenthemes.com>
 */
class WEN_Responsive_Columns_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WEN_Responsive_Columns_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WEN_Responsive_Columns_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wen-responsive-columns-admin.css', array(), $this->version, 'all' );

	}

  /**
   * Hook Tiny MCE buttons.
   *
   * @since    1.0.0
   */
  function tinymce_button(){

    if ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) {
         add_filter( 'mce_buttons', array($this,'register_tinymce_button' ) );
         add_filter( 'mce_external_plugins', array($this,'add_tinymce_button' ) );
    }

  }

  /**
   * Register TinyMce Button.
   *
   * @since    1.0.0
   */
  function register_tinymce_button( $buttons ){

    array_push( $buttons, 'wen_responsive_columns' );
    return $buttons;

  }

  /**
   * Add TinyMCE Button.
   *
   * @since    1.0.0
   */
  function add_tinymce_button( $plugin_array ){

    $plugin_array['wen_responsive_columns'] = WEN_RESPONSIVE_COLUMNS_URL . '/admin/js/wen-responsive-columns-tinymce-plugin.js';
    return $plugin_array;

  }


  /**
   * TinyMCE popup.
   *
   * @since    1.0.0
   */
  function tinymce_popup(){
    ?>
    <div id="wrc-popup-form" style="display:none">
      <div>
        <div class="wrc-form-content">

          <div class="form-row">
            <label for="wrc-grid"><?php _e( 'Grid:', 'wen-responsive-columns' ); ?></label>
            <select name="wrc-grid" id="wrc-grid">
              <option value=""><?php _e( 'Select', 'wen-responsive-columns' ); ?></option>
              <option value="2"><?php _e( '2', 'wen-responsive-columns' ); ?></option>
              <option value="3"><?php _e( '3', 'wen-responsive-columns' ); ?></option>
              <option value="4"><?php _e( '4', 'wen-responsive-columns' ); ?></option>
              <option value="5"><?php _e( '5', 'wen-responsive-columns' ); ?></option>
              <option value="12"><?php _e( '12', 'wen-responsive-columns' ); ?></option>
            </select>
            <p class="description"><?php _e( 'Please select grid. Grid represents maximum number of columns allowed.', 'wen-responsive-columns' ); ?></p><!-- .description -->
          </div><!-- .form-row -->

          <div class="form-row">
            <label for="wrc-column-number"><?php _e( 'Number of Columns:', 'wen-responsive-columns' ); ?></label>
            <select name="wrc-column-number" id="wrc-column-number">
              <option value=""><?php _e( 'Select', 'wen-responsive-columns' ); ?></option>
            </select>
            <p class="description"><?php _e( 'Please select number of columns.', 'wen-responsive-columns' ); ?></p><!-- .description -->

          </div><!-- .form-row -->

          <div class="form-row" id="wrc-column-mix-wrap" style="display:none;">
            <label><?php _e( 'Column Mix:', 'wen-responsive-columns' ); ?></label>
            <div id="wrc-column-mix">&nbsp;</div><!-- #wrc-column-mix -->
            <p class="description"><?php _e( 'Please enter column mix. Eg, for grid 3 and columns 2, mix could be 1-2 or 2-1', 'wen-responsive-columns' ); ?></p><!-- .description -->
          </div><!-- .form-row -->

          <div class="form-row">
            <input type="button" id="wrc-submit" class="button-primary" value="<?php esc_attr( _e( 'Insert', 'wen-responsive-columns' ) ); ?>" name="submit" />
          </div><!-- .form-row -->

        </div><!-- .wrc-form-content -->

      </div>

    </div><!-- #wrc-popup-form -->
    <?php


  }

  /**
   * Load TinyMce languages file.
   *
   * @since    1.0.0
   */
  function tinymce_external_language( $locales ){

    $locales ['wen-responsive-columns'] = WEN_RESPONSIVE_COLUMNS_DIR. '/admin/partials/wen-responsive-columns-tinymce-plugin-langs.php';
    return $locales;

  }

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wen-responsive-columns-admin.js', array( 'jquery' ), $this->version, false );
    $extra_array = array(
      'lang' => array(
        'select'               => __( 'Select', 'wen-responsive-columns' ),
        'your_content'         => __( 'Your content', 'wen-responsive-columns' ),
        'please_select_grid'   => __( 'Please select grid', 'wen-responsive-columns' ),
        'please_select_column' => __( 'Please select column', 'wen-responsive-columns' ),
        'invalid_column_mix'   => __( 'Invalid column mix', 'wen-responsive-columns' ),
      ),
    );
    wp_localize_script( $this->plugin_name, 'WRC_OBJ', $extra_array );
    wp_enqueue_script( $this->plugin_name );


	}

}
