<?php 

/**
 * Flickr Photos Feed Widget
 * Author Url : http://themeforest.com/user/waleed_ds
 * @package business theme
 */

class BP_Flickr extends WP_Widget
{

	public $code;
	public $handle;
	public $limit;
	public $id;
	public $flickr_rand;


	function BP_Flickr(){
        $widget_ops = array('classname' => 'flickr-widget','description' => __( "Latest Flickr Photos" ,'dsf') );
		$this->WP_Widget('flickr_widget', __('Mocha Flickr Widget','dsf'), $widget_ops);
    }



    function widget($args , $instance)
    {
    	extract($args);
    	$title = apply_filters('widget_title', empty($instance['title']) ? __('Flickr Widget','dsf') : $instance['title'], $instance, $this->id_base);
    	$flickr_limit = ( $instance['flickr_limit'] ) ? $instance['flickr_limit'] : 12 ;
    	$flickr_id = ( $instance['flickr_id'] ) ? $instance['flickr_id'] : '' ;
    	$flickr_rand = rand(1 , 99);


    	echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		/**
		 * Add custom script to footer
		 */
		$this->handle = 'jflickrfeed';
		$this->code = '';
		$this->limit = $flickr_limit;
		$this->id = $flickr_id;
		$this->flickr_rand = $flickr_rand;


		add_action( 'wp_footer', array(&$this , 'print_inline_content' )  , 99 , 1);

		?>
        <div class="flickr flickr-widget-<?php echo $flickr_rand; ?>">
        </div>
        <!-- end flickr -->


		<?php
		echo $after_widget;

    }


    function form($instance)
    {


    	if(!isset($instance['title'])) $instance['title'] = __('Flickr Widget' , 'dsf');
    	if(!isset($instance['flickr_limit'])) $instance['flickr_limit'] = 12;
    	if(!isset($instance['flickr_id'])) $instance['flickr_id'] = '';


    	?>

    	<label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
	
		<b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
			<?php _e('Widget Title ','dsf') ?></label></b>
			<br />

			<input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
				                           name="<?php echo $this->get_field_name('title'); ?>"
							   id="<?php $this->get_field_id('title'); ?>" />

		<br />

		<label style="width:100px;" for="<?php echo $this->get_field_id('flickr_id'); ?>">
	
		<b><label style="width:100px;" for="<?php echo $this->get_field_id('flickr_id'); ?>">
			<?php _e('Flickr ID ','dsf') ?></label></b>
			<br />

			<input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['flickr_id']); ?>"
				                           name="<?php echo $this->get_field_name('flickr_id'); ?>"
							   id="<?php $this->get_field_id('flickr_id'); ?>" />


		<br />


		<label style="width:100px;" for="<?php echo $this->get_field_id('flickr_limit'); ?>">
	
		<b><label style="width:100px;" for="<?php echo $this->get_field_id('flickr_limit'); ?>">
			<?php _e('Limit Photos ','dsf') ?></label></b>
			<br />

			<input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['flickr_limit']); ?>"
				                           name="<?php echo $this->get_field_name('flickr_limit'); ?>"
							   id="<?php $this->get_field_id('flickr_limit'); ?>" />

    	<?php
    }

    function print_inline_content()
    {
    	if(wp_script_is($this->handle , 'done'))
    	{
    		?>

    		<script type="text/javascript">

    			jQuery('.flickr-widget-<?php echo $this->flickr_rand; ?>').html('').jflickrfeed({
					        limit: <?php echo $this->limit; ?>,
					        qstrings: {
					          id: '<?php echo $this->id; ?>'
					        },
					        itemTemplate: 
					        '<a href="{{link}}"><img src="{{image_b}}" alt="{{title}}" /></a>'
					      	});
    		
				jQuery(window).load(function()
					{	
						
						jQuery('footer .widgets-wrapper').isotope({ 

						  		filter: '*',
						      	animationEngine : 'best',
						                         		animationOptions: {
						                                duration: 750 ,
						                                queue: false
						                             } 
						    });
					});


    		
    		</script>

    		<?php
    	}

    }

}

function regflickrwidget()
{
	register_widget('BP_Flickr');
}
add_action('widgets_init' , 'regflickrwidget');

?>