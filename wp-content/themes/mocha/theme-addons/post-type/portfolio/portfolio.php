<?php

 /* -------------------------------------------------------------- 
 	Portfolio Post TYpe
  -------------------------------------------------------------- */


add_action('init', 'register_portfolio');

function register_portfolio(){
    $labels = array(
		'name' => __('Portfolio', 'new portfolio' , 'dsf'),
		'singular_name' => __('Portfolios', 'portfolio posts' , 'dsf'),
		'add_new' => __('Add New', 'portfolio post' , 'dsf'),
		'add_new_item' => __('Add New Portfolio Post' , 'dsf'),
		'edit_item' => __('Edit Portfolio Post' , 'dsf'),
		'new_item' => __('New Portfolio Post' , 'dsf'),
		'view_item' => __('View Portfolio Post' , 'dsf'),
		'search_items' => __('Search Portfolio Posts' , 'dsf'),
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
		'menu_icon' => get_stylesheet_directory_uri().'/img/portfolio-img.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor', 'thumbnail'),
		'taxonomies' => array('category' , 'post_tag')
	  ); 
 
	register_post_type( 'portfolio' , $args );

}



// adding meta fields
$portfolio_fields = array(
                    'id' => 'dsf_meta_items',
                    'title' => __('Portfolio Item Settings','dsf'),
                    'page' => array('portfolio'),
                    'context' => 'normal',
                    'priority' => 'high',
                    'fields' => array(

                                        
                                       
                                      

                                        array(

                                            'id' => 'clint', 
                                            'desc' => __('Add clint name' , 'dsf') ,
                                            'type' => 'text' ,
                                            'name' => __('Clint Name' , 'dsf')
                                        ),


                                         array(

                                            'id' => 'website', 
                                            'desc' => __('Add clint website' , 'dsf') ,
                                            'type' => 'text' ,
                                            'name' => __('Clint Website' , 'dsf')
                                        ),

                                          array(
                                          'id' => 'buzz_media_gallery' ,
                                          'desc' => __('Create gallery and upload images by clicking on upload button , For multiple images selection , hold "CTRL (windows) / Command (mac) " button on your keyboard when clicking .' , 'dsf'),
                                          'name' => __('Create Gallery' , 'dsf') ,
                                          'type' => 'media_gallery'
                                        ) 

                         
                                        )
                    );


// skills taxonomy
//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires

add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );

function create_topics_nonhierarchical_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => __( 'Skills Used', 'dsf' ),
    'singular_name' => __( 'Skills Used', 'dsf' ),
    'search_items' =>  __( 'Search Skills'  , 'dsf'),
    'all_items' => __( 'All Skills'  , 'dsf'),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Skills' , 'dsf' ), 
    'update_item' => __( 'Update Skill' , 'dsf' ),
    'add_new_item' => __( 'Add New Skill' , 'dsf' ),
    'new_item_name' => __( 'New Skill Name' , 'dsf' ),
    'separate_items_with_commas' => __( 'Separate skills with commas'  , 'dsf'),
    'add_or_remove_items' => __( 'Add or remove skills'  , 'dsf'),
    'choose_from_most_used' => __( 'Choose from the most used skills' , 'dsf' ),
    'menu_name' => __( 'Skills Used' , 'dsf' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('skills','portfolio',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'skills' ),
  ));


}



$portfolio = new DSF_POST_META('mocha_portfolio' , $portfolio_fields , false , false , 'portfolio_main_nonce');



?>