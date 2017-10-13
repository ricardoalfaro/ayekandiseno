<?php 
/*
Theme Name: Mocha
Theme Author: SuitsTheme
Author URI: http://themeforest.net/user/suitstheme
*/


/* -------------------------------------------------------------- 
Theme Version
-------------------------------------------------------------- */
define('DSF_THEME_VERSION' , '1');
define('WP_VER_NUM' , str_replace('.' , '' , substr(get_bloginfo('version'), 0 , 3)));
define('DSF_PHP_VER' , str_replace('.' , '' , substr(phpversion(), 0 , 3)));

/* -------------------------------------------------------------- 
Options Framework
-------------------------------------------------------------- */
require_once(get_template_directory() . '/ds-framework/init.php');

/* -------------------------------------------------------------- 
Translation
-------------------------------------------------------------- */
function mocha_translation() 
{
load_theme_textdomain('dsf' , get_template_directory() . '/lang');

}
add_action('after_setup_theme' , 'mocha_translation');


/* -------------------------------------------------------------- 
  Theme Support
-------------------------------------------------------------- */
add_theme_support('automatic-feed-links');
add_theme_support( 'post-formats', array( 'video' , 'image'  , 'audio' , 'gallery'  ) );
add_theme_support( 'post-thumbnails' , array('post','portfolio') );
register_nav_menu( 'primary', __('Main Menu' , 'dsf') );
register_nav_menu( 'secondary', __('Footer Menu' , 'dsf') );


/* -------------------------------------------------------------- 
More Theme Addons
-------------------------------------------------------------- */
function loadMoreAddons() {

/**
* Google Fonts
*/
$protocol = is_ssl() ? 'https' : 'http';

// default font for body text
wp_register_style('mocha-default-font' , $protocol . '://fonts.googleapis.com/css?family=Lato:400,400italic,300,700,700italic,900,300italic|Voltaire');
wp_enqueue_style('mocha-default-font');


if(get_option('mocha_head_font_name') != '' && get_option('mocha_head_font_name') != 'Lato') :


$getfontname = str_replace(' ' , '+' , get_option('mocha_head_font_name'));
$getfontvariant = get_option('mocha_head_font_variant') ? ':'.get_option('mocha_head_font_variant') : '';

wp_register_style('mocha-googlefont-frontend' , $protocol . '://fonts.googleapis.com/css?family='.$getfontname . $getfontvariant . '|Voltaire');


endif;

wp_enqueue_style('mocha-googlefont-frontend');
}
if(get_option('mocha_enable_google_fonts') !== 'undefined')
{
add_action('wp_enqueue_scripts' , 'loadMoreAddons', 1);
}


/* -------------------------------------------------------------- 
Image Sized
-------------------------------------------------------------- */
if(function_exists('add_image_size'))
{
add_image_size('mocha-portfolio' , 840 , 600 , false);
add_image_size('mocha-portfolio-related-post' , 400 , 370 , true);
add_image_size('mocha-portfolio-widget' , 87 , 87 , true);
add_image_size('mocha-blog-post' , 840 , 450 , true);
add_image_size('mocha-blog-home' , 370 , 250 , true);
}


 /* -------------------------------------------------------------- 
   Limit Excerpt / Remove [...]
  -------------------------------------------------------------- */
function dsf_get_excerpt($content , $len )
{
      if($content != '' && $len != '')
      {
            $con = explode(' ' , $content);
            return implode(" ",array_splice($con,0,$len));
      }
}
function dsf_fix_excerpt(){
    return '';
}
add_filter('excerpt_more', 'dsf_fix_excerpt');



 /* -------------------------------------------------------------- 
   Adding subtitle field
  -------------------------------------------------------------- */
  add_action( 'edit_form_after_title', 'dsf_subtitle' );
  function dsf_subtitle() {

          $get_id = 'subtitle_' . get_post_type() . '_' . get_the_ID();
       ?>
          <h3 style="margin-bottom: 0px; margin-top: 0px; font-family: arial , sans-serif; font-weight: bold; margin-left: -10px;"><?php _e('Subtitle' , 'dsf'); ?></h3>
          <input value="<?php echo stripslashes(get_option($get_id)); ?>" style=" clear: both; width: 60%; padding: 10px 8px; margin-bottom:  30px;" type="text" name="<?php echo $get_id; ?>">

       <?php
  }
  add_action('save_post' , 'dsf_save_subtitle');
  function dsf_save_subtitle($post_id)
  {
          global $post_id;

          
          // check autosave
          if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
              return $post_id;
          }

          // check permissions
          if(isset($_POST['post_type'])) {
          if ('page' == $_POST['post_type']) {
              if (!current_user_can('edit_page', $post_id)) {
                  return $post_id;
              }
          } elseif (!current_user_can('edit_post', $post_id)) {
              return $post_id;
          }

        }
        if(isset($_POST['subtitle_' . get_post_type() . '_' . $post_id]))
        {
        update_option('subtitle_' . get_post_type() . '_' .$post_id , $_POST['subtitle_' . get_post_type() . '_' . $post_id]);
        }
  }




 /* -------------------------------------------------------------- 
   Theme Setup
  -------------------------------------------------------------- */
  function mocha_after_setup()
  {

    if(get_option('mocha_enable_related') == '')
    {
    update_option('mocha_enable_related' , 'checked');
    }



    if(get_option('mocha_enable_google_fonts') == '')
    {
    update_option('mocha_enable_google_fonts' , 'checked');
    }

    if(get_option('mocha_related_limit') == '')
    {
    update_option('mocha_related_limit' , '4');
    }

    // default options
    if(get_option('mocha_logo') == '') update_option('mocha_logo' , get_template_directory_uri() . '/img/logo.png');
    if(get_option('mocha_favicon') == '') update_option('mocha_favicon' , get_template_directory_uri() . '/img/logo.png');
    if(get_option('mocha_enable_related') == '') update_option('mocha_enable_related' , 'checked');
    if(get_option('mocha_enable_second_footer') == '') update_option('mocha_enable_second_footer' , 'checked');
    if(get_option('mocha_enable_home_portfolio') == '') update_option('mocha_enable_home_portfolio' , 'checked');
  }
  add_action('after_setup_theme' , 'mocha_after_setup');

// admin notice for google fonts
if(get_option('mocha_enable_google_fonts') == 'undefined')
{     
function fonts_admin_notice() {

if(in_array('dsf_options', $_GET)){
?>
<div style="margin-top: 10px; margin-bottom: 0px;" class="updated">
    <p><?php _e( 'Google Fonts Disabled , you browser is using default fonts .', 'dsf' ); ?></p>
</div>
<?php
}
}
add_action( 'admin_notices', 'fonts_admin_notice' );
}




/* -------------------------------------------------------------- 
Sidebars
-------------------------------------------------------------- */
function mocha_sidebars()
{
// blog sidebar
  register_sidebar(array(
                           'name' => 'Blog Sidebar',
                           'id' => 'blog-sidebar',
                           'description' => 'Blog Sidebar Widgets',
                           'before_widget' => '<!-- single widget  -->
                            <div class="widget">',
                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
                           'before_title' => '<h4>',
                           'after_title' => '</h4><div class="widget-content">'
                           ));

// footer sidebar
  register_sidebar(array(
                           'name' => 'Footer',
                           'id' => 'footer-sidebar',
                           'description' => 'Footer Sidebar Widgets',
                           'before_widget' => '<!-- single widget  -->
                            <div class="widget span4">',
                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
                           'before_title' => '<h3>',
                           'after_title' => '</h3><div class="widget-content">'
                           ));

}
add_action('widgets_init' , 'mocha_sidebars');


 /* -------------------------------------------------------------- 
  Load Scripts / CSS
  -------------------------------------------------------------- */
function mocha_load_scripts()
{
    $mocha_ease = get_option('mocha_ease_method') ? get_option('mocha_ease_method') : 'swing';
    $mocha_animation_speed = get_option('mocha_animation_speed') ? get_option('mocha_animation_speed') : 300;
    if(get_option('mocha_enable_footer_parallax') == 'checked') $footerPar = 'enable'; else $footerPar = 'disable';


         // load jquery
         wp_enqueue_script('jquery');
         // load comments reply
        if(is_singular()) wp_enqueue_script('comment-reply');

        // load media elements
        if(defined('WP_VER_NUM') && WP_VER_NUM >= '36')
        {
            wp_enqueue_script('wp-mediaelement');
        }
        else{
            wp_register_script('mediaelementjs' , get_template_directory_uri() . '/js/mediaelement.min.js' , '' , false , true);
            wp_enqueue_script('mediaelementjs');
        }


        // load scripts
        wp_register_script('flexslider' , get_template_directory_uri() . '/js/jquery.flexslider-min.js' , '' , false , true);
        wp_register_script('jquery-ui-custom' , get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js' , '' , false , true);
        wp_register_script('jflickrfeed' , get_template_directory_uri() . '/js/jflickrfeed.js' , '' , false , true);
        wp_register_script('jquery.isotope' , get_template_directory_uri() . '/js/isotope.js' , '' , false , true);
        wp_register_script('carouFredSel' , get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js' , '' , false , true);
        wp_register_script('custom-js' , get_template_directory_uri() . '/js/custom.js' , '' , false , true);
        wp_enqueue_script('flexslider');
        wp_enqueue_script('jquery-ui-custom');
        wp_enqueue_script('jflickrfeed');
        wp_enqueue_script('jquery.isotope');
        wp_enqueue_script('carouFredSel');
        wp_localize_script('custom-js' , 'mocha' , array(
            'speed' => $mocha_animation_speed ,
            'ease' => $mocha_ease,
            'template_url' => get_template_directory_uri(),
            'admin_ajax' => admin_url('admin-ajax.php'),
            'footerParallax' => $footerPar
        ));
        wp_enqueue_script('custom-js');



        // load styles
        wp_register_style('mocha-bootstrap' , get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_register_style('mocha-bootstrap-responsive' , get_template_directory_uri() . '/css/bootstrap-responsive.min.css');
        wp_register_style('mocha_footer_parallax' , get_template_directory_uri() . '/css/footerParallax.css');
        wp_register_style('mocha-css' , get_template_directory_uri() . '/css/main.css');
        wp_register_style('mocha_user_styles' , get_template_directory_uri() . '/theme-addons/user-settings/user_settings.php');
        wp_enqueue_style('mocha-bootstrap');
        wp_enqueue_style('mocha-bootstrap-responsive');
        if($footerPar == 'enable') wp_enqueue_style('mocha_footer_parallax');
        wp_enqueue_style('mocha-css');
        wp_enqueue_style('mocha_user_styles');




}
add_action('wp_enqueue_scripts' , 'mocha_load_scripts');



/* -------------------------------------------------------------- 
Post Formats Preparation
-------------------------------------------------------------- */
function post_formats_preparation($post_format = '')
{

      // Addons Path
      $path = get_template_directory() . '/theme-addons/post-formats/';

      
      if($post_format != '')
      {

          switch($post_format)
          {

                  case 'video' :
                    require($path . '/video.php');
                    break;

                  case 'audio' :
                    require($path . '/audio.php');
                    break;

                 
                  case 'image' :
                    require($path . '/image.php');
                    break;

                  case 'gallery' :
                    require($path . '/gallery.php');
                    break;

                  

                  
          }
        }// end if
}



 /* -------------------------------------------------------------- 
   Loops
  -------------------------------------------------------------- */
  function dsf_get_loop($loop){
        if($loop && file_exists(get_template_directory() . '/theme-addons/loops/' . $loop))
        {
            require_once(get_template_directory() . '/theme-addons/loops/' . $loop);
        }
  }


 /* -------------------------------------------------------------- 
   Comments
  -------------------------------------------------------------- */
function ds_list_comments($comment , $args , $depth) 
{

  $GLOBALS['comment'] = $comment;
  extract($args);



  ?>


      <!-- single comment --> 
      <div id="comment-<?php echo get_comment_ID(); ?>" class="<?php if($depth > 1) echo  ' comment '; ?><?php echo implode(' ' , get_comment_class('Depth')); ?>" id="comment-id-<?php comment_ID(); ?>">

      <!-- avatar -->
      <div class="avatar"><?php echo get_avatar( $comment->comment_author_email, 74 ); ?></div>

      <!-- content -->
      <div class="content">


           <div class="comment-meta">
                                                                                            
                  <a href="<?php 
                  if($comment->user_id > 0)
                  {
                      echo get_author_posts_url($comment->user_id); 
                      
                  }elseif(get_comment_author_url() != '')
                  {
                      echo get_comment_author_url();
                  }
                  else{
                      echo '#';
                  }
                  

                  ?>">
                  <?php echo $comment->comment_author; ?></a>
                  <span><?php echo get_comment_date('d M Y') ?></span>
                  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

          </div>
          <!-- end comment meta -->


          <!-- comment content -->
          <div class="comment-content">
                  
                  <?php if($comment->comment_approved == 0) : ?>
                  <p class="light-font"><?php echo __('Your comment is awaiting moderation' , 'dsf'); ?></p>
                  <?php else : ?>
                  <p class="light-font"><?php echo $comment->comment_content; ?></p>
                  <?php endif; ?>

          </div>
          <!-- end comment content -->


        </div><!-- end content -->
       
     

    <?php
}


 /* -------------------------------------------------------------- 
   Twitter OAuth
  -------------------------------------------------------------- */
function dsf_twitter($limit = 1  , $twitter_id = '')
          {     
                require_once(get_template_directory() . '/theme-addons/includes/twitter_oauth/twitteroauth/twitteroauth.php');
                $consumer_key = get_option('mocha_twitter_consumer_key');
                $consumer_secret = get_option('mocha_twitter_consumer_secret');
                $access_token = get_option('mocha_twitter_access_token');
                $access_token_secret = get_option('mocha_twitter_access_token_secret');
                $settings = array(
                    'oauth_access_token' => $access_token,
                    'oauth_access_token_secret' => $access_token_secret,
                    'consumer_key' => $consumer_key,
                    'consumer_secret' => $consumer_secret
                );
                $twitterconn = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
                $latesttweets = $twitterconn->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_id."&count=".$limit);
                if($consumer_key != '' && $consumer_secret != '' && $access_token != '' && $access_token_secret != '')
                {


                        foreach($latesttweets as $tweet ){
                              echo '<div class="tweet"><p>';
                              $output =  preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a class="custom" href="$1" target="_blank">$1</a>', $tweet->text);
                              echo preg_replace('/(^|\s)@([a-z0-9_]+)/i',
                                              '$1<a href="http://www.twitter.com/$2">@$2</a>',
                                               $output);
                              echo '</p></div>';
                        }
                      
                }
               
          }   

/* -------------------------------------------------------------- 
       Theme Shortcodes
-------------------------------------------------------------- */
require_once(get_template_directory() . '/theme-addons/shortcodes/theme-shortcodes.php');

/* Theme Widgets
  -------------------------------------------------------------- */
  require_once(get_template_directory() . '/theme-addons/widgets/widget-recent-posts.php');
  require_once(get_template_directory() . '/theme-addons/widgets/widget-latest-works.php');
  require_once(get_template_directory() . '/theme-addons/widgets/widget-flickr.php');
  require_once(get_template_directory() . '/theme-addons/widgets/widget-connect.php');
  require_once(get_template_directory() . '/theme-addons/widgets/widget-twitter.php');

/* -------------------------------------------------------------- 
  TinyMce Addons
-------------------------------------------------------------- */
require_once(get_template_directory() . '/theme-addons/tinymce-addons/shortcodes-button.php');


/* -------------------------------------------------------------- 
Theme Addons
-------------------------------------------------------------- */
require_once(get_template_directory() . '/theme-addons/post-meta/post-meta-fields.php');

update_option('posts_per_page' , 1);



/* -------------------------------------------------------------- 
 Theme Post Formats
-------------------------------------------------------------- */
require_once(get_template_directory() . '/theme-addons/post-type/slides/slides.php');
require_once(get_template_directory() . '/theme-addons/post-type/portfolio/portfolio.php');


/**
 * Fix Widget Empty Title , this will fix empty title for all widgets 
 * and will add cutom 'before_widget' parameter for search widget
 */

add_filter('widget_display_callback' , 'mocha_check_title' , 11 ,3);
add_filter('dynamic_sidebar_params' , 'mocha_fix_empty_title');
function mocha_check_title($instance, $widget, $args)
{
    if(!isset($instance['title'])) $instance['title'] = null;

    if($args['widget_name'] !=  'Search' && $instance['title'] == null) $title = '&nbsp;';
    return $instance;
}
function mocha_fix_empty_title($params)
{


    /**
     * Get all widgets ids
     */
    $ids = array();
    foreach (get_option('widget_search') as $id => $title) {
      if(isset($title['title']))
      {
          if($title['title'] == '' || $title['title'] == null) array_push($ids, $id);
      }
    }


    /**
     * add custom 'before_widget' 
     */
    if($params[0]['widget_name'] == 'Search' && in_array(str_replace('search-' , '' , $params[0]['widget_id']) , $ids))
    {
        $params[0]['before_widget'] = $params[0]['before_widget'] . '<!-- widget content --><div class="widget-content">';
    } 

    return $params;
}




/* -------------------------------------------------------------- 
     Check comments pagination
    -------------------------------------------------------------- */
    function dsf_check_comments($id)
    {

          $count = 0;
          $pagination = get_option('comments_per_page');
          if(is_numeric($id) && $pagination)
          {
                $get_comments = get_comments(array(
                        'post_id' => $id 
                        
                ));


                foreach ($get_comments as $comment) {
                        if($comment->comment_parent == 0) $count = $count + 1;
                }
          }
          if($count >= $pagination) return 'true';
    }

 /* -------------------------------------------------------------- 
   Fix Blog Pagination Links
  -------------------------------------------------------------- */
function dsf_posts_links_prev_class($format) {
     $format = str_replace('href=', 'class="next" href=', $format);
     return $format;
}
add_filter('next_posts_link', 'dsf_posts_links_prev_class');
    
if ( ! isset( $content_width ) ) $content_width = 940;

?>