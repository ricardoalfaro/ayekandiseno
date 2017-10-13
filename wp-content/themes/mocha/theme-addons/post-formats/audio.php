<!-- post image / audio -->
<div class="post-image audio-post">
    

         <?php               
            $audio = get_post_meta(get_the_ID() , 'audio' , true);
            $mp3 = get_post_meta(get_the_ID() , 'mp3' , true);
            $ogg = get_post_meta(get_the_ID() , 'ogg' , true); 
                            ?>
        

        
        <?php if($audio != '') : ?>
        
        <!-- audio embed -->
        <div class="audio-embed-wrapper"><?php echo $audio; ?></div>
        
        <?php else : ?>

        
        <div class="image">
            
                <?php if(has_post_thumbnail(get_the_ID())) echo get_the_post_thumbnail(get_the_ID() , 'mocha-blog-post');  ?>


        </div>
        <!-- end image -->
        

        <div class="audio-wrapper">
            
               
                <audio controls>
                  <source src="<?php echo $ogg; ?>" type="audio/ogg">
                  <source src="<?php echo $mp3; ?>" type="audio/mpeg">
                <p><?php echo __('Your browser does not support the audio element.' , 'dsf'); ?></p>
                </audio> 

        </div>
        <!-- end audio wrapper -->
        <?php endif; ?>



</div>
<!-- end audio / post image -->