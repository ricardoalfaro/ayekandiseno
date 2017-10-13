<?php get_header();
/*
	Template Name: Portfolios
*/
?>
<!-- page content -->
<section class="page portfolio-page-wrapper">
    
            
            <div class="container">
                <div class="row">


                		<?php 
						$portfolio_limit = get_option('mocha_portfolio_limit') ? get_option('mocha_portfolio_limit') : 12;

						$portfolio_args = array(
						'posts_per_page' => $portfolio_limit ,
						'orderby' => 'date',
						'post_type' => 'portfolio'
						); 

						$portfolio_query  = new WP_Query($portfolio_args);
						?>
                                
                        <!-- sort list -->
                        <div class="portfolio-sortlist span12">
                            
                                <ul>
                                    <li><a href="#" data-sort="*"><?php _e('all' , 'dsf'); ?></a></li>
                                    <?php
											
									$store_cats = array();

									if($portfolio_query->have_posts()) : 
										while($portfolio_query->have_posts()) : $portfolio_query->the_post();
									
									$cats = get_the_category(get_the_ID());
									foreach ($cats as $cat) {
										array_push($store_cats , str_replace(' ' , '-' , $cat->name));
									}
									

									endwhile; endif; 
									// end loop


									// print cats
									foreach (array_unique($store_cats) as $single_cat) {
										echo '<li><a data-sort="'.$single_cat.'" href="#">'.str_replace('-' , ' ' , $single_cat).'</a></li>';
									} ?>
                                </ul>

                        </div>
                        <!-- end sortlist -->
                        
                        <!-- portoflio  -->
                        <div class="portfolio-page">
									
									<?php if($portfolio_query->have_posts()) : while($portfolio_query->have_posts()) : 
									$portfolio_query->the_post(); ?>

                                    <!-- portfolio item -->
                                    <div <?php 

  										// sort
  										$classes = 'portfolio-item span4 ';
  										$cats = get_the_category(get_the_ID());
										foreach ($cats as $cat) {
											$classes .= ' ' . str_replace(' ' , '-' , $cat->name);
										}

  										// post classes
  										post_class($classes);?>>
                                                    

                                            <!-- image -->
                                            <a href="<?php echo get_permalink(); ?>" class="image">
                                                <?php if(has_post_thumbnail()) echo get_the_post_thumbnail(get_the_ID() , 'mocha-portfolio'); ?>
                                            </a>
                                            <!-- end image -->


                                            <!-- title -->
                                            <a href="<?php echo get_permalink(); ?>" class="title"><?php echo get_the_title(); ?> <br /> <span class="meta"><?php 

                                            $itemCatsArray = array();
                                            $itemcats = get_the_category(get_the_ID());
                                            foreach ($itemcats as $itemcat) {
                                                array_push($itemCatsArray , $itemcat->name);
                                            }
                                            echo implode(' , ' , array_unique($itemCatsArray)); ?></span></a>


                                            <!-- icon -->
                                            <a href="<?php echo get_permalink(); ?>" class="icon"></a>


                                    </div>
                                    <!-- end portfolio item -->
                                	<?php endwhile; endif; wp_reset_query(); ?>


                                    



                        </div>
                        <!-- end portfolio wrapper -->


                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


</section>
<!-- end page content -->
<?php get_footer(); ?>