<?php 

/**
 * @package business theme 
 * This script will add shortcode button to wordpress visual editor 
 */

class PB_Editor_Addons
{
	public $files;

	function __construct($files)
	{
		$this->files = $files;
		add_action('init' , array(&$this , 'add_button'));
	}

	function add_button()
	{
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) 
			return;

				add_filter("mce_external_plugins", array (&$this, 'add_tinymce_button' ));
				add_filter('mce_buttons', array (&$this, 'reg_tinymce_button' ));
	}

	function reg_tinymce_button($buttons) 
	{

		foreach ($this->files as $name => $value) {
			array_push($buttons, 'separator', $name );
		}
		
		return $buttons;
	}


	function add_tinymce_button($plugin_array) 
	{
		foreach ($this->files as $name => $path) {
			$plugin_array[$name] =  $path;
		}
		
		return $plugin_array;
	}
}

/**
 * $files [tinymce plugins array]
 */

$files = array(
		'sc_button' =>  get_template_directory_uri() . '/theme-addons/tinymce-addons/sc_button/sc_button.js'
	);
$new = new PB_Editor_Addons($files);
?>