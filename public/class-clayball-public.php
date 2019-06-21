<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       ryan.asdraw.com
 * @since      1.0.0
 *
 * @package    Clayball
 * @subpackage Clayball/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Clayball
 * @subpackage Clayball/public
 * @author     jevinsong <dooioomoo.work@gmail.com>
 */
class Clayball_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->init();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/clayball-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/clayball-public.js', array( 'jquery' ), $this->version, false );

	}

    private function init()
    {

        $this->clearnfiles = array(
            'removeversion.php',
            'disabletrackbacks.php',
            'navclearn.php',
            'nicesearch.php',
            'disable-emojis.php',
            'clear-google.php',
        );

        if (!is_admin()){
            array_push($this->clearnfiles,'clear_up.php');
        }
        $this->clayball_check_plugin_installed();
        $this->clayball_clearn_files();
        $this->clayball_add_widgets();
        if ($this->clayball_check_plugin_installed('js_composer/js_composer.php')) {
            add_action('vc_before_init', array($this, 'vc_before_init_actions'));
        }
    }

    private function clayball_clearn_files()
    {
        $clearnfilesnone = array();
        foreach ($this->clearnfiles as $filesname) {
            if (file_exists(__CLAYBALLPLUGINPATH__ . '/public/modules/' . $filesname)) {
                require_once(__CLAYBALLPLUGINPATH__ . '/public/modules/' . $filesname);
            }
        }   
    }

    private function clayball_add_widgets()
    {

        $suf_add_widgets = array(
            'sharebuttonforwidget.php',
            'add-login-button.php',
        );
        foreach ($suf_add_widgets as $filesname) {
            if (file_exists(__CLAYBALLPLUGINPATH__ . '/public/addons/widgets/' . $filesname)) {
                require_once(__CLAYBALLPLUGINPATH__ . '/public/addons/widgets/' . $filesname);
            }
        }
    }

    public function vc_before_init_actions()
    {
        $vc_addons_files = array(
            'homepage-newslist-table.php',
            'company-outline.php',
            'addons-clayball-post-slider.php',
        );

        foreach ($vc_addons_files as $filesname) {
            if (file_exists(__CLAYBALLPLUGINPATH__ . '/public/addons/vc-elements/' . $filesname)) {
                require_once(__CLAYBALLPLUGINPATH__ . '/public/addons/vc-elements/' . $filesname);
            }
        }
    }

    public function clayball_check_plugin_installed($plugin_name=''){
        $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
//        var_dump($active_plugins);
        return in_array($plugin_name,$active_plugins);
    }

}
