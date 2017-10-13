<!-- portfolio -->
<section class="portfolio-wrapper alt-section">
    

            <div class="container">
                <div class="row home-portfolio-wrapper">


                            <!-- section title -->
                            <div class="section-title span12">
                                        
                                        
                                        <h2><?php echo get_option('mocha_portfolio_title' , 'Nuestro Trabajo'); ?></h2>

                                        <a href="<?php 
                                                if(get_option('mocha_portfolio_page_link') != ''){ 

                                                    $pageInfo = get_page_by_title(get_option('mocha_portfolio_page_link'));
                                                    echo get_page_link($pageInfo->ID);

                                                }else{ 
                                                    echo '#'; 
                                                }   ?>" class="section-link"><?php _e('Ir al portafolio' , 'dsf'); ?></a>

                            </div>
                            <!-- end section title -->


                            <div class="home-portfolio-pagination">
                                                <a href="#" class="prev"></a>
                                                <a href="#" class="next"></a>


                            </div>

                             <div class="clearfix"></div>
                            

                            <?php 


                                /*
                                        Portfolio Loop
                                */
                                $portfolio_limit = get_option('mocha_portfolio_home_limit') ? get_option('mocha_portfolio_home_limit') : 10;
                                $portfolio_home_args = array(
                                    'posts_per_page' => $portfolio_limit ,
                                    'orderby' => 'date',
                                    'post_type' => 'portfolio');
                                $portfolio_home = new WP_Query($portfolio_home_args);

                            ?>
                        
                            <!-- portfolio items -->
                            <div class="portfolio-slider content-wrapper">

                                    
                                    <?php if($portfolio_home->have_posts()) : while($portfolio_home->have_posts()) : $portfolio_home->the_post(); ?>
                                    <!-- portfolio item -->
                                    <div class="span6 portfolio-item">
                                                    
                                            <?php   $store_cats = array();
                                                    $cats = get_the_category(get_the_ID());
                                                    foreach ($cats as $cat) {
                                                        array_push($store_cats , $cat->name);
                                                    } ?>
                                            <!-- image -->
                                            <a href="<?php echo get_permalink(); ?>" class="image">
                                                <?php the_post_thumbnail(get_the_ID() , 'mocha-portfolio'); ?>
                                            </a>
                                            <!-- end image -->


                                            <!-- title -->
                                            <a href="<?php echo get_permalink(); ?>" class="title"><?php echo get_the_title(); ?> <br /> <span class="meta"><?php echo implode(' , ' , array_unique($store_cats)); ?></span></a>


                                            <!-- icon -->
                                            <a href="<?php echo get_permalink(); ?>" class="icon"></a>


                                    </div>
                                    <!-- end portfolio item -->

                                    <?php endwhile; endif; wp_reset_query(); ?>

                            </div>
                            <!-- end portfolio items -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


</section>
<!-- end portfolio -->