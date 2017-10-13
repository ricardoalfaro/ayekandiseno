<?php 
/**
 * @package ds-frameowrk
 * gallery post type
 */



class DsfGallery 
{

		private $slug = 'gallery';
		private $slugID = 'gallery_images';


		function __construct() {

		}


		/**
		 * Init (register post type and meta boxes)
		 */
		public function init() {

			/**
			 * Register Post Type
			 */
			add_action('init' , array(&$this , 'dsf_register_gallery'));

			

		}




		/**
		 * Register The Post Type
		 */
		public function dsf_register_gallery() {


			/**
			 * Post Type Lables
			 */
			$labels = array(
						'name' => _x('Gallery', 'gallery', 'dsf'),
					    'singular_name' => _x('Gallery', 'gallery', 'dsf'),
					    'add_new' => _x('Add New', 'gallery', 'dsf'),
					    'add_new_item' => __('Add New Gallery Item', 'dsf'),
					    'edit_item' => __('Edit Items', 'dsf'),
					    'new_item' => __('New Gallery Item', 'dsf'),
					    'all_items' => __('All Items', 'dsf'),
					    'view_item' => __('View Book', 'dsf'),
					    'search_items' => __('Search Gallery', 'dsf'),
					    'not_found' =>  __('No gallery items found', 'dsf'),
					    'not_found_in_trash' => __('No gallery items found in Trash', 'dsf'), 
					    'parent_item_colon' => '',
					    'menu_name' => __('Gallery', 'dsf')
			);

			/**
			 * Post Type Args
			 */
			$args = array(
					    'labels' => $labels,
					    'public' => true,
					    'publicly_queryable' => true,
					    'show_ui' => true, 
					    'show_in_menu' => true, 
					    'query_var' => true,
					    'rewrite' => array( 'slug' => _x( 'gallery', 'gallery', 'dsf' ) ),
					    'menu_icon' => get_template_directory_uri().'/ds-frameowrk/libs/images/gallery.png',
					    'capability_type' => 'post',
					    'has_archive' => true, 
					    'hierarchical' => false,
					    'menu_position' => null,
					    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
					    'taxonomies' => array('category','post_tag' , 'post_thumbnail' )
					  );

			/**
			 * Register post type
			 */
			register_post_type($this->slug , $args);


		}


		
}



/**
 * Call Class
 */
$gallery = new DsfGallery;
$gallery->init();

?>