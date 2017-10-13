<!-- page content -->
<section class="page">
    
            
            <div class="container">
                <div class="row">
                                
                        
                        <!-- section title -->
                        <div class="section-title span12">
                                    
                                    
                                    <h2><?php echo get_option('mocha_blog_home_title' , __('Últimas entradas' , 'dsf')); ?></h2>

                                     <a href="<?php 
                                                if(get_option('mocha_blog_home_link') != ''){ 

                                                    $pageInfo = get_page_by_title(get_option('mocha_blog_home_link'));
                                                    echo get_page_link($pageInfo->ID);

                                                }else{ 
                                                    echo '#'; 
                                                }   ?>" class="section-link"><?php _e('Ir al blog' , 'dsf'); ?></a>

                        </div>
                        <!-- end section title -->



                        <!-- content / blog -->
                        <div class="content-wrapper blog-grid">
                            
                                <?php // Blog Loop

                                  $blog_home_limit = get_option('mocha_blog_home_limit') ? get_option('mocha_blog_home_limit') : 3;
                                  $blog_home_args = array(
                                        'posts_per_page' => $blog_home_limit ,
                                        'post_type' => 'post' ,
                                        'orderby' => 'date',
                                        'ignore_sticky_posts' => true
                                    );
                                $blog_home = new WP_Query($blog_home_args);
                                if($blog_home->have_posts()) : while($blog_home->have_posts()) : $blog_home->the_post();     
                                ?>
                                <div class="span4 blog-item">
                                                    

                                            <!-- post image -->
                                            <div class="post-image">
                                                
                                                <!-- image -->
                                                <a href="<?php echo get_permalink(); ?>" class="image">
                                                    <?php echo get_the_post_thumbnail(get_the_ID() , 'mocha-blog-home'); ?>
                                                </a>
                                                <!-- end image -->


                                                <!-- icon -->
                                                <a href="<?php echo get_permalink(); ?>" class="icon"></a>

                                            </div>
                                            <!-- end post image -->


                                            <!-- post excerpt -->
                                            <div class="post-excerpt">
                                                
                                                    <h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>

                                                    <p>
                                                            <?php echo dsf_get_excerpt(get_the_excerpt() , 20); ?>
                                                    </p>

                                            </div>
                                            <!-- end post excerpt -->


                                </div>
                                <!-- end blog item -->
                                <?php endwhile; endif; wp_reset_query(); ?>






                        </div>
                        <!-- end content wrapper -->


                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


</section>
<!-- end page content -->