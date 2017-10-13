<?php 

/**
 * Tabs Posts Widget
 * [this widget will grab recent posts / top posts by comments / and featured posts ]
 * Author Url : http://themeforest.com/user/suitstheme
 * @package suitstheme
 */

class LatestWorksWidget extends WP_Widget
{
	 function LatestWorksWidget(){
        $widget_ops = array('classname' => 'latest-works-widget','description' => __( "Mocha Latest Works" ,'dsf') );
		$this->WP_Widget('latest_works_widget', __('Mocha Latest Works','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        if(!isset($instance['works_limit'])) $instance['works_limit'] = 8;
        $works_limit = ( $instance['works_limit'] ) ? $instance['works_limit'] : 8 ;
        $title = ($instance['title']) ? $instance['title'] : __('Latest Works' , 'dsf');

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		$works = new WP_Query(array(
        'posts_per_page' => $works_limit ,
        'post_type' => 'portfolio' ,
        'orderby' => 'date'
      ));
    echo '<div class="works-wrapper">';
    if($works->have_posts()) : while($works->have_posts()) : $works->the_post();
    // check if url exists
    $image = get_headers(wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())) );
		if(has_post_thumbnail() && $image[0] != 'HTTP/1.1 404 Not Found'){

                echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID() , 'mocha-portfolio-widget').'</a>';

          }
    endwhile; endif; wp_reset_query();
    echo '</div><!-- end works wrapper -->';

		echo $after_widget;

    }


    function form($instance)
    {
    	if(!isset($instance['works_limit'])) $instance['works_limit'] = 8;
      if(!isset($instance['title'])) $instance['title'] = __('Latest Works' , 'dsf');
      if(!isset($instance['posts_limit'])) $instance['posts_limit'] = 8;



    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />



    <label style="width:100px;" for="<?php echo $this->get_field_id('posts_limit'); ?>">
	
		<b><label style="width:100px;" for="<?php echo $this->get_field_id('posts_limit'); ?>">
			<?php _e('Limit Posts ','dsf') ?></label></b>
			<br />

			<input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['posts_limit']); ?>"
				                           name="<?php echo $this->get_field_name('posts_limit'); ?>"
							   id="<?php $this->get_field_id('posts_limit'); ?>" />

                 <br />

     


    	<?php
    }
}


function regLatestWorks()
{
	register_widget('LatestWorksWidget');
}
add_action('widgets_init' , 'regLatestWorks');

?>