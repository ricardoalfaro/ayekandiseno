<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shortcodes</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php 

		define('WP_USE_THEMES', false);
		require_once('../../../../../../wp-load.php');
		$wpurl = get_site_url();
		$template = get_template_directory_uri() . '/theme-addons/tinymce-addons/sc_button/';
	?>
	<script type="text/javascript" src="<?php echo $wpurl; ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script type="text/javascript" src="<?php echo $wpurl; ?>/wp-includes/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $wpurl; ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script type="text/javascript" src="<?php echo $template; ?>/js/jquery-ui-all.min.js"></script>
	<script type="text/javascript" src="<?php echo $template; ?>/js/script.js"></script>
	<script>jQuery(document).ready(function()
{


	// menu
	jQuery('.menu ul li a:first').addClass('active');
	jQuery('.content > .field').fadeOut(0);
	jQuery('.content > .field').first().fadeIn().addClass('active-shortcode');
	jQuery('.menu ul li a').on('click' , function()
		{
				jQuery(this).parent().parent().find('a').removeClass('active');
				jQuery(this).addClass('active');
				
				var id = jQuery(this).attr('href');
				jQuery('.content .field').fadeOut(0).removeClass('active-shortcode');
				jQuery(id).fadeIn(500).addClass('active-shortcode');
		});
	

	// adding the shortcode
	jQuery('.add').on('click' , function() {
	
		// prepare the shortcode
		var shortcode = '[sh_' + jQuery('.field.active-shortcode').attr('id') + ' ';
		var field = jQuery('.field.active-shortcode').find('.active-field');
		if(field.length > 0)
		{
				field.each(function()
				{
					shortcode += jQuery(this).attr('name') + '="' + jQuery(this).val() + '" ';
				});
				shortcode += '][/sh_' + jQuery('.field.active-shortcode').attr('id') + ']';
		}
		else{
				shortcode += '][/sh_' + jQuery('.field.active-shortcode').attr('id') + ']';
		}
		
		 
		tinyMCE.activeEditor.selection.setContent(shortcode);
		
		tinyMCEPopup.close();
		
	});

	/**
	 * Select
	 */
	 jQuery('.dsf-container select').each(function() {
	 	if(jQuery(this).parent().find('.arrow').length > 0) 
	 	{
	 		jQuery(this).before('<div class="arrow2"></div>');
	 	}
	 	else
	 	{
	 		jQuery(this).before('<div class="arrow"></div>');
	 	}
	 });


	// slider
	jQuery('.slidercontrol').each(function()
		{
				var maxnum = jQuery(this).parent().find('input').attr('data-max');
				jQuery(' .slidercontrol').slider({
				max: maxnum ,
				value: jQuery(this).prev('input.slider').val(),
				change: function(event , ui) {
					jQuery(this).prev('input.slider').attr('value' , ui.value);
				}
			});
		});
	jQuery('input.slider').change(function() {
		var j = jQuery(this);
		jQuery(this).next('.slidercontrol').slider({
			value: j.val()
		});
	});




	
});</script>
	<link   rel="stylesheet" href="<?php echo $template; ?>/css/style.css" media="all" />
	<style type="text/css">html , body {
	background: #fff;
}

p , a {
	font-size: 12px;
}

span {
	font-size: 11px !important;
}

h3 {
	font-size: 20px;
}

h4 {
	font-size: 16px;
	padding-bottom: 10px;
	border-bottom: 1px solid #EBEBEB;
}

h5 {
	font-size: 12px;

}

 h2 ,  h1 ,  h3 , h4 , h5 {
	color: #8A8A8A; 
	font-family: Helvetica , Georgia , sans-serif;
	font-weight: 800;
	float: left;
	clear: both;
	width: 100%;
	margin-bottom: 10px;
	
}


 .container input.slider {
	width: 43px;
	max-width: 43px;
	float: left; 
	text-align: center;
	color: #8A8A8A; 
}

.container .slidercontrol {
	position: relative;
	 float: left; 
	clear: none;
	width: 77%;
	height: 6px;
	margin-left: 5%; 
	margin-top: 12px;
	background: #f7f7f7;
	border-radius: 10px;
	border: 1px solid #e4e4e4;
	box-shadow: inset 0px 2px 4px #e4e4e4;
}

.container .slidercontrol a {
	border-radius: 50px;
	background: #fff;
	top: -7px;
	width: 20px;
	height: 20px;
	position: absolute;
	box-shadow: 0px 2px 4px #BBBBBB;

}



.menu {
	width: 30%;
	float: left;
	clear: both;
	background: #F9F9F9;

}

.menu ul {
	padding: 0px;
	margin: 0px;
	float: left;
	clear: both;
	width: 100%;
}

.menu ul li {
	float: left;
	clear: both;
	padding:0px;
	width: 100%;
	list-style: none;
}

.clearfix {
	float: left;
	clear: both;
	width: 100%;
	margin: 10px 0px`;
	
}

.menu ul li a {
	display: block;
	margin: 0px;
	padding: 15px 5% 15px 15%;
	width: 80%;
	font-size: 12px;
	text-align : left;
	text-decoration: none;
	color: #666666;
	border-bottom: 1px solid #F2F2F2;

}


.menu ul li a.active , .menu ul li a:hover {
	background: #5BCDE1;
	color: #fff;
}

.content {
	float: left;
	width: 60%;
	padding: 0px 2%;
}

.content span.desc {
	background: #5BCDE1;
	color: #fff;
	float: left;
	clear: both;
	margin-top: 20px;
	padding: 10px 5%;
	border-radius: 5px;
	width: 90%;
	margin-bottom: 20px;
}

/* select */

 select {
	background: #fff;
	border: 1px solid #E4E4E4;
	z-index: 0;
	position: relative;
	width: 100%; 
	color: #787878;
	padding: 10px 10px;
	font-weight: normal;
	font-size: 13px;
	min-height: 40px;
	float: left; clear: both; 
}

 select.full option {
	float: left; clear: both;
	width: 100%; 
	color: #7f7f7f;
}



.arrow {
	background: url(images/arrow_right.png) no-repeat !important;
	position: absolute;
	right: 5px;
	top: 52px;
	z-index: 2;
	width: 31px;
	height: 31px;

}

 input.text ,  input.email ,  input[type=text] , 
 textarea ,  .email ,
 input[type=email]  {
	float: left;
	clear: both;
	width: 100% !important;
	padding: 10px 10px;
	background: #ececec;
	border: 1px solid #dbdbdb;
	border-radius: 3px;
	-webkit-box-shadow: inset 0px 2px 5px #dbdbdb;
	box-shadow: inset 0px 2px 5px #dbdbdb;

}


 .input .arrow2 {
	background: url(images/arrow_right.png) no-repeat;
	position: absolute;
	left: 38%;
	top: 52px;
	z-index: 2;
	width: 31px;
	height: 31px;

}


/**
 * Value Slider
 */
 input.slider {
	width: 43px;
	max-width: 43px;
	float: left; 
}

 .slidercontrol {
	position: relative;
	 float: left; 
	clear: none;
	width: 77%;
	margin-left: 5%; 
	margin-top: 10px;
	background: #fff;
	border-radius: 10px;
	border: 1px solid #e4e4e4;
	box-shadow: inset 0px 2px 4px #e4e4e4;
}

 .slidercontrol a {
	border-radius: 50px;
	background: #fff;
	box-shadow: 0px 2px 4px #D3D3D3;
	top: -6px;
	width: 20px;
	height: 20px;
}



/**
 * Save Button
 */

 .add {
	float: right; clear: both; margin: 20px 0px 0px 0px;
	padding: 4px 14px;
	z-index: 9;
	text-decoration: none;
	top: -30px;
	right: 0px;
	background: #39b6e4;
	color: #fff !important;
	font-size: 13px;
	font-family: 'Open Sans' , sans-serif;
	min-width: 80px;
	text-align: center;
}



div.clearfix {
	float :left;
	clear: both;
	width: 100%;
}

body span.description {
	float :left;
	clear: both;
	margin-top: 10px;
	font-size: 11px;
	color: #A7A7A7;
}

 .field span {
	margin-bottom: 10px;
}

</style>
</head>
<body>
<!-- container -->
<div class="container">

	<?php 

			$shortcodes = array(

							array(

									'id' => 'Margin' ,
									'description' => __('Add margin divider .. ' , 'dsf'),
									'fields' => array(

								 					array(
								 							'id' => 'Margin',
								 							'type' => 'slider' ,
								 							'description' => __('Select margin width' , 'dsf'),
								 							'max' => 1000
								 					)
										)
							),
							array(
									'id' => 'Clear',
									'description' => __('Add a clear div' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Highlight',
									'description' => __('Add a highlighted content' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Columns Wrapper',
									'description' => __('Add a columns wrapper, please use full width page template with this shortcode .. this bootstrap-based columns' , 'dsf'),
									'fields' => false
							),
							array(
								'id' => 'Column',
								'description' => __('Add a single column , please wrap columns with Columns Wrapper Shortcode' , 'dsf'),
								'fields' => 
										array(
										array(
			 							'id' => 'Width',
			 							'type' => 'select' ,
			 							'options' => '2,4,6,8,10,12',
			 							'description' => __('Select column width' , 'dsf')
			 							) ,
			 							array(
			 							'id' => 'Offset',
			 							'type' => 'select' ,
			 							'options' => '0,2,4,6,8,10,12',
			 							'description' => __('Select column offset' , 'dsf')
			 							) )
							),
							array(

									'id' => 'Page Title' ,
									'description' => __('Add Large Page Title' , 'dsf'),
									'fields' => false
							),
							array(

									'id' => 'Column Title' ,
									'description' => __('Add Large Column Title' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Large Text',
									'description' => __('Wrap text with shortcode to make it 24px size' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Light Text',
									'description' => __('Wrap text with shortcode to make it 300 font-wight' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Team',
									'description' => __('Team members wrapper' , 'dsf'),
									'fields' => false
							),
							array(

									'id' => 'Team Member' ,
									'description' => __('Add Large Column Title' , 'dsf'),
									'fields' => array(
								 					
								 					array(
								 							'id' => 'Image',
								 							'type' => 'text' ,
								 							'description' => __('Team Member Image' , 'dsf')
								 					),
								 					array(
								 							'id' => 'Name',
								 							'type' => 'text' ,
								 							'description' => __('Team Member Name' , 'dsf')
								 					),
								 					array(
								 							'id' => 'Job',
								 							'type' => 'text' ,
								 							'description' => __('Team Member Job' , 'dsf')
								 					),
								 					array(
								 							'id' => 'Facebook',
								 							'type' => 'text' ,
								 							'description' => __('Team Member Facebook' , 'dsf')
								 					),
								 					array(
								 							'id' => 'Twitter',
								 							'type' => 'text' ,
								 							'description' => __('Team Member Twitter' , 'dsf')
								 					),
								 					array(
								 							'id' => 'Dribbble',
								 							'type' => 'text' ,
								 							'description' => __('Team Member Dribbble' , 'dsf')
								 					),
								 					array(
								 							'id' => 'Rss',
								 							'type' => 'text' ,
								 							'description' => __('Team Member Rss' , 'dsf')
								 					)
										)
							),
							array(
								'id' => 'Skills',
								'description' => __('Add skills wrapper' , 'dsf'),
								'fields' => 
										array(array(
			 							'id' => 'Stick To Footer',
			 							'type' => 'select' ,
			 							'options' => 'yes,no',
			 							'description' => __('Stick the skills to footer' , 'dsf')
			 							) ,
			 							array(
								 							'id' => 'Background',
								 							'type' => 'text' ,
								 							'description' => __('Background URL' , 'dsf')
								 					),
			 							array(
								 							'id' => 'Graph Image',
								 							'type' => 'text' ,
								 							'description' => __('Graph Image URL' , 'dsf')
								 					),
			 							array(
								 							'id' => 'Title',
								 							'type' => 'text' ,
								 							'description' => __('Skills section title' , 'dsf')
								 					))
							),
							array(
								'id' => 'Skill',
								'description' => __('Single skill' , 'dsf'),
								'fields' => 
										array(array(
			 							'id' => 'Position',
			 							'type' => 'select' ,
			 							'options' => 'one,two,three,four,five',
			 							'description' => __('Skill Position From Left To Right' , 'dsf')
			 							) ,
			 							array(
								 							'id' => 'Title',
								 							'type' => 'text' ,
								 							'description' => __('Skills section title' , 'dsf')
								 					))
							),
							array(
								'id' => 'Blog Grid',
								'description' => __('Add a blog grid posts .. ' , 'dsf'),
								'fields' => 
										array(
											
											array(
				 							'id' => 'Enable Blog Link',
				 							'type' => 'select' ,
				 							'options' => 'no,yes',
				 							'description' => __('Enable or disable blog section link' , 'dsf')
				 							) ,
				 							array(
				 							'id' => 'Section Title',
				 							'type' => 'text' ,
				 							'description' => __('Blog section title , you can leave it empty to disable the title .' , 'dsf')
								 			) ,

				 							array(
								 							'id' => 'Limit',
								 							'type' => 'slider' ,
								 							'description' => __('Limit posts count' , 'dsf'),
								 							'max' => 100
								 					)
					 					)
							),
							array(
								'id' => 'Floated Image',
								'description' => __('Wrap and image with shit shortcode to make to float to right or left' , 'dsf'),
								'fields' => 
										array(
			 							'id' => 'Float',
			 							'type' => 'select' ,
			 							'options' => 'left , right',
			 							'description' => __('Float Direction' , 'dsf')
			 							) 
							)


				);

	?>



	<!-- left menu -->
	<div class="menu">
		
		<ul>

			<?php foreach($shortcodes as $single)
			{
							echo '<li><a data-shortcode="'.strtolower(str_replace(' ' , '_' , $single['id'])).'" href="#'.strtolower(str_replace(' ' , '_' , $single['id'])).'">'.$single['id'].'</a></li>';
			} ?>	
	
		</ul>
	</div>
	<!-- end menu -->




	<!-- content -->
	<div class="content">
		
				
			<?php foreach($shortcodes as $page)
			{
								?>
												

										<!-- field -->
										<div class="field" id="<?php echo strtolower(str_replace(' ' , '_' , $page['id'])); ?>">
											
												
												<?php if(isset($page['description']) && $page['description'] !== '') : ?>
												<span class="desc"><?php echo $page['description']; ?></span>
												<?php endif; ?>


												<div class="clearfix"></div>


												<h4><?php echo $page['id']; ?></h4>

												<div class="clearfix"></div>


												<?php if($page['fields'] !== false) : ?>
														

													<?php foreach($page['fields'] as $field) {


																switch($field['type'])
																{
																	case 'text' :

																	echo '<h5>'.$field['id'].'</h5><div class="clearfix"></div><input type="text" name="'.strtolower(str_replace(' ' , '_' , $field['id'])).'" class="active-field" /><div class="clearfix"></div><span class="description">'.$field['description'].'</span>';

																	break;

																	case 'textarea' :

																	echo '<h5>'.$field['id'].'</h5><div class="clearfix"></div><textarea class="active-field" name="'.strtolower(str_replace(' ' , '_' , $field['id'])).'"></textarea><div class="clearfix"></div><span class="description">'.$field['description'].'</span>';

																	break;

																	case 'slider' :
																	?>
																	<h5><?php echo $field['id']; ?></h5><div class="clearfix"></div>	
																	<input data-max="<?php echo $field['max']; ?>" value="0" type="text" class="text active-field slider" name="<?php echo strtolower(str_replace(' ' , '_' , $field['id'])); ?>" 
																   id="<?php echo strtolower(str_replace(' ' , '_' , $field['id'])); ?>"
																    />
																	<div class="slidercontrol"></div><div class="clearfix"></div><span class="description"><?php echo $field['description']; ?></span>
	
																	<?php
																	break;

																	case 'select' :
																	?>

																	<h5><?php echo $field['id']; ?></h5><div class="clearfix"></div><select class="active-field full" 
																	id="<?php echo strtolower(str_replace(' ' , '_' , $field['id'])); ?>" 
																	name="<?php echo strtolower(str_replace(' ' , '_' , $field['id'])); ?>">

																		<?php 
																				$field_array = explode(',' , $field['options']);
																				foreach($field_array as $option) {

																					?>
																					<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
																					<?php
																				}
																		 ?>
																	</select><div class="clearfix"></div><span class="description"><?php echo $field['description']; ?></span>
																	<?php
																	break;

																	
																}// end switch


													}// end foreach fields ?>
														


												<?php endif; ?>



												<!-- button -->
												<a href="javascript:void(0);" class="add"><?php _e('Add Shortcode' , 'dsf'); ?></a>


										</div>
										<!-- end field -->



								<?php
			} ?>



	</div>
	<!-- end content -->



</div><!-- end container -->


	
</body>
</html>