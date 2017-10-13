<?php 
get_header();
?>

<!-- page content -->
<section class="page">
    
            
            <div class="container">
                <div class="row">
                                
                        <div class="span12">
                        <?php 

                        if(have_posts()) : while(have_posts()) : the_post();

                        the_content();

                        endwhile; endif; wp_reset_query(); ?>
                        </div><!-- end span12 -->


                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


</section>
<!-- end page content -->



<?php
get_footer(); ?>