<!-- post image  -->
<div class="post-image">
    
        
        <!-- image -->
        <?php if(has_post_thumbnail()){

                    echo '<a class="post-image-inner" href="'.get_permalink().'">'  .get_the_post_thumbnail(get_the_ID() , 'mocha-blog-post'). '</a>';

        } ?>


</div>
<!-- end post image -->