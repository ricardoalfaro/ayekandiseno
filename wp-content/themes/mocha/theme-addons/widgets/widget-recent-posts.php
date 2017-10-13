<?php 

/**
 * Tabs Posts Widget
 * [this widget will grab recent posts / top posts by comments / and featured posts ]
 * Author Url : http://themeforest.com/user/suitstheme
 * @package suitstheme
 */

class BP_RECENT_POSTS extends WP_Widget
{
	 function BP_RECENT_POSTS(){
        $widget_ops = array('classname' => 'buzz-recent-post-widget','description' => __( "Mocha Recent Posts" ,'dsf') );
		$this->WP_Widget('buzz_recent_posts', __('Mocha Recent Posts','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $posts_limit = ( $instance['posts_limit'] ) ? $instance['posts_limit'] : 4 ;
        $title = ($instance['title']) ? $instance['title'] : __('Recent Posts' , 'dsf');
        $rand = rand(1 , 9999);

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		
		?>

		      <!-- recent posts -->
          <div class="recent-posts-wrapper">
              


              	<?php 

              		$featured_args = array(
              				'posts_per_page' => $posts_limit ,
              				'orderby' => 'date',
                      'ignore_sticky_posts' => true
              			);

              		$featured_query = new WP_Query($featured_args);

              		/**
              		 * Check if zilla likes plugin exists
              		 */
              		if($featured_query->have_posts()) : while($featured_query->have_posts()) : $featured_query->the_post();

              			?>


                        <?php if(get_the_content() != '') : ?>


                         <div class="recent-post-tab">
                                                                    
                                                <span><?php echo get_the_date('d M Y'); ?></span>
                                                <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>


                                        </div>

                        <?php endif; ?>


              			<?php

              		endwhile; endif; wp_reset_query();

              	 ?>



          </div>
          <!-- end posts wrapper -->

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
    	if(!isset($instance['posts_limit'])) $instance['posts_limit'] = 3;
      if(!isset($instance['title'])) $instance['title'] = __('Recent Posts' , 'dsf');



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


function regrecentposts()
{
	register_widget('BP_RECENT_POSTS');
}
add_action('widgets_init' , 'regrecentposts');

?>