<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); 
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description"; ?>
    </title>
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width"> 
    <meta name="description" content="<?php 
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo $site_description; ?>">


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <!-- Favicons -->
    <?php if(get_option('mocha_favicon') != '' ) : ?>
    <link rel="shortcut icon" href="<?php echo get_option('mocha_favicon'); ?>">
    <?php endif; ?>
    
    <?php wp_head(); ?>
    <link rel='stylesheet' href='http://localhost:8888/wp-content/themes/mocha/custom-ayekan.css' type='text/css' media='all' />
</head>
<body <?php body_class('body-container'); ?>>
<!-- header -->
<header id="mocha-head" class="header">



            <!-- Background -->
            <div class="background-image" <?php if(get_option('mocha_header_bg') != '') echo 'style="background-image:url('.get_option('mocha_header_bg').');"'; ?>></div>


            <!-- container -->
            <div class="container">
                
                    

                    <!-- row1  -->
                    <div class="row">
                        
                            <div class="span12">
                                    
                                   
                                    <div class="logo">
                                            <a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_option('mocha_logo' , get_template_directory_uri() . '/img/logo.png'); ?>" alt="<?php echo get_bloginfo('description', 'display'); ?>"></a>
                                    </div>
                                    <!-- end logo -->
                                    

                                    <!-- nav -->
                                    <nav class="menu">
                                     <?php wp_nav_menu(array(
                                                      'theme_location' => 'primary',
                                                      'items_wrap' => '<ul><li class="toggle"><a href="#">'.__('Menu' , 'dsf').'</a></li>%3$s</ul>',
                                                      'container' => false
                                        )); ?>
                                          
                                    </nav>
                                    <!-- end nav -->

                            </div>
                            <!-- end span12 -->
                                    

                    </div>
                    <!-- end row 1-->





                    <?php 

                    /**
                     * Check if home page template is used
                     */
                    if(is_page_template('page-home.php') || is_page_template('page-home-with-content.php')){ 

                        dsf_get_loop('slides.php');

                    }else{

                      $this_page_id     = get_queried_object_id();
                        ?>
                                <!-- row2 -->
                                <div class="row">
                                    
                                                    
                                            <div class="span12 teaser">
                                                        
                                                      
                                                        <?php if(is_search()) : ?>
                                                        <h2><?php echo get_search_query(); ?></h2>
                                                        <p><?php echo  __('Search results for ' , 'dsf') . get_search_query(); ?></p>
                                                        <?php elseif(is_archive()) : ?>

                                                              <?php if(is_day()) : ?>
                                                              <h2><?php printf( __( 'Daily Archives: %s', 'dsf' ), '<span>' . get_the_date() . '' ); ?></h2>
                                                              <?php elseif(is_month()) : ?>
                                                              <h2><?php printf( __( '', 'dsf' ), '' . get_the_date( _x( 'F Y', 'monthly archives date format', 'dsf' ) ) . '' ); ?></h2>
                                                              <?php elseif(is_year()) : ?>
                                                              <h2><?php printf( __( '', 'dsf' ), '' . get_the_date( _x( 'Y', 'yearly archives date format', 'dsf' ) ) . '' ); ?></h2>
                                                              <?php elseif(is_category()) : ?>
                                                              <h2><?php echo single_cat_title();  ?></h2>
                                                              <?php elseif(is_tag()) : ?>
                                                              <h2><?php echo single_tag_title();  ?></h2>
                                                              <?php endif; ?>
  
                                                        <?php elseif(is_404()) : ?>
                                                        <h2><?php _e('Error 404' , 'dsf'); ?></h2>
                                                        <p><?php _e('No Search Results Found , Please Try Again' , 'dsf'); ?></p>
                                                        <?php elseif(get_post_type($this_page_id) == 'portfolio' && get_option('mocha_portfolio_page_link') != '') : 
                                                          // get page
                                                          $page_info = get_page_by_title(get_option('mocha_portfolio_page_link'));
                                                          echo '<h2>'.get_option('mocha_portfolio_page_link').'</h2>';
                                                          echo '<p>' . get_option('subtitle_page_' . $page_info->ID) . '</p>';
                                                        ?>
                                                      <?php elseif(is_single()) :
                                                      $page_info = get_page_by_title(get_option('mocha_blog_home_link'));
                                                          echo '<h1>'.get_option('mocha_blog_home_link').'</h1>';
                                                          echo '<p>' . get_option('subtitle_page_' . $page_info->ID) . '</p>';  
                                                      else : 
                                                        ?>
                                                        <h2><?php echo wp_title(''); ?></h2>
                                                        <?php $subtitle = get_option('subtitle_' . get_post_type($this_page_id) . '_' . $this_page_id);
                                                            if($subtitle != '') echo '<p>'.stripslashes($subtitle).'</p>'; ?>
                                                        <?php endif; ?>


                                            </div>
                                            <!-- end span12 -->

                                </div>
                                <!-- end row 2-->
                                
                        <?php
                    }// end else 
                    
                    ?>
            </div>
            <!-- end container -->

</header>   
<!-- end header -->