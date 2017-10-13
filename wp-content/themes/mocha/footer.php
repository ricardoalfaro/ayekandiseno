<!-- footer -->
<footer>
    
    <div class="container">
        <div class="row">
            
                    
                    <!-- widgets wrapper -->
                    <div class="widgets-wrapper">
                        
                                
                                <?php dynamic_sidebar('Footer'); ?>


                    </div>
                    <!-- end widgets wrapper -->


        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    
    <?php if(get_option('mocha_enable_second_footer') != 'undefined') : ?>
        
    <!-- second container / copyrights -->
    <div class="copyrights">
        
                    <div class="container">
                        <div class="row">
                            

                                <div class="copyrights-wrapper span12">
                                    
                                    
                                    <!-- left copyrights -->
                                    <div class="left-copyrights">
                                        
                                        <p><?php echo stripslashes_deep(get_option('mocha_copyrights' , __('MOCHA THEME. CREATED BY SUITSTHEME.' , 'dsf'))); ?></p>

                                    </div>
                                    <!-- end left copyrights -->



                                    <!-- right menu -->
                                    <div class="right-menu">
                                        

                                            <?php wp_nav_menu(array(
                                                      'theme_location' => 'secondary',
                                                      'items_wrap' => '<ul>%3$s</ul>',
                                                      'container' => false )); ?>



                                    </div>
                                    <!-- end right menu -->



                                </div><!-- end span12 -->

                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->

    </div>
    <!-- end copyrights -->
    <?php endif; ?>
</footer>
<?php wp_footer(); 
if(get_option('mocha_tracking_code') != '') echo stripslashes_deep(get_option('mocha_tracking_code')); ?>
</body>
</html>