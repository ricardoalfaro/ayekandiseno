<?php get_header(); ?>
<?php 
    // check of portfolio post
    if(get_post_type() == 'portfolio') :
    dsf_get_loop('portfolio-single.php');
?>

<?php else : ?>
<!-- page content -->
<section class="page">
    
            
            <div class="container">
                <div class="row">
                                
                        
                        <!-- blog -->
                        <div class="blog-wrapper blog-single-post span8">
                            
                                        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>


                                        <!-- post -->
                                            <?php   $post_class = 'post ' ;
                                                    if(get_post_format() != ''){
                                                        $post_class .= get_post_format() .'-post ';
                                                    }
                                                    if(is_sticky()) {
                                                        $post_class .= 'sticky';
                                                    }

                                             ?>
                                            <div <?php post_class(); ?>>
                                                

                                                <?php post_formats_preparation(get_post_format()); ?>




                                                <!-- meta -->
                                                <div class="meta">
                                                    
                                                        <p>
                                                            <?php 
                                                            if(has_category()) {
                                                                _e('Category ' , 'dsf'); ?>: <span><?php 
                                                                        $post_categories = wp_get_post_categories( get_the_ID() );
                                                                        foreach($post_categories as $c){
                                                                            if($post_categories[0] != $c) echo ', ';
                                                                            $cat = get_category( $c );
                                                                            echo '<a href="'.get_category_link($cat->cat_ID).'">'.$cat->name.'</a> ';
                                                                }
                                                                echo '<span class="dash">/</span>';
                                                            }// end has category ?> 
                                                         <?php echo get_the_date('d M Y'); ?> <span class="dash">/</span> <a href="<?php echo get_permalink(); ?>#comments"><?php echo comments_number(); ?></a></span></p>


                                                </div>
                                                <!-- end meta -->



                                                <!-- content -->
                                                <div class="post-content content-section">
                                                    
                                                        <h2><?php echo get_the_title(); ?></h2>

                                                        <div class="content">
                                                            
                                                                <p class="light-font">
                                                                    <?php echo dsf_get_excerpt(get_the_excerpt() , 65); ?>
                                                                </p>

                                                                <p><?php the_content(); ?></p>


                                                        </div>
                                                        <!-- end post content -->

                                                        

                                                </div>
                                                <!-- end content -->



                                                <?php comments_template(); ?>


                                        </div>
                                        <!-- end post -->
                                    	<?php endwhile; endif; ?>

                                        <!-- pagination -->
                                        <div class="pagination">
                                            


                                                <!-- nav -->
                                                <div class="navigation">
                                                    
                                                            
                                                            <div class="prev"><?php next_post_link('%link' , '' , false); ?></div> 
                                                            <?php wp_link_pages(); ?>
                                                            <div class="next"><?php previous_post_link('%link' , '' , false); ?>
                                                                </div> 

                                                </div>
                                                <!-- end navigaiton -->


                                        </div>
                                        <!-- end pagination -->

                                        <?php wp_reset_query(); ?>

                                        
                        </div>
                        <!-- end blog -->



                        



                        <!-- sidebar -->
                        <div id="sidebar" class="sidebar span4">
                            
                                        
                                        <div class="widgets-wrapper">
                                            

                                                    
                                                    <?php dynamic_sidebar('Blog Sidebar'); ?>



                                        </div>
                                        <!-- end widgets wrapper -->


                        </div>
                        <!-- end sidebar -->


                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


</section>
<?php endif; // end if portfolio post type ?>
<!-- end page content -->
<?php get_footer(); ?>