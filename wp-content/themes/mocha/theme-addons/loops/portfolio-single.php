<!-- page content -->
<section class="page single-portfolio-item">
    
            
            <div class="container">
                <div class="row">
                                
                        <?php
                                // define post categories to use it later in related posts section
                                $portfolio_post_cats = array();
                                // global post id to skip in related query
                                $this_portfolio_post = array();
                        ?>
                        <?php // loop
                            

                            if(have_posts()) : while(have_posts()) : the_post(); 


                                // push categories to use them later in related posts section
                                $post_cats = get_the_category(get_the_ID());
                                foreach ($post_cats as $cat) {
                                    array_push($portfolio_post_cats , $cat->cat_ID);
                                }

                                // get post id to skip in related posts
                                array_push($this_portfolio_post , get_the_ID());
                        ?>

                        <!-- item title -->
                        <div class="title span12">
                            
                                    <h3><?php the_title(); ?></h3>

                                    <!-- navigaiton -->
                                    <div class="portfolio-nav">
                                        
                                                <div class="prevPost"><?php  previous_post_link('%link' , '' , false); ?></div> 
                                                <div class="middle"><a href="<?php 
                                                if(get_option('mocha_portfolio_page_link') != ''){ 

                                                    $pageInfo = get_page_by_title(get_option('mocha_portfolio_page_link'));
                                                    echo get_page_link($pageInfo->ID);

                                                }else{ 
                                                    echo '#'; 
                                                }   ?>"></a></div>
                                                <div class="nextPost"><?php next_post_link('%link' , '' , false); ?></div>

                                    </div>
                                    <!-- end portfolio nav -->

                        </div>
                        <!-- end item title -->




                        <!-- item content -->
                        <div class="item-content post-content">
                            
                                        <?php if(get_post_meta(get_the_ID() , 'buzz_media_gallery' , true) != '' || has_post_thumbnail()) : ?>
                                        <!-- slider -->
                                        <div class="span8">

                                                <?php if(has_post_thumbnail() && get_post_meta(get_the_ID() , 'buzz_media_gallery' , true) == '') : ?>
                                                <div class="post-thumbnail-portfolio">
                                                    
                                                        <?php echo get_the_post_thumbnail(get_the_ID() , 'full'); ?>
                                            

                                                </div>
                                                <!-- end post thumbnail -->

                                                <?php else : ?>
                                                <div class="flexslider portfolio-slider-wrapper">
                                                    
                                                                
                                                <ul class="slides">

                                                <?php 
                                                    
                                                    // get the images , fix any double comma errors , convert it to array
                                                    $images = explode(',' , str_replace(',,' , ',' , get_post_meta(get_the_ID()  , 'buzz_media_gallery' , true)));

                                                    foreach ($images as $image) {
                                                        
                                                        if($image != ''){
                                                            // get the cropped version of the image
                                                            if(   (strpos($image , '.jpg') !== false)   ||  (strpos($image , '.png') !== false)  )
                                                            {
                                                                    $fixedImage = str_replace('.jpg' , '-840x450.jpg' , $image);
                                                                    $fixedImage = str_replace('.png' , '-840x450.png' , $image);
                                                                    if(file_exists($fixedImage)) $image = $fixedImage;
                                                            }
                                                        ?>
                                                            <li><a href="<?php echo get_permalink(); ?>" class="image-link"><img src="<?php echo $image; ?>" alt="" /></a></li>
                                                        <?php
                                                        }
                                                    }
                                                ?>

                                                </ul>


                                                </div>
                                                <!-- end slider -->

                                                <?php endif; ?>
                                        </div>
                                        <!-- end span8 -->
                                        <?php endif; ?>



                                        <!-- content -->
                                        <div class="content <?php if(get_post_meta(get_the_ID() , 'buzz_media_gallery' , true) != '' || has_post_thumbnail()) echo 'span4'; else echo 'span12'; ?>">
                                            

                                                <p class="light-font"><?php echo get_the_content(); ?></p>


                                                <div class="margin"></div>


                                                <!-- item meta -->
                                                <div class="item-meta">
                                                        

                                                        <dl>
                                                            <?php if(get_post_meta(get_the_ID() , 'clint' , true) != '') : ?>
                                                            <dt><?php _e('Cliente:' , 'dsf'); ?></dt>
                                                            <dd><?php echo get_post_meta(get_the_ID() , 'clint' , true); ?></dd>
                                                            <?php endif; ?>
                                                            
                                                            <?php if(get_the_terms(get_the_ID() , 'skills') != '') : ?>
                                                            <dt><?php _e('Habilidades:' , 'dsf'); ?></dt>
                                                            <dd><?php $skills = get_the_terms(get_the_ID() , 'skills');
                                                                    $skillRand  = 0;
                                                                    foreach ($skills as $skill) {
                                                                            $skillRand++;
                                                                            if($skillRand > 1) echo ' , ';
                                                                            echo $skill->name;
                                                                    }       
                                                             ?></dd>
                                                            <?php endif; ?>
                                                            

                                                            <?php if(get_post_meta(get_the_ID() , 'website' , true) != '') : ?>
                                                            <dt><?php _e('Sitio web:' , 'dsf'); ?></dt>
                                                            <dd><?php echo get_post_meta(get_the_ID() , 'website' , true); ?></dd>
                                                            <?php endif; ?>
                                                        </dl>


                                                </div>
                                                <!-- end item meta -->


                                        </div>
                                        <!-- end content -->


                        </div>
                        <!-- end item content -->
                        <?php endwhile; endif; wp_reset_query(); ?>




                        <!-- clear -->
                        <div class="clearfix"></div>
                        
                        <?php 
                        // check if post categories is not empty and have more than one post (current post)
                        if(!empty($portfolio_post_cats) && get_option('mocha_enable_related') != 'undefined')
                        {   
                            $countPosts = 0;
                            $check_cats = get_categories('include='.implode(',' , $portfolio_post_cats));
                            foreach ($check_cats as $singleCat) {
                                if($singleCat->count > 1) $countPosts = 1;
                            }

                            // check if one category have at least one or more posts
                            if($countPosts > 0) :

                            ?>
                            
                            <!-- related works -->
                            <div class="related-works span12">
                                
                                            

                                            <h3 class="span12 related-title"><?php 
                                            if(get_option('mocha_related_title') != '') $related_title = get_option('mocha_related_title'); else $related_title = __('Otros trabajos' , 'dsf');

                                            echo $related_title; ?></h3>
                                            

                                            <div class="slider-pagination">
                                                    <a href="#" class="prev"></a>
                                                    <a href="#" class="next"></a>


                                            </div>

                                             <div class="clearfix"></div>
                                            

                                            <div class="related-works-wrapper portfolio-slider">




                                                        <?php 

                                                        // related posts loop
                                                        if(get_option('mocha_related_limit') != ''){
                                                             $related_limit = get_option('mocha_related_limit');
                                                        }
                                                        else { 
                                                            $related_limit = 10;
                                                        }

                                                        // query 
                                                        if(!empty($this_portfolio_post))
                                                        {
                                                            $related_query = new WP_Query(array(
                                                                    'posts_per_page' => $related_limit ,
                                                                    'post_type' => 'portfolio' ,
                                                                    'category__and' => $portfolio_post_cats,
                                                                    'orderby' => 'date',
                                                                    'post__not_in' => $this_portfolio_post)
                                                            );
                                                        }
                                                        else{
                                                            $related_query = new WP_Query(array(
                                                                    'posts_per_page' => $related_limit ,
                                                                    'post_type' => 'portfolio' ,
                                                                    'category__and' => $portfolio_post_cats,
                                                                    'orderby' => 'date')
                                                            );
                                                        }
                                                        
                                                        if($related_query->have_posts()) : while($related_query->have_posts()) : $related_query->the_post();

                                                        ?>
                                                        
                                                        <!-- portfolio item -->
                                                        <div <?php 

                                                            // sort
                                                            $classes = 'portfolio-item slide ';
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
                                                                <a href="<?php echo get_permalink(); ?>" class="title"><?php echo get_the_title(); ?> <br /> <span class="meta"><?php if(has_tag()){
                                                                            $tags = get_the_tags(get_the_ID());
                                                                            $tagIndex = 0;
                                                                            foreach($tags as $tag){
                                                                                $tagIndex ++;
                                                                                if($tagIndex > 1) echo ' , ';
                                                                                echo $tag->name;
                                                                            } 
                                                                } ?></span></a>


                                                                <!-- icon -->
                                                                <a href="<?php echo get_permalink(); ?>" class="icon"></a>


                                                        </div>
                                                        <!-- end portfolio item -->


                                                       


                                                        <?php endwhile; endif; wp_reset_query(); ?>




                                            </div>
                                            <!-- end related works wrapper -->


                            </div>
                            <!-- end related works -->


                            <?php

                            endif; // end checking if categories have more than 1 post

                        }
                        ?>
                        
                        

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


</section>
<!-- end page content -->