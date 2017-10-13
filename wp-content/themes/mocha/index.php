<?php 
get_header();
?>
<?php if(get_option('mocha_sidebar_pos') != 'left') : ?>
<!-- page content -->
<section class="page">
    
            
            <div class="container">
                <div class="row">
                                
                        
                        <!-- blog -->
                        <div class="blog-wrapper span8">
                            
                                            
                                        

                                        <?php 

                                            // Blog query
                                            $blog_args = array(
                                                    'post_type' => 'post' ,
                                                    'posts_per_page' => get_option('mocha_blog_limit_posts' , 4) ,
                                                    'orderby' => get_option('mocha_blog_order' , 'date'),
                                                    'paged' => $paged

                                                );

                                            $blog_query = new WP_Query($blog_args);

                                            if($blog_query->have_posts()) : while($blog_query->have_posts()) : $blog_query->the_post();


                                            ?>
                                            
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


                                                <!-- post image [format] -->
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
                                                <div class="post-content">
                                                    
                                                        <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

                                                        <div class="content">
                                                            
                                                                <p class="light-font">
                                                                    <?php echo dsf_get_excerpt(get_the_excerpt() , 65); ?>
                                                                </p>

                                                                <p> <?php echo preg_replace('/^R\\x20\\d+\\x20/', '', dsf_get_excerpt(get_the_content() , 50), 48); 
                                                                 ?></p>


                                                        </div>
                                                        <!-- end post content -->

                                                        <?php if(get_option('mocha_enable_readmore') != 'undefined') : ?>
                                                        <!-- read more -->
                                                        <a href="<?php echo get_permalink(); ?>" class="mocha-button"><?php echo __('Read More' , 'dsf'); ?></a>
                                                        <?php endif; ?>

                                                </div>
                                                <!-- end content -->

                                            </div><!-- end post -->

                                            <?php


                                            endwhile; endif;




                                        ?>




                                        <!-- pagination -->
                                        <div class="pagination">
                                            
                                                
                                                <div class="links">


                                                    <?php if(!$paged) $paged = 1;
                                                    // max pages
                                                    $max = $blog_query->max_num_pages; ?>
                                                    
                                                            
                                                            <ul>
                                                            <?php  
                                                                $pag_args = array(
                                                                    'before'           => '<li>',
                                                                    'after'            => '</li>',
                                                                    'link_before'      => '',
                                                                    'link_after'       => '',
                                                                    'next_or_number'   => 'number',
                                                                    'nextpagelink'     => '',
                                                                    'previouspagelink' => '',
                                                                    'pagelink'         => '%',
                                                                    'echo'             => 1
                                                                );
                                                                
                                                                wp_link_pages( $pag_args ); 


                                                                if($paged > 2)
                                                                  {
                                                                    echo '<li><a href="'.get_pagenum_link(1).'">1</a></li>';
                                                                  } 
                                                                  if(($paged - 1) > 0)
                                                                  {
                                                                            echo '<li><a href="'.get_pagenum_link($paged - 1).'">'.($paged - 1).'</a></li>';
                                                                  }
                                                                  elseif (($paged - 2) > 0) {
                                                                            echo '<li><a href="'.get_pagenum_link(($paged - 2)).'">'.($paged - 2).'</a></li>';
                                                                  }
                                                                   

                                                                 // print pages links
                                                                  for($a = 1; $a <= $max; $a++)
                                                                  {
                                                                    
                                                                    if($a == $paged) echo '<li><a class="active" href="'.get_pagenum_link($a).'">'.$a.'</a></li>';
                                                                    elseif($paged == 0 && $a == 1) echo '<li><a class="active" href="'.get_pagenum_link($a).'">'.$a.'</a></li>';
                                                                    
                                                                  }

                                                                   if(($paged + 1) < $max  )
                                                                   {
                                                                        echo '<li><a href="'.get_pagenum_link($paged + 1).'">'.($paged + 1).'</a></li><li><a href="'.get_pagenum_link($paged + 2).'">'.($paged + 2).'</a></li>';
                                                                   }elseif(($paged + 1) == $max)
                                                                   {
                                                                            echo '<li><a href="'.get_pagenum_link($paged + 1).'">'.($paged + 1).'</a></li>';
                                                                   }
                                                                   if(($paged + 2) < $max)
                                                                   {
                                                                        echo '<li><a href="javascript:void(0)">...</a></li><li><a href="'.get_pagenum_link($max).'">'.$max.'</a></li>';
                                                                   }

                                                            ?>
                                                        </ul>


                                                </div>
                                                <!-- end links -->


                                                <!-- nav -->
                                                <div class="navigation">
                                                    
                                                            
                                                            <div class="prev"><?php echo get_previous_posts_link(false  ,$max) ?></div> 
                                                            <div class="next"><?php echo get_next_posts_link(false,$max) ?>
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
<!-- end page content -->

<?php else : ?>



<!-- page content -->
<section class="page">
    
            
            <div class="container">
                <div class="row">


                        <!-- sidebar -->
                        <div id="sidebar" class="sidebar span4">
                            
                                        
                                        <div class="widgets-wrapper">
                                            

                                                    
                                                    <?php dynamic_sidebar('Blog Sidebar'); ?>



                                        </div>
                                        <!-- end widgets wrapper -->


                        </div>
                        <!-- end sidebar -->
                                
                        
                        <!-- blog -->
                        <div class="blog-wrapper span8">
                            
                                            
                                        

                                        <?php 

                                            // Blog query
                                            $blog_args = array(
                                                    'post_type' => 'post' ,
                                                    'posts_per_page' => get_option('mocha_blog_limit_posts' , 4) ,
                                                    'orderby' => get_option('mocha_blog_order' , 'date'),
                                                    'paged' => $paged

                                                );

                                            $blog_query = new WP_Query($blog_args);

                                            if($blog_query->have_posts()) : while($blog_query->have_posts()) : $blog_query->the_post();


                                            ?>
                                            
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


                                                <!-- post image [format] -->
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
                                                <div class="post-content">
                                                    
                                                        <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

                                                        <div class="content">
                                                            
                                                                <p class="light-font">
                                                                    <?php echo dsf_get_excerpt(get_the_excerpt() , 65); ?>
                                                                </p>

                                                                <p> <?php echo preg_replace('/^R\\x20\\d+\\x20/', '', dsf_get_excerpt(get_the_content() , 50), 48); 
                                                                 ?></p>


                                                        </div>
                                                        <!-- end post content -->

                                                        <?php if(get_option('mocha_enable_readmore') != 'undefined') : ?>
                                                        <!-- read more -->
                                                        <a href="<?php echo get_permalink(); ?>" class="mocha-button"><?php echo __('Read More' , 'dsf'); ?></a>
                                                        <?php endif; ?>

                                                </div>
                                                <!-- end content -->

                                            </div><!-- end post -->

                                            <?php


                                            endwhile; endif;




                                        ?>




                                        <!-- pagination -->
                                        <div class="pagination">
                                            
                                                
                                                <div class="links">


                                                    <?php if(!$paged) $paged = 1;
                                                    // max pages
                                                    $max = $blog_query->max_num_pages; ?>
                                                    
                                                            
                                                            <ul>
                                                            <?php  
                                                                $pag_args = array(
                                                                    'before'           => '<li>',
                                                                    'after'            => '</li>',
                                                                    'link_before'      => '',
                                                                    'link_after'       => '',
                                                                    'next_or_number'   => 'number',
                                                                    'nextpagelink'     => '',
                                                                    'previouspagelink' => '',
                                                                    'pagelink'         => '%',
                                                                    'echo'             => 1
                                                                );
                                                                
                                                                wp_link_pages( $pag_args ); 


                                                                if($paged > 2)
                                                                  {
                                                                    echo '<li><a href="'.get_pagenum_link(1).'">1</a></li>';
                                                                  } 
                                                                  if(($paged - 1) > 0)
                                                                  {
                                                                            echo '<li><a href="'.get_pagenum_link($paged - 1).'">'.($paged - 1).'</a></li>';
                                                                  }
                                                                  elseif (($paged - 2) > 0) {
                                                                            echo '<li><a href="'.get_pagenum_link(($paged - 2)).'">'.($paged - 2).'</a></li>';
                                                                  }
                                                                   

                                                                 // print pages links
                                                                  for($a = 1; $a <= $max; $a++)
                                                                  {
                                                                    
                                                                    if($a == $paged) echo '<li><a class="active" href="'.get_pagenum_link($a).'">'.$a.'</a></li>';
                                                                    elseif($paged == 0 && $a == 1) echo '<li><a class="active" href="'.get_pagenum_link($a).'">'.$a.'</a></li>';
                                                                    
                                                                  }

                                                                   if(($paged + 1) < $max  )
                                                                   {
                                                                        echo '<li><a href="'.get_pagenum_link($paged + 1).'">'.($paged + 1).'</a></li><li><a href="'.get_pagenum_link($paged + 2).'">'.($paged + 2).'</a></li>';
                                                                   }elseif(($paged + 1) == $max)
                                                                   {
                                                                            echo '<li><a href="'.get_pagenum_link($paged + 1).'">'.($paged + 1).'</a></li>';
                                                                   }
                                                                   if(($paged + 2) < $max)
                                                                   {
                                                                        echo '<li><a href="javascript:void(0)">...</a></li><li><a href="'.get_pagenum_link($max).'">'.$max.'</a></li>';
                                                                   }

                                                            ?>
                                                        </ul>


                                                </div>
                                                <!-- end links -->


                                                <!-- nav -->
                                                <div class="navigation">
                                                    
                                                            
                                                            <div class="prev"><?php echo get_previous_posts_link(false  ,$max) ?></div> 
                                                            <div class="next"><?php echo get_next_posts_link(false,$max) ?>
                                                                </div> 

                                                </div>
                                                <!-- end navigaiton -->


                                        </div>
                                        <!-- end pagination -->



                                        <?php wp_reset_query(); ?>


                        </div>
                        <!-- end blog -->



                        



                        


                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


</section>
<!-- end page content -->

<?php endif; ?>



<?php
get_footer(); ?>