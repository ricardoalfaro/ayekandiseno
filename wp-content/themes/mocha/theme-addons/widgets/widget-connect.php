<?php 

/**
 * Flickr Photos Feed Widget
 * Author Url : http://themeforest.com/user/waleed_ds
 * @package business theme
 */

class BF_ContactInfo extends WP_Widget
{

	


	function BF_ContactInfo(){
        $widget_ops = array('classname' => 'contactinfo-widget','description' => __( "Get In Touch" ,'dsf') );
		$this->WP_Widget('contact_info', __('Get In Touch Widget','dsf'), $widget_ops);
		
    }



    function widget($args , $instance)
    {
    	extract($args);
    	$title = apply_filters('widget_title', empty($instance['title']) ? __('Get In Touch','dsf') : $instance['title'], $instance, $this->id_base);
    	
    	$content = $instance['content'] ? $instance['content'] : __('Add your Content' , 'dsf');
    	$social = '';
    	if(isset($instance['social']))
    	$social = $instance['social'] ? $instance['social'] : 'checked';

    	if(isset($instance['newsletter']))
    	$newsletter = $instance['newsletter'] ? $instance['newsletter'] : 'checked';

    	echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		

		?>

						<?php if($content != '') : ?>
						<p><?php echo $content; ?></p>
                                                    

                        <div class="clearfix"></div>
						<?php endif; ?>

						<?php if($social != '') : ?>

						<!-- social icons -->
                        <div class="social-icons">
								<?php if(get_option('mocha_facebook') != '') : ?>
									<a href="<?php echo 'http://facebook.com/' . get_option('mocha_facebook'); ?>" class="facebook"></a>
								<?php endif; ?>

								<?php if(get_option('mocha_twitter') != '') : ?>
									<a href="<?php echo 'http://twitter.com/' . get_option('mocha_twitter'); ?>" class="twitter"></a>
								<?php endif; ?>

								<?php if(get_option('mocha_dribbble') != '') : ?>
									<a href="<?php echo get_option('mocha_dribbble'); ?>" class="dribbble"></a>
								<?php endif; ?>

								<?php if(get_option('mocha_vimeo') != '') : ?>
									<a href="<?php echo get_option('mocha_vimeo'); ?>" class="vimeo"></a>
								<?php endif; ?>

								<?php if(get_option('mocha_linkedin') != '') : ?>
									<a href="<?php echo get_option('mocha_linkedin'); ?>" class="linkedin"></a>
								<?php endif; ?>

								<?php if(get_option('mocha_rss') != '') : ?>
									<a href="<?php echo get_option('mocha_rss'); ?>" class="rss"></a>
								<?php endif; ?>
							</div><!-- end social icons -->
						<?php endif; ?>





						<?php if(isset($newsletter) && defined('NEWSLETTER_SUBSCRIBE_URL')) : ?>
								
							<!-- newsletter -->
                            <div class="newsletter">
                                
                                        
                                        <h4>Sign up for our newsletter</h4>

                                        <form method="post" action="<?php echo NEWSLETTER_SUBSCRIBE_URL; ?>" class="newsletter-form">
                                                    
                                                    <input type="text" name="ne" class="email" placeholder="<?php _e('enter your email address' , 'dsf'); ?>" />
                                                    <input type="submit" class="submit" value="" >

                                        </form>
                                        <!-- end form -->

                            </div>
                            <!-- end newsletter -->     
							
						<?php endif; ?>
	
		<?php
		echo $after_widget;

    }


    function form($instance)
    {


    	if(!isset($instance['title'])) $instance['title'] = __('Get In Touch' , 'dsf');
    	if(!isset($instance['content'])) $instance['content'] = '';
    	if(!isset($instance['newsletter'])) $instance['newsletter'] = '';
    	if(!isset($instance['social'])) $instance['social'] = '';



    	?>

	
		<b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
			<?php _e('Widget Title ','dsf') ?></label></b>
			<br />

			<input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
				                           name="<?php echo $this->get_field_name('title'); ?>"
							   id="<?php $this->get_field_id('title'); ?>" />

		<br /><br />


		



		

	
		<b><label style="width:100px;" for="<?php echo $this->get_field_id('content'); ?>">
			<?php _e('Description ','dsf') ?></label></b>
			<br />

			<textarea   style="float:left; clear: both; margin-bottom: 10px; width: 100%; padding: 3px;"
				                           name="<?php echo $this->get_field_name('content'); ?>"
							   id="<?php $this->get_field_id('content'); ?>"><?php echo esc_attr($instance['content']); ?></textarea>


		<br /><br />



		<b><label style="width:100px;">
			
			<input type="checkbox"  style="float: left; margin-right: 4px; margin-top: 4px; padding: 3px;"
               name="<?php echo $this->get_field_name('social'); ?>"
			   id="<?php $this->get_field_id('social'); ?>" <?php if($instance['social'] != '') echo 'checked=checked '; ?>
			   />
			   <?php _e('Enable Social Icons','dsf') ?></label></b>


		<br /><br />

		<b><label style="width:100px;">
			
			<input type="checkbox"  style="float: left; margin-right: 4px; margin-top: 4px; padding: 3px;"
               name="<?php echo $this->get_field_name('newsletter'); ?>"
			   id="<?php $this->get_field_id('newsletter'); ?>" <?php if($instance['newsletter'] != '') echo 'checked=checked '; ?>
			   />
			   <?php _e('Enable Newsletter Form','dsf') ?></label></b>


		

    	<?php
    }



}

function regcontactinfo()
{
	register_widget('BF_ContactInfo');
}
add_action('widgets_init' , 'regcontactinfo');

?>