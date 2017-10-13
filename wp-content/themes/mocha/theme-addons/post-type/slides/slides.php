<?php

 /* -------------------------------------------------------------- 
 	slides Post TYpe
  -------------------------------------------------------------- */


add_action('init', 'register_slides');

function register_slides(){
    $labels = array(
		'name' => __('Slides', 'New Slide' , 'dsf'),
		'singular_name' => __('slidess', 'Slides' , 'dsf'),
		'add_new' => __('Add New', 'Slides' , 'dsf'),
		'add_new_item' => __('Add New Slide' , 'dsf'),
		'edit_item' => __('Edit Slide' , 'dsf'),
		'new_item' => __('New Slide' , 'dsf'),
		'view_item' => __('View Slides' , 'dsf'),
		'search_items' => __('Search Slides' , 'dsf'),
		'not_found' =>  __('Nothing found' , 'dsf'),
		'not_found_in_trash' => __('Nothing found in Trash' , 'dsf'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri().'/img/slide-img.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor')
	  ); 
 
	register_post_type( 'slides' , $args );

}



// adding meta fields
$slides_fields = array(
                    'id' => 'dsf-meta-items',
                    'title' => __('Post Settings','dsf'),
                    'page' => array('slides'),
                    'context' => 'normal',
                    'priority' => 'high',
                    'fields' => array(

                                         array(
                                             'id' => 'mp3',
                                             'desc' => __('Add slide link','dsf'),
                                             'name' => __('Slide link','dsf'),
                                             'type' => 'text'
                                        ),

                                         array(
                                             'id' => 'ogg',
                                             'desc' => __('Add slide link text','dsf'),
                                             'name' => __('Slide link text','dsf'),
                                             'type' => 'text'
                                        )
                                       
                    					
                         
                                        )
                    );


// taxonomy
//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires


if(
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'slides')
	|| 
	(isset($_GET['post_type']) && $_GET['post_type'] == 'slides')
	)
$slides = new DSF_POST_META('fresh-slides' , $slides_fields , false , $meta_styles , 'slides_post_nonce');



?>