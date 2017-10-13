<?php 
/**
 * @var $dsf_pages , array of pages and fields to print
 * @var $dsf_options_prefix options prefix
 */


/**
 * Require Google Fonts Class
 */
require_once(TEMPLATEPATH . '/ds-framework/include/class/class-googlefonts.php');


/**
 * Google fonts array
 */ 
$fontsArray = '';
if(class_exists('Dsfgooglefonts')) 
{
	$new = new Dsfgooglefonts;
	$fontsArray = $new->return_fonts();
}
else
{
	$fontsArray = 'Error';
}
/**
 * setup categories array
 */
$cats_array = array();
foreach(get_categories() as $single_cat){
	array_push($cats_array , $single_cat->name );
}
array_unshift($cats_array , '');


/*
	Portfolio Pages Array
*/
$portfolio_pages_list = array();
$portfolio_pages = get_pages(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-portfolio.php'
	));
foreach ($portfolio_pages as $single_page) {
		$portfolio_pages_list[$single_page->post_title] = $single_page->post_title;
}

wp_reset_query();

/*
Normal Pages
*/
$normal_pages_list = array();
$normal_blog_pages = get_pages(array(
		'post_type' => 'page' ,
		'meta_key' => '_wp_page_template' ,
		'meta_value' => 'page-blog.php'
	));
foreach ($normal_blog_pages as $single_normal_page) {
		$normal_pages_list[$single_normal_page->post_title] = $single_normal_page->post_title;
}

/**
 * Ease Methods Array
 */
$ease_methods = array();
$ease_methods = array( 'easeInQuad'
			,'easeOutQuad',
			'easeInOutQuad',
			'easeInCubic',
			'easeOutCubic',
			'easeInOutCubic',
			'easeInQuart'
			,'easeOutQuart'
			,'easeInOutQuart'
			,'easeInSine'
			,'easeOutSine'
			,'easeInOutSine'
			,'easeInExpo'
			,'easeOutExpo'
			,'easeInOutExpo'
			,'easeInQuint'
			,'easeOutQuint'
			,'easeInOutQuint'
			,'easeInCirc'
			,'easeOutCirc'
			,'easeInOutCirc'
			,'easeInElastic'
			,'easeOutElastic'
			,'easeInOutElastic'
			,'easeInBack'
			,'easeOutBack'
			,'easeInOutBack'
			,'easeInBounce'
			,'easeOutBounce','easeInOutBounce');


/**
 * Options Array
 */
global $dsf_pages;
$dprefix = 'mocha_';
$dsf_pages = array(

				'pages' => 	array( 
							'id' => 'main',
							'title' => __('Main' , 'dsf'),
							'desc' => __('Main theme options .. ' , 'dsf'),
							'fields' => 	
										array(

											// single field
											array(
											'id' => $dprefix .  'logo',
											'type' => 'upload',
											'title' => __('Upload Custom Logo' , 'dsf'),
											'desc' => __('upload custom logo image' , 'dsf')
										  	) ,
										  	// single field
											array(
											'id' => $dprefix .  'favicon',
											'type' => 'upload',
											'title' => __('Upload Fav Icon' , 'dsf'),
											'desc' => __('upload custom fav icon image' , 'dsf')
										  	),
										  	array(
											'id' => $dprefix .  'header_bg',
											'type' => 'upload',
											'title' => __('Upload Header Background Image' , 'dsf'),
											'desc' => __('upload header background image' , 'dsf')
										  	) ,
										  	array(
							 					'id' => $dprefix . 'enable_footer_parallax' , 
							 					'type' => 'checkbox' ,
							 					'title' => __('Enable Footer Parallax Effect' , 'dsf'),
							 					'desc' => __('enable or disable footer parallax effect , if you have more than 3 widgets in footer you better disable this feature' , 'dsf')
							 				)  ,
										  		// single field
											array(
											'id' => $dprefix .  'tracking_code',
											'type' => 'textarea',
											'title' => __('Tracking Code' , 'dsf'),
											'desc' => __('add your google / tracking code here' , 'dsf')
										  	)
										  	


										 

											
										)// end fields array

						    )// end single page 

				,


				array( 
							'id' => 'social',
							'title' => __('Social' , 'dsf'),
							'desc' => __('Social Links , Twitter API Key ' , 'dsf'),
							'fields' => 	
										array(

											

											array(
							 					'id' => $dprefix . 'facebook' ,
							 					'type' => 'text',
							 					'title' => __('Facebook Page Name (Lowercase)' , 'dsf'),
							 					'desc' => __('Add your facebook page name , this will be used for social icon link and social badge (followers number)', 'dsf')
							 				) ,
							 				array(
							 					'id' => $dprefix . 'twitter' ,
							 					'type' => 'text',
							 					'title' => __('Twitter ID' , 'dsf'),
							 					'desc' => __('Add your twitter ID ', 'dsf')
							 				),
							 				array(
							 					'id' => $dprefix . 'twitter_consumer_key' ,
							 					'type' => 'text',
							 					'title' => __('Twitter CONSUMER KEY' , 'dsf'),
							 					'desc' => __('Add your twitter consumer key ', 'dsf')
							 				),
							 				array(
							 					'id' => $dprefix . 'twitter_consumer_secret' ,
							 					'type' => 'text',
							 					'title' => __('Twitter CONSUMER Secret' , 'dsf'),
							 					'desc' => __('Add your twitter consumer secret ', 'dsf')
							 				),
							 				array(
							 					'id' => $dprefix . 'twitter_access_token' ,
							 					'type' => 'text',
							 					'title' => __('Twitter Access Token' , 'dsf'),
							 					'desc' => __('Add your twitter access token ', 'dsf')
							 				),
							 				array(
							 					'id' => $dprefix . 'twitter_access_token_secret' ,
							 					'type' => 'text',
							 					'title' => __('Twitter Access Token Secret' , 'dsf'),
							 					'desc' => __('Add your twitter access token secret ', 'dsf')
							 				),
							 				array(
							 					'id' => $dprefix . 'linkedin' ,
							 					'type' => 'text',
							 					'title' => __('Linkedin Link' , 'dsf'),
							 					'desc' => __('Add your linkedin account', 'dsf')
							 				)
							 				,
							 				
							 			
							 				array(
							 					'id' => $dprefix . 'dribbble' ,
							 					'type' => 'text',
							 					'title' => __('Dribbble Feed Link' , 'dsf'),
							 					'desc' => __('Add your dribbble name', 'dsf')
							 				),
							 			
							 				array(
							 					'id' => $dprefix . 'rss' ,
							 					'type' => 'text',
							 					'title' => __('RSS Link' , 'dsf'),
							 					'desc' => __('Add your rss link', 'dsf')
							 				),
							 				array(
							 					'id' => $dprefix . 'vimeo' ,
							 					'type' => 'text',
							 					'title' => __('Vimeo Account Link' , 'dsf'),
							 					'desc' => __('Add your Vimeo link', 'dsf')
							 				)
										 

											
										)// end fields array

						    )// end single page ,

							,

							
						    array( 
							'id' => 'blog',
							'title' => __('Blog Settings' , 'dsf'),
							'desc' => __('blog settings ' , 'dsf'),
							'fields' => 	
										array(

											
							 				
							 				array(
							 					'id' => $dprefix . 'sidebar_pos',
							 					'type' => 'select',
							 					'title' => __('Sidebar Position' , 'dsf'),
							 					'desc' => __('Select sidebar position  , left or right' , 'dsf'),
							 					'field_array' => array(
							 							'right' => 'right',
							 							'left' => 'left'  

							 						)
							 				) ,

							 			

							 				
							 				array(
							 					'id' => $dprefix . 'blog_limit_posts',
							 					'type' => 'slider',
							 					'title' => __('Limit Posts Number' , 'dsf'),
							 					'desc' => __('limit the number of posts per page , default is 4' , 'dsf')
							 				) ,

							 				
							 			
							 				array(
							 					'id' => $dprefix . 'blog_order',
							 					'type' => 'select',
							 					'title' => __('Blog Posts Order' , 'dsf'),
							 					'desc' => __('Select blog posts order' , 'dsf'),
							 					'field_array' => array(
							 							'date' => 'date' ,
							 							'comment_count' => 'comment_count'
							 						)
							 				),

							 				array(
							 					'id' => $dprefix . 'enable_readmore' , 
							 					'type' => 'checkbox' ,
							 					'title' => __('Enable Read More Button' , 'dsf'),
							 					'desc' => __('enable or disable read more button in blog page ' , 'dsf')
							 				)  

											
										)// end fields array

						    )// end single page 

							,

							array( 
							'id' => 'home',
							'title' => __('Home Template Settings' , 'dsf'),
							'desc' => __('Home Template settings ' , 'dsf'),
							'fields' => 	
										array(

											
							 				
							 				array(
							 					'id' => $dprefix . 'enable_home_portfolio' , 
							 					'type' => 'checkbox' ,
							 					'title' => __('Enable Portfolio Posts' , 'dsf'),
							 					'desc' => __('enable or disable portfolio posts ' , 'dsf')
							 				) ,
							 				
							 				array(
							 					'id' => $dprefix . 'portfolio_title' , 
							 					'type' => 'text' ,
							 					'title' => __('Portfolio Title' , 'dsf'),
							 					'desc' => __('home portfolio title ' , 'dsf')
							 				) ,
							 				array(
							 					'id' => $dprefix . 'portfolio_home_limit',
							 					'type' => 'slider',
							 					'title' => __('Limit Home Portfolio Posts Number' , 'dsf'),
							 					'desc' => __('limit the number of portfolio posts  , default is 4' , 'dsf')
							 				) ,
							 				array(
							 					'id' => $dprefix . 'portfolio_page_link' , 
							 					'type' => 'select' ,
							 					'title' => __('Portfolio Page Link' , 'dsf'),
							 					'desc' => __('add portfolio link , this will be used in home page template portfolio section and  portfolio single post' , 'dsf'),
							 					'field_array' => $portfolio_pages_list
							 				) ,
							 				array(
							 					'id' => $dprefix . 'blog_home_title' , 
							 					'type' => 'text' ,
							 					'title' => __('Blog Title' , 'dsf'),
							 					'desc' => __('home blog title ' , 'dsf')
							 				) ,
							 				array(
							 					'id' => $dprefix . 'blog_home_limit' , 
							 					'type' => 'slider' ,
							 					'title' => __('Blog Posts Limit' , 'dsf'),
							 					'desc' => __('blog posts limit , default is 3 ' , 'dsf')
							 				) ,
							 				array(
							 					'id' => $dprefix . 'blog_home_link' , 
							 					'type' => 'select' ,
							 					'title' => __('Blog Page Link' , 'dsf'),
							 					'desc' => __('add blog link , this will be used in home page template blog section and  blog single post' , 'dsf'),
							 					'field_array' => $normal_pages_list
							 				) ,
							 				


											
										)// end fields array

						    )// end single page 
							,
							array( 
							'id' => 'portfolio',
							'title' => __('Portfolio Settings' , 'dsf'),
							'desc' => __('Portfolio settings ' , 'dsf'),
							'fields' => 	
										array(

											
							 				array(
							 					'id' => $dprefix . 'portfolio_limit',
							 					'type' => 'slider',
							 					'title' => __('Limit Portfolio Posts Number' , 'dsf'),
							 					'desc' => __('limit the number of portfolio posts  , default is 12' , 'dsf')
							 				) ,
							 				array(
							 					'id' => $dprefix . 'enable_related' , 
							 					'type' => 'checkbox' ,
							 					'title' => __('Enable Related Posts' , 'dsf'),
							 					'desc' => __('enable or disable related posts ' , 'dsf')
							 				) ,

							 				array(
							 					'id' => $dprefix . 'related_title',
							 					'type' => 'text',
							 					'title' => __('Related Posts Section Title' , 'dsf'),
							 					'desc' => __('related posts section title' , 'dsf')
							 				) ,
							 				
							 				array(
							 					'id' => $dprefix . 'related_limit',
							 					'type' => 'slider',
							 					'title' => __('Limit Related Posts Number' , 'dsf'),
							 					'desc' => __('limit the number of related posts  , default is 4' , 'dsf')
							 				) 


											
										)// end fields array

						    )// end single page 
							

						    ,

						    // Style
							array(
							
							 'id' => 'style' ,
							 'title' => __('Theme Style' , 'dsf'),
							 'desc' => __('Change theme styles , or add your custom css' , 'dsf') ,
							 'fields' => array(

							 				array(
							 					'id' => $dprefix . 'enable_google_fonts' , 
							 					'type' => 'checkbox' ,
							 					'title' => __('Enable Google Fonts' , 'dsf'),
							 					'desc' => __('enable or disable google fonts let the theme use browser default fonts . ' , 'dsf')
							 				) ,

							 				array(
							 					'id' => $dprefix . 'fonts' ,
							 					'class' => 'fonts', /* Special Class For jQuery */
							 					'type' => 'multi_select',
							 					'title' => __('Header Font' , 'dsf'),
							 					'desc' => __('Select header font , default header font is Lato 700', 'dsf'),
							 					'menus' => array(

								 								array(
								 									'id' => $dprefix . 'head_font_name' ,
								 									'fields' => $fontsArray
								 									),
								 								array(
								 									 'id' => $dprefix . 'head_font_variant',
								 									 'fields' => ''
								 									 )

							 						)
							 				) ,
							 				
							 				array(

							 					'id' => $dprefix . 'main_color' ,
							 					'type' => 'color',
							 					'title' => __('Theme Main Color ' , 'dsf'),
							 					'desc' => __('Select theme main color  , this will apply for hover color , buttons hover ', 'dsf'),
							 					'default' => '#0078a4'

							 				) ,

							 				

							 				array(

							 					'id' => $dprefix . 'hover_color' ,
							 					'type' => 'color',
							 					'title' => __('Hover Background Color ' , 'dsf'),
							 					'desc' => __('Select hover background color , this will apply for hover color , buttons hover ', 'dsf'),
							 					'default' => '#2d2d2d'

							 				) ,

							 				

							 				array(

							 					'id' => $dprefix . 'heading_color' ,
							 					'type' => 'color',
							 					'title' => __('Headers Color' , 'dsf'),
							 					'desc' => __('Select headers color', 'dsf'),
							 					'default' => '#515151'

							 				) ,

							 				
							 				array(

							 					'id' => $dprefix . 'font_color' ,
							 					'type' => 'color',
							 					'title' => __('Font Color' , 'dsf'),
							 					'desc' => __('Select post font color', 'dsf'),
							 					'default' => '#515151'

							 				),
							 				array(

							 					'id' => $dprefix . 'header_footer_font_color' ,
							 					'type' => 'color',
							 					'title' => __('Header And Footer Font Color' , 'dsf'),
							 					'desc' => __('Select header and footer font color', 'dsf'),
							 					'default' => '#fff'

							 				),
							 				array(

							 					'id' => $dprefix . 'link_color' ,
							 					'type' => 'color',
							 					'title' => __('Link Color ' , 'dsf'),
							 					'desc' => __('Select article links color', 'dsf'),
							 					'default' => '#0078a4'

							 				) ,
							 				array(

							 					'id' => $dprefix . 'footer_bg_color' ,
							 					'type' => 'color',
							 					'title' => __('Footer Background Color ' , 'dsf'),
							 					'desc' => __('Select footer background color', 'dsf'),
							 					'default' => '#2d2d2d'

							 				) ,
							 				array(

							 					'id' => $dprefix . 'copyrights_bg_color' ,
							 					'type' => 'color',
							 					'title' => __('Copyrights Section Background Color ' , 'dsf'),
							 					'desc' => __('Select copyrights section background color', 'dsf'),
							 					'default' => '#353535'

							 				) ,
							 				array(

							 					'id' => $dprefix . 'custom_css' ,
							 					'type' => 'textarea',
							 					'title' => __('Custom CSS' , 'dsf'),
							 					'desc' => __('add your own custom css ', 'dsf')


							 				)


							 		)// end fields
							 ),

// styles
							array(
							
							 'id' => 'js' ,
							 'title' => __('Javascript Settings' , 'dsf'),
							 'desc' => __('Change animation speed , ease method .. etc' , 'dsf') ,
							 'fields' => array(


							 				array(
							 					'id' => $dprefix . 'animation_speed',
							 					'type' => 'slider',
							 					'title' => __('Animation Speed' , 'dsf'),
							 					'desc' => __('select animation speed' , 'dsf')
							 				) , 

							 				array(

							 					'id' => $dprefix . 'ease_method' ,
							 					'type' => 'select' ,
							 					'title' => __('Ease Method' , 'dsf') ,
							 					'desc' => __('select ease method for jquery easing plugin' , 'dsf'),
							 					'field_array' => $ease_methods
							 				) 




							 		)// end fields
							 ),

						    

							array( 
							'id' => 'footer_page',
							'title' => __('Footer Settings' , 'dsf'),
							'desc' => __('footer settings ' , 'dsf'),
							'fields' => 	
										array(

											array(

							 					'id' => $dprefix . 'enable_second_footer' ,
							 					'type' => 'checkbox' ,
							 					'title' => __('Enable Second Footer' , 'dsf') ,
							 					'desc' => __('enable second footer section / copyrights and footer menu' , 'dsf')
							 				) ,
							 			
							 				array(

							 					'id' => $dprefix . 'copyrights' ,
							 					'type' => 'textarea' ,
							 					'title' => __('Copyrights' , 'dsf') ,
							 					'desc' => __('enter copyrights for footer section' , 'dsf')
							 				) ,

							 				array(
											'id' => $dprefix .  'footer_bg',
											'type' => 'upload',
											'title' => __('Upload Footer Background' , 'dsf'),
											'desc' => __('you can leave it empty to disable footer background' , 'dsf')
										  	)

											
										)// end fields array

						    )// end single page 
						    


			);

?>