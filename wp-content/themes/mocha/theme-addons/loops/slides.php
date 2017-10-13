<!-- row2 -->
<div class="row">
    

    <div class="home-slider span12">

                    <div class="m-slider flexslider">

                        <ul class="slides">


                            <?php   
                                    /*
                                            Query Slides Post TYpe
                                    */
                                    $slide_args = array(
                                            'post_type' => 'slides' ,
                                            'posts_per_page' => '-1'
                                        );
                                    $slides = new WP_Query($slide_args);
                                    if($slides->have_posts()) : while($slides->have_posts()) : $slides->the_post();

                                    ?>
                                        
                                        <li> 
                                            <div class="slide">
                                                
                                                    <h2><?php echo get_the_title(); ?></h2>

                                                    <p><?php echo get_the_content(); ?></p>
                                                    
                                                    <?php if(get_post_meta(get_the_ID() , 'mp3' , true) != '') : ?>
                                                    <a href="<?php echo get_post_meta(get_the_ID() , 'mp3' , true); ?>" class="button"><?php echo get_post_meta(get_the_ID() , 'ogg' , true); ?></a>
                                                    <?php endif; ?>

                                            </div>
                                            <!-- end slide -->
                                        </li>

                                    <?php

                                    endwhile; endif; wp_reset_query();

                            ?>
                            
                        </ul>
              
                            

                    </div><!-- end m slider -->



        </div><!-- end home slider -->

</div>
<!-- end row 2-->