<?php 
/**
 * @class Amdin Interface Class
 * - this class will register admin page options
 * - will load admin scripts and styles
 * @var $page_slug [options page slug]
 * @var $prefix [options prefix]
 * @var $main_title [options page main title]
 * @important @call @var $pages [pages array]
 * @important @styles @var [styles array , $key = name , $value = .css path]
 * @important @scripts @var [scripts array , $key = name , $value = .js path]
 */

class DS_ADMIN_INTERFACE {

	/**
	 * Properties
	 */
	private static  $page_slug;
	private static  $prefix = 'dsf_';
	private static  $main_title = 'Theme Options';
	private static  $pages;
	private static  $styles; 
	private static  $scripts;
	public  static  $theme_icon = '';
	public  static  $error = false;
	private static  $dsf_options_hook;
	public  static 	$version = '2.0';
	public  static 	$copyrights = '<a href="http://twitter.com/waleed_871">Follow Us</a>';
	public  static  $settings_group  = 'dsf_settings_group'; 


	/**
	 * Set up defaults
	 */
	public function __construct($pages = '' , $slug = 'dsf_options' , $styles = '' , $scripts = '') {

		self::$page_slug = $slug;
		self::$pages = $pages;
		self::$styles = $styles;
		self::$scripts = $scripts;
	}


	/**
	 * Init , call this function to register admin pages 
	 */
	public function init() {

			// Register Theme Options Page
			add_action('admin_menu' , array(&$this , 'register_page'));

			// Register Settings
			// @note : this will use the $this->pages array to register settings , and $this->dsf_options_group
			add_action('admin_init' , array(&$this , 'setup_theme_settings'));

			// Thickbox button 
			add_filter("attribute_escape", array(&$this , 'changeThickboxButton'), 10, 2);

			// Register Options Page Scripts and Styles
			add_action('admin_enqueue_scripts', array(&$this , 'register_admin_scripts'));

			// Save Options
			add_action('wp_ajax_dsf_save_options' , array(&$this , 'dsf_save_options'));

			// Delete Settings
			add_action('wp_ajax_dsf_delete_options' , array(&$this , 'dsf_delete_options'));
	}


	/**
	 * Register Admin Page Options
	 */
	public  function register_page() {

		/**
		 * Register admin page
		 * @var $page [page options array]
		 */
		$dsf_page = array(
						'theme_title' => self::$main_title,
						'menu_title' => __('Theme Options' , 'dsf'),
						'theme_capability' => 'manage_options',
	                    'theme_slug' => 'dsf_options', // Fix
	                    'theme_callback' => array(&$this, 'print_admin_page'), // theme page function
	                    'theme_icon' => self::$theme_icon,
	                    'page_position' => '99'
					);


		/**
		 * Register the page
		 */
		self::$dsf_options_hook    =  add_theme_page(
									  $dsf_page['theme_title'] , 
							          $dsf_page['menu_title'] ,
							          $dsf_page['theme_capability'] ,
							          $dsf_page['theme_slug'],
									  $dsf_page['theme_callback'] ,
									  $dsf_page['theme_icon'] , 
									  $dsf_page['page_position']
		);
	}


	/**
	 * Register Admin Script And Print Them
	 */
	public function register_admin_scripts($hook) {

		/**
		 * This will load admin page styles and scripts
		 * @note admin styles and scripts are provided in $this->scripts and $this->styles  
		 */
		
		// check if this is the options page
		if($hook == self::$dsf_options_hook) {


				// Load Scripts
				if( is_array(self::$scripts) && !empty(self::$scripts) ){

						/**
						 * Essential Scripts
						 */
						
						wp_enqueue_script('jquery');
						wp_enqueue_script('thickbox');
						wp_enqueue_style('thickbox');

						foreach (self::$scripts as $key => $path) {
							wp_register_script($key , $path , array('jquery'));
							wp_enqueue_script($key);
						}

				}// end load scripts

				// Load Styles
				if( is_array(self::$styles) && !empty(self::$styles) ){


						foreach (self::$styles as $key => $path) {
							wp_register_style($key , $path);
							wp_enqueue_style($key);
						}

				}// end load styles
		}
		
	}


	/**
	 * Print Admin Page
	 */
	public function print_admin_page() {


		// check if there's error message
		if(self::$error != false && isset(self::$error)) {

			echo '<h4>'.self::$error.'</h4>';
		}
		else
		{

		/**
		 * Admin Interface ,
		 * - this will call $this->register_admin_scripts first 
		 * - and this will load options array (ds-options-list.php)
		 * - finally , creating options page 
		 */
		
		?>


			<!-- container -->
			<div class="dsf-container">
				

				<!-- head -->
				<div class="head">


						<h1><?php _e('Theme Options' , 'dsf'); ?></h1>
						
						<div class="meta">
							
							<p>Version : <?php echo self::$version; ?> , </p>
							<p><?php echo self::$copyrights; ?> </p>

						</div>

				</div>
				<!-- end head -->


				<!-- pages -->
				<div class="pages">
						

						<!-- navigation -->
						<div class="navigation">
							<ul>
							<?php 

								foreach(self::$pages as $page) {
									echo '<li class="links"><a href="#'.$page['id'].'">'.$page['title'].'</a></li>';
								}

							?>
							</ul>

						</div>
						<!-- end navigation -->



						<!-- pages container -->
						<div class="pages-container">
							

							<?php foreach(self::$pages as $page) : ?>


								<!-- single page -->
								<div class="single-page" id="<?php echo $page['id']; ?>">
									



									<!-- fields -->

									<?php foreach($page['fields'] as $field) : 

										  extract($field);
									?>

										<!-- field -->
										<div class="field">

											<h3><?php echo $title; ?></h3>

											<!-- input -->
											<div class="input">

												


													<?php  

														switch($type) { 
															

															/**
															 * Upload 
															 */
															case 'upload' :
															?>
															<input 
															type="text" id="<?php echo $id; ?>" 
																		class="dsf_upload" value="<?php echo get_option($id); ?>" 
																		name="<?php echo $id; ?>" />
															<div class="controls">
																
																
																<a href="javascript:void(0);" 
																			title="<?php _e('Upload' , 'dsf'); ?>"
																			class="upload button-two">
																			<?php _e('Upload' , 'dsf'); ?>
																</a>
															</div>
															<!-- end controls -->
															<!-- uploaded image -->
															<div style="max-width: 300px; max-height: 300px;" class="uploadedImage">
																

																	<a href="javascript:void(0);" 
																		title="<?php _e('Remove' , 'dsf'); ?>"
																		class="remove button-one">
																		<?php _e('Remove' , 'dsf'); ?>
																	</a>
																
															</div>
															<?php
															break;


															/**
															 * Email Field
															 */
															case 'email' :
															?>
															<input 
															type="email" id="<?php echo $id; ?>" 
																		class="email" value="<?php echo get_option($id); ?>" 
																		name="<?php echo $id; ?>" />
															<?php
															break;



															/**
															 * Background Selection
															 */
															case 'background' :

															?>

															<input hidden=true id="<?php echo $id; ?>" type="text" name="<?php echo $id; ?>" class="text hidden-background-field" value="<?php echo get_option($id); ?>" />

															<!-- images -->
															<div class="images-selection">
																	
																	<?php foreach ($images as $img_id => $img_path) {
																		
																		?>

																		<span class="image <?php if(get_option($id) == $img_path) echo 'active'; ?>" title="<?php echo $img_id; ?>">
																			<img src="<?php echo $img_path; ?>" alt="" />
																		</span>

																		<?php
																	} ?>

															</div>
															<!-- end images -->

															<?php

															break;


															/**
															 * Background Selection
															 */
															case 'background_large' :

															?>

															<input hidden=true id="<?php echo $id; ?>" type="text" name="<?php echo $id; ?>" class="text hidden-background-field" value="<?php echo get_option($id); ?>" />

															<!-- images -->
															<div class="images-selection-large">
																	
																	<?php foreach ($images as $img_id => $img_path) {
																		
																		?>

																		<span class="image <?php if(get_option($id) == $img_id) echo 'active'; ?>" title="<?php echo $img_id; ?>">
																			<img src="<?php echo $img_path; ?>" alt="" />
																		</span>

																		<?php
																	} ?>

															</div>
															<!-- end images -->

															<?php

															break;





															/**
															 * Textarea
															 */
															case 'textarea' :
															?>
															<textarea name="<?php echo $id; ?>"
																	  id="<?php echo $id; ?>"><?php echo stripslashes_deep(get_option($id)); ?></textarea>
															<?php
															break;



															/**
															 * Select
															 */
															case 'select' :
															?>	
															<select class="full"
															id="<?php echo $id; ?>" 
															name="<?php echo $id; ?>" 
															value="<?php echo get_option($id); ?>">

																<?php 

																		foreach($field_array as $field) {

																			?>
																			<option <?php if(get_option($id) == $field) echo 'selected=selected'; ?> 
																			value="<?php echo $field; ?>"><?php echo $field; ?></option>
																			<?php
																		}
																 ?>
															</select>
															<?php
															break;



															/**
															 * Multi Select
															 */
															case 'multi_select' :
																echo '<span class="'.$class.'"></span>';
																foreach ($menus as $menu) :
																extract($menu);
																?>
																	<select class="half" name="<?php echo $id; ?>"
																			id="<?php echo $id; ?>"
																			value="<?php echo get_option($id); ?>">
																		
																		<?php

																		if(is_array($fields)) {
																			foreach($fields as $field) :

																			?>

																			<option 
																					<?php if(get_option($id) == $field['name']) {
																							echo ' selected=selected ';
																						}  
																					?>
																					data-variants="<?php echo $field['variants']; ?>"
																					id="<?php echo $field['id']; ?>"
																					value="<?php echo $field['name']; ?>">
																			<?php echo $field['name']; ?></option>

																			<?php

																			endforeach;
																		}
																		else
																		{
																			if(get_option($id) != '') {

																				echo '<option 
																						selected=selected 
																						value="'.get_option($id).'"">
																						'.get_option($id).'
																						</option>';
																			}
																		}
																		?>

																	</select>
																<?php
																endforeach;
															break;


															/**
															 * CheckBox
															 */
															case 'checkbox' :
															?>
															<input
															name="<?php echo $id; ?>" id="<?php echo $id; ?>"
															type="checkbox" value="" <?php if(get_option($id) == 'checked') echo 'checked=checked;'; ?> class="checkbox" />
															<?php
															break;


															/**
															 * Columns
															 */
															case 'columns' :
															break;


															/**
															 * UI Slider
															 */
															case 'slider' :
															?>
															<input type="text" class="text slider" name="<?php echo $id; ?>"
																   id="<?php echo $id; ?>"
																   value="<?php echo get_option($id); ?>" />
															<div class="slidercontrol"></div>
															<?php
															break;


															/**
															 * Color
															 */
															case 'color' :
															?>
															<p class="colorpickerHolder"></p>
															<input type="text" name="<?php echo $id; ?>"
																	id="<?php echo $id; ?>"
																	class="text cc"
																	value="<?php echo get_option($id); ?>" />
																	<a href="#" class="reset-input-color" data-val="<?php echo  $field['default']; ?>"><?php echo __('Reset' , 'dsf'); ?></a>
															<?php
															break;


															/**
															 * Text Field
															 */
															case 'text' :
															?>
															<input 
															type="text" id="<?php echo $id; ?>" 
																		class="text" value="<?php echo get_option($id); ?>" 
																		name="<?php echo $id; ?>" />
															<?php
															break;



														}
													?>

											</div>
											<!-- end input -->



											<!-- desc -->
											<div class="description">

												<p><?php echo $desc; ?></p>

											</div><!-- end description -->

										</div><!-- end single field -->



									<?php endforeach; // end single field ?>

									<!-- end fields -->


								</div><!-- end single page -->


							<?php endforeach; ?>


							<!-- Save Button -->
							<a href="#" class="save_post"><?php _e('Save' , 'dsf'); ?></a>

							<!-- reset options -->
							<a href="#" class="reset_options"><?php _e('Reset' , 'dsf'); ?></a>

							<?php  settings_fields(self::$settings_group); ?>

						</div><!-- end pages container -->

				</div><!-- end pages -->


			</div>
			<!-- end container -->


		<?php
		} //end else $this->error
	}




	/**
	 * Save Options , 
	 * this function will save admin options using wp_ajax
	 */
	public function dsf_save_options() {

		if(isset($_POST)) {

			/**
			 * @var defined options in self::$pages
			 */
			$definedOptions = array();
			foreach(self::$pages as $page) {
				
				foreach($page['fields'] as $field) {

					if($field['type'] == 'multi_select') 
					{
						foreach($field['menus'] as $menu) {
							extract($menu);
							$definedOptions[] = $id;
						}
					}
					else
					{
						$definedOptions[] = $field['id'];
					}
					
				}

			}



			/**
			 * Update Options 
			 */
			foreach($_POST as $key => $value) {

				/**
				 * Check if the field exist
				 */
				if(in_array($key , $definedOptions) && $value != '') 
				{
					if(get_option($key) !== $value) update_option($key , $value);
				}
				elseif(in_array($key , $definedOptions) && $value == '') 
				{	
					update_option($key , $value);
				}

			} 

			die();
		}

	}




	/**
	 * Delete All Options
	 */
	public function dsf_delete_options() {

		if(isset($_POST['action']) && $_POST['action'] == 'dsf_delete_options') {

			foreach(self::$pages as $page) {
				
				foreach($page['fields'] as $field) {

					
					delete_option($field['id']);
				}

			}
		}

		die();
	}



	/**
	 * Setup Theme Settings
	 */
	public function setup_theme_settings() {

		foreach(self::$pages as $page) {
				
				foreach ($page['fields'] as $field) {
					
					extract($field);

					// register setting
					register_setting(self::$settings_group , $id);
				}							
		}

	}




	/**
	 * Change thickbox insert button text
	 */
	public function changeThickboxButton($safe_text, $text) {
    	return str_replace(__('Insert into Post' , 'dsf'), __('Use this image' , 'dsf'), $text);
	}




	
}




/**
 * Call init() , $pages = options array (ds-options-list.php);
 * - first we will require the options list page
 * - then we will define scripts array
 * - then we will also define styles array 
 * - finally we will call init() funciton 
 */
require_once(dirname(__FILE__) . '/ds-options-list.php');

// check if there's options page 
if(isset($dsf_pages) && is_array($dsf_pages)) 
{
	// Styles
	$styles = array(
				'open_sans_font' => 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800',
				'zebra_css' =>  get_template_directory_uri() . '/ds-framework/libs/zebra_transform.css',
				'admin_css' =>  get_template_directory_uri() . '/ds-framework/libs/ds-main-styles.css',
				'colorpicker_css' =>  get_template_directory_uri() . '/ds-framework/libs/colorpicker/css/colorpicker.css',
				'ui-css' =>  get_template_directory_uri() . '/ds-framework/libs/jquery-ui.css'

	);

	// Scripts
	$scripts = array(
				'jquery-ui-all-min' =>  get_template_directory_uri() . '/ds-framework/libs/jquery-ui-all.min.js',
				'zebra_transform' =>  get_template_directory_uri() . '/ds-framework/libs/zebra_transform.js',
				'colorpicker_js' =>  get_template_directory_uri() . '/ds-framework/libs/colorpicker/js/colorpicker.js',
				'admin_js' =>  get_template_directory_uri() . '/ds-framework/libs/ds-main-scripts.js'
				
	);

	// Call init
	$dsadmin = new DS_ADMIN_INTERFACE($pages = $dsf_pages , $slug = 'dsf_options' , $styles = $styles , $scripts = $scripts);
	$dsadmin->init();
}
else
{

	// if there's no options page and this class is included in theme or plugin files
	$dsadmin = new DS_ADMIN_INTERFACE;
	$dsadmin->error = 'Error : No Options Page Are Defined .';
	$dsadmin->init();

}


?>