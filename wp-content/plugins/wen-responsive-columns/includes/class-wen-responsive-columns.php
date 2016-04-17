<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://wenthemes.com
 * @since      1.0.0
 *
 * @package    WEN_Responsive_Columns
 * @subpackage WEN_Responsive_Columns/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WEN_Responsive_Columns
 * @subpackage WEN_Responsive_Columns/includes
 * @author     WEN Themes <info@wenthemes.com>
 */
class WEN_Responsive_Columns {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WEN_Responsive_Columns_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'wen-responsive-columns';
		$this->version = '1.1';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
    $this->init_shortcodes();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WEN_Responsive_Columns_Loader. Orchestrates the hooks of the plugin.
	 * - WEN_Responsive_Columns_i18n. Defines internationalization functionality.
	 * - WEN_Responsive_Columns_Admin. Defines all hooks for the dashboard.
	 * - WEN_Responsive_Columns_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wen-responsive-columns-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wen-responsive-columns-i18n.php';

    /**
     * The class responsible for defining shortcodes of the plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wen-responsive-columns-shortcode.php';


		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wen-responsive-columns-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wen-responsive-columns-public.php';

		$this->loader = new WEN_Responsive_Columns_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WEN_Responsive_Columns_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WEN_Responsive_Columns_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register shortcodes.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
  public function init_shortcodes(){

    $plugin_shortcode = new WEN_Responsive_Columns_Shortcode();
    $plugin_shortcode->init();

  }


  /**
   * Register all of the hooks related to the dashboard functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
	private function define_admin_hooks() {

		$plugin_admin = new WEN_Responsive_Columns_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

    // Button in toolbar
    $this->loader->add_action( 'admin_init', $plugin_admin, 'tinymce_button' );
    $this->loader->add_action( 'admin_footer', $plugin_admin, 'tinymce_popup' );

    // Tinymce language
    $this->loader->add_filter( 'mce_external_languages', $plugin_admin, 'tinymce_external_language' );


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new WEN_Responsive_Columns_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    // Call shortcode for column content
    add_filter( 'wrc_column_content', 'do_shortcode' );

    // Fix p and br tag bug
    remove_filter( 'the_content', 'wpautop' );
    add_filter( 'the_content', 'wpautop' , 12);
		$this->loader->add_filter( 'wrc_column_content', $plugin_public, 'fix_extra_tags', 12 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WEN_Responsive_Columns_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
