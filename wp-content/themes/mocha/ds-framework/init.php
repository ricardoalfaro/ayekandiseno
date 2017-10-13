<?php 
/**
 * DS Wordpress Themes Framework
 * created by waleed_ds http://waleedomar.com , http://themeforest.net/user/waleed_ds
 */

/**
 * @class Ds_Init
 * - load framework functions and actions
 * - load admin panel interface
 * - load extra tinymce plugins
 */

class DS_INIT {


	/**
	 * Deafult Paths 
	 */
	private $framework_path;
	private $functions_path;
	private $admin_interface_path;
	private $backend_path;
	private $frontend_path;
	private $styles;
	private $scripts;
	private $instance = '';


	/**
	 * Define Framework Paths
	 */
	public function __construct($path = '') {
		
		$this->framework_path = $path;
		$this->functions_path = $this->framework_path . '/include/functions';
		$this->admin_interface_path = $this->functions_path . '/ds-admin-interface.php';
		$this->frontend_path = $this->framework_path . '/theme-addons/theme-frontend';
		$this->backend_path = $this->framework_path . '/theme-addons/theme-backend';

	}


	/**
	 * Init 
	 */
	public function init($instance = '' , $scripts = '' , $styles = '') {

		/**
		 * This function will output admin backend parts 
		 * @var $instance [array OR single string] , you can define what part of framework should be printed
		 * @defaults array('admin_interface' , 'tinymce_addons' , 'theme_addons')
		 * admin_interface will load backend admin interface and backend actions / options / custom posts .. etc
		 * theme_addons will load front-end theme widgets and shortcodes
		 * tinymce_addons will load back-end extra editor buttons
		 */
		
		if($instance != '') {

			if(is_array($instance)) {

				foreach ($instance as $key) {
					
					if($key == 'admin_interface') 
					{   
						$this->admin_interface(); 
						if($key == 'admin_interface') $this->theme_support();
					}
					if($key == 'tinymce_addons') $this->admin_tinymce();
					if($key == 'theme_addons') $this->theme_addons($scripts , $styles);
				}
			}
			else
			{
					if($instance == 'admin_interface') 
					{
						$this->admin_interface();
						if($instance == 'admin_interface') $this->theme_support();
					}
					if($instance == 'tinymce_addons') $this->admin_tinymce();
					if($instance == 'theme_addons') $this->theme_addons($scripts , $styles);
			}
		}

	}


	/**
	 * Load Admin Interface
	 */
	private function admin_interface() {

		$this->load($this->admin_interface_path);
	}

	/**
	 * Load Tinymce
	 */
	private function admin_tinymce() {
		$this->load($this->backend_path . '/theme-tinymce-addons.php');
	}


	/**
	 * Load Framework Actions And Functions
	 */
	private function theme_support() {
		$this->load($this->backend_path . '/theme-support.php');
	}



	/**
	 * Load Theme Addons (widgets , shortcodes , custom post types .. etc)
	 */
	private function theme_addons($scripts , $styles) {

		/**
		 * Register Front End Scripts
		 */
		$this->scripts = $scripts;
		$this->styles = $styles;
		add_action('wp_enqueue_scripts' , array(&$this , 'register_frontend_scripts') , 99);
		add_action('wp_enqueue_scripts' , array(&$this , 'register_frontend_styles') , 99);

		/**
		 * Require Custom Posts
		 */
		$this->load($this->backend_path . '/theme-custom-posts.php');
		
	}




	/**
	 * This Will Register Frontend Styles And Scripts
	 * @return [type] [description]
	 */
	public function register_frontend_scripts() {


		/**
		 * This will register front end scripts , $this->scripts is provided in init()
		 */
		if(isset($this->scripts) && is_array($this->scripts)) {

			foreach ($this->scripts as $key => $path) {
				
				wp_register_script($key , $path , array('jquery'));
				wp_enqueue_script($key);
			}
		}
	}




	/**
	 * This will register frontend styles
	 */
	public function register_frontend_styles() {

		if(isset($this->styles) && is_array($this->styles)) {

			foreach ($this->styles as $key => $path) {
				
				wp_register_style($key , $path);
				wp_enqueue_style($key);
			}

		}
	}


	/**
	 * Load , this function will load framework parts by path 
	 */
	private function load($path = '') {

		if(isset($path) && $path != '') {

			if(file_exists($path)) require_once($path);
			else return 'Could not load ' . $path;
		}

	}
	
}


/**
 * Load Admin Interface
 * @var DS_INIT
 */
$new_dsf = new DS_INIT(dirname(__FILE__));
$new_dsf->init('admin_interface');


?>