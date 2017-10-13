<?php 

/**
 * Twitter
 * Mocha Theme
 */
class Mocha_Twitter extends WP_Widget
{
	 function Mocha_Twitter(){

        $widget_ops = array('classname' => 'Mocha-twitter','description' => __( "Mocha Twitter Widget" ,'dsf') );
		    $this->WP_Widget('Mocha-twitter', __('Mocha Twitter Widget','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Twitter' , 'dsf');
        $limit = ($instance['limit']) ? $instance['limit'] : 3;
        $twitter_id = ($instance['twitter_id']) ? $instance['twitter_id'] : '';
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		
		?>


      
      <div class="twitter-wrapper">
                                                    


            <?php dsf_twitter($limit , $twitter_id); ?>



    </div>
    <!-- end twitter container -->
      
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Twitter' , 'dsf');
      if(!isset($instance['limit'])) $instance['limit'] = 3;
      if(!isset($instance['twitter_id'])) $instance['twitter_id'] = '';


    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />

    <b><label style="width:100px;" for="<?php echo $this->get_field_id('twitter_id'); ?>">
      <?php _e('Twitter ID','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['twitter_id']); ?>"
                                   name="<?php echo $this->get_field_name('twitter_id'); ?>"
                 id="<?php $this->get_field_id('twitter_id'); ?>" />


                 <br />

      <b><label style="width:100px;" for="<?php echo $this->get_field_id('limit'); ?>">
      <?php _e('Limit Tweets','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['limit']); ?>"
                                   name="<?php echo $this->get_field_name('limit'); ?>"
                 id="<?php $this->get_field_id('limit'); ?>" />


                 <br />



        

    

     


    	<?php
    }
}


function reg_twitter_widget()
{
	register_widget('Mocha_Twitter');
}
add_action('widgets_init' , 'reg_twitter_widget');

?>