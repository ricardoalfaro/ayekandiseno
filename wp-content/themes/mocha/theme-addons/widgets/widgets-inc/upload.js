jQuery(document).ready(function()
	{
		


		// media manager holder
        var dsf_widget_upload;


        // when click on the upload button
        jQuery('.aboutus-upload-image').live('click' , function(e){


              // json field
              var field = jQuery(this).prev('.aboutus-image-field');

             

              e.preventDefault();

              // open the frame
              if(dsf_widget_upload){

                  dsf_widget_upload.open();
                  return ;
              }


              // create the media frame
              dsf_widget_upload = wp.media.frames.dsf_widget_upload = wp.media({

                    className : 'media-frame dsf-media-manager' ,
                    multiple: true,
                    title : 'Select Images' ,
                    button : {
                      text : 'Select'
                    }


              });


              dsf_widget_upload.on('select', function(){
              
                      var selection = dsf_widget_upload.state().get('selection');
       
                        selection.map( function( attachment ) {
                       
                            attachment = attachment.toJSON();

                            // insert images to the  feild
                            field.val(attachment.url);
                      });

                      });

              // Now that everything has been set, let's open up the frame.
              dsf_widget_upload.open();


        });
        // end upload script
	});