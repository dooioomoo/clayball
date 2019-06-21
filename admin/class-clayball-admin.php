<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       ryan.asdraw.com
 * @since      1.0.0
 *
 * @package    Clayball
 * @subpackage Clayball/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Clayball
 * @subpackage Clayball/admin
 * @author     jevinsong <dooioomoo.work@gmail.com>
 */
class Clayball_Admin {

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
        if (is_admin()) self::run_admin();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Clayball_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Clayball_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/clayball-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Clayball_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Clayball_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/clayball-admin.js', array( 'jquery' ), $this->version, false );

	}

	private function run_admin(){
        require_once(__CLAYBALLPLUGINPATH__ . '/admin/partials/' . 'clayball-admin-display.php');
        require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'clayball-setting.php');
        require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'clayball-add-multiple-images.php');
        $this->admin_init();
    }

    private function admin_init(){
        $this->modules = array(
            'custom-admin-menu.php',
        );

        foreach ($this->modules as $filesname) {
            if (file_exists(__CLAYBALLPLUGINPATH__ . '/admin/modules/' . $filesname)) {
                require_once(__CLAYBALLPLUGINPATH__ . '/admin/modules/' . $filesname);
            }
        }
    }



}
