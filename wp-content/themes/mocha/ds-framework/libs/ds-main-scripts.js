jQuery(document).ready(function() {

	
	/**
	 * Navigation And Pages Effect
	 */
	jQuery('.dsf-container .navigation li:first').addClass('active');
	jQuery('.dsf-container .navigation a').live('click' , function() {

		if(!jQuery(this).parent().hasClass('active')) {

				jQuery('.dsf-container .navigation li').removeClass('active');
				jQuery(this).parent().addClass('active');
				jQuery('.dsf-container .pages-container .single-page').fadeOut(0);
				jQuery('.dsf-container .pages-container').find(jQuery(this).attr('href')).fadeIn(500);
				jQuery('.dsf-container .navigation').height(jQuery(jQuery(this).attr('href')).height());
		}
		return false;
	});


	// reset color
	jQuery('.input').each(function()
		{
				var a  = jQuery(this).find('.reset-input-color');
				var field = jQuery(this).find('.text.cc');
				if(field.length > 0)
				{
					a.on('click' , function()
					{
							field.val('');
							return false;
					});
				}
				
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
	

	/**
	 * Color Picker Holder
	 */
	
		jQuery('.colorpickerHolder').each(function() {

			var holder = jQuery(this);
			var nextInput = jQuery(this).next('input.text');
			var color = nextInput.val();

			/**
			 * Fix for color property
			 */
			if(color != '') {
				jQuery(this).css('background-color', '#' + color);
			}

			jQuery(this).ColorPicker({

					color: '#' + color,
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						holder.css('background-color', '#' + hex);
						nextInput.val(hex)
					}
				});
		});



	/**
	 * CheckBox
	 */
	jQuery.Zebra_TransForm(jQuery('input[type="checkbox"]'));

	jQuery('.dsf-container .single-page .field .input').each(function(){
			if(jQuery(this).find('.Zebra_TransForm_Wrapper').length > 0)
			{
					jQuery(this).addClass('input-with-zebra');
					var getDesc = jQuery(this).next('.description').find('p');
					var getID = jQuery(this).find('.checkbox').attr('id');
					getDesc.wrap('<label for="'+getID+'"></label>');
			}
	});


	/**
	 * Value Slider
	 */
	jQuery('.dsf-container .slidercontrol').slider({
		max: 1000 ,
		value: jQuery(this).prev('input.slider').val(),
		change: function(event , ui) {
			jQuery(this).prev('input.slider').attr('value' , ui.value);
		}
	});
	jQuery('.dsf-container input.slider').change(function() {
		var j = jQuery(this);
		jQuery(this).next('.slidercontrol').slider({
			value: j.val()
		});
	});


	



	/**
	 * Upload Images
	 */
	var prevField;
	var imageField;
	jQuery('.dsf-container .input .upload').each(function() {

		
		var button = jQuery(this);

		jQuery(button).live('click' , function() {

			prevField = jQuery(this).parent().prev('input');
			imageField = jQuery(this).parent().next('.uploadedImage');
			var title = jQuery(this).parent().parent().find('h3').text();

			formfield = prevField.attr('name');
			tb_show(title ,'media-upload.php?post_id=0&referer=dsf_options&type=image&TB_iframe=true' , false);
			return false;

		});

		window.send_to_editor = function(html) {

				/**
				 * Image Url
				 */
				imgsrc = jQuery('img', html).attr('src');
				prevField.val(imgsrc);

				// Remove Old Image 
				imageField.find('img').attr('src' , '').remove().stop();
				// Append New Image
				imageField.append('<img src="'+imgsrc+'" alt="" />');
				// Edit container width and height
				imageField.css({
					width: jQuery('img', html).width() + 12,
					height: jQuery('img', html).height() + 12,
					display: 'block'
				});
				
				/**
				 * Resize navigation
				 */
				jQuery('.dsf-container .navigation').height(
					jQuery('.dsf-container .pages-container .single-page:first').height());
				
				/**
				 * Remove Thickbox
				 */
				tb_remove();
		}

	});




	/**
	 * Remove Image
	 */
	jQuery('.dsf-container .input .remove').live('click' , function() {
		
		/**
		 * Get Input field and img
		 */
		var getInput = jQuery(this).parent().parent().find('input');
		var getImage = jQuery(this).parent().find('img');

		/**
		 * Remove Images
		 */
		getInput.val('');
		getImage.css({border: 'none' , boxShadow: 'none'}).attr('src' , '');

		/**
		 * Hide parent
		 */
		jQuery(this).parent().css('display',' none');

		/**
		 * Resize navigation
		 */
		jQuery('.dsf-container .navigation').height(
			jQuery('.dsf-container .pages-container .single-page:first').height());

	});


	/**
	 * Auto Append Image
	 */
	jQuery('.dsf-container .input .uploadedImage').each(function() {
		var fd = jQuery(this).parent().find('input');
		var div = jQuery(this);
		if(fd.val() != '') {
			imgsrc = fd.val();
			div.append('<img src="'+imgsrc+'" alt="" />');
			div.css({
				// width: jQuery(imgsrc).width(),
				// height: jQuery(imgsrc).height(),
				display: 'block'
			});
		}
	});





	/**
	 * Fonts
	 */
	jQuery('.dsf-container .input span.fonts').each(function() {
		
		var parent = jQuery(this).parent();
		var first = parent.find('select').first();
		var second = parent.find('select:eq(1)');
		var variants = first.find('option:selected').attr('data-variants');
		var splitted = variants.split(',');
		var appended = '';
		for(var i = 0;i < splitted.length;i++)
		{
			appended += '<option value="'+splitted[i]+'">'+splitted[i]+'</option>';
		}
		second.append(appended);

		
		first.change(function() {

			var variants = first.find('option:selected').attr('data-variants');
			var splitted = variants.split(',');
			var appended = '';
			for(var i = 0;i < splitted.length;i++)
			{
				appended += '<option value="'+splitted[i]+'">'+splitted[i]+'</option>';
			}
			second.html(appended);

		});	

	});



	/**
	 * Save Options
	 */
	jQuery('.dsf-container .pages-container .save_post').live('click' , function() {

		var button = jQuery(this) ,
			buttonDefault = button.text() ,
			content = '';


		/**
		 * Get input and textareas values 
		 */
		jQuery(this).parent().find('.input').find('input , textarea , select').each(function() {
				
				content += jQuery(this).attr('id') + '=' + jQuery(this).val() + '&';

				/**
				 * Get checkbox value
				 */
				if(jQuery(this).hasClass('checkbox') || jQuery(this).attr('type') == 'checkbox') {

					/**
					 * If checked
					 */
					if(jQuery(this).attr('checked') == 'checked') 
					{
						content += jQuery(this).attr('id') + '=checked&';
					}
					else
					{
						content += jQuery(this).attr('id') + '=undefined&';
					}

				}// end if it's checkbox
		});




		jQuery.ajax({
			type: 'POST' ,
			data: content + '&action=dsf_save_options',
			datatype: 'html',
			beforeSend: function() {
					button.text('Please Wait .. ').addClass('loading');
			},
			url: ajaxurl,
			success: function(q) {

				button.delay(1000).queue(function(n) {

					button.text('Saved').delay(2000).queue(function(t) {

						button.text(buttonDefault).removeClass('loading');
						t();
					});

					n();

				});

				
			},
			error: function(e) {

				alert(e);
			}
		});

		

		return false;
	});



	/**
	 * Delete Options
	 */
	jQuery('.dsf-container .pages-container .reset_options').live('click' , function() {

		var button = jQuery(this) ,
		buttonDefault = button.text() ,
		confirmDelete = confirm('This Will DELETE All Admin Page Settings , Are You Sure ?');


		if(confirmDelete == true) 
		{
				jQuery.ajax({
				type: 'POST' ,
				data: 'action=dsf_delete_options',
				datatype: 'html',
				beforeSend: function() {
						button.text('Please Wait .. ').addClass('loading');
				},
				url: ajaxurl,
				success: function(q) {

					button.delay(1000).queue(function(n) {

						button.text('Done').delay(2000).queue(function(t) {

							button.text(buttonDefault).removeClass('loading');
							t();
						});

						n();

					});


					/**
					 * Empty All Fields
					 */
					button.parent().find('.input').find('input , textarea , select').each(function() {

							/**
							 * Remove Values
							 */
							jQuery(this).val('');

							/**
							 * Reset CheckBox
							 */
							if(jQuery(this).hasClass('checkbox') || jQuery(this).attr('type') == 'checkbox') {
								jQuery(this).attr('checked' , '');
							}

							/**
							 * Delete Images
							 */
							var imagesFields = jQuery('.dsf-container .input .uploadedImage');
							imagesFields.find('img').attr('src' , '').remove().stop();
							imagesFields.css({display: 'none'});
							jQuery('.dsf-container .navigation').height(
								jQuery('.dsf-container .pages-container .single-page').height());
					});

					
				},
				error: function(e) {

					alert(e);
				}
			});
		}
		else
		{ 

		}
		return false;
	});

	

	/**
	 * Admin Page Scripts
	 */
	jQuery('.dsf-container .navigation').height(jQuery('.dsf-container .pages-container .single-page:first').height());
	jQuery('.dsf-container .pages-container .single-page').fadeOut(0);
	jQuery('.dsf-container .pages-container .single-page:first').fadeIn(200);

	
	/**
	 * Background Selection
	 */
	jQuery('.dsf-container .images-selection').each(function()
	{
		var container = jQuery(this);
		var input = jQuery(this).prev('input.hidden-background-field');
		jQuery(this).find('span.image').live('click' , function()
		{
			var id = jQuery(this).find('img').attr('src');
			input.val(id);

			// remove active class
			container.find('span').removeClass('active');
			jQuery(this).addClass('active');
		}
		);
	});


	/**
	 * Large Background Selection
	 */
	jQuery('.dsf-container .images-selection-large').each(function()
	{
		var container = jQuery(this);
		var input = jQuery(this).prev('input.hidden-background-field');
		jQuery(this).find('span.image').live('click' , function()
		{
			var id = jQuery(this).attr('title');
			input.val(id);

			// remove active class
			container.find('span').removeClass('active');
			jQuery(this).addClass('active');
		}
		);
	});
	

});