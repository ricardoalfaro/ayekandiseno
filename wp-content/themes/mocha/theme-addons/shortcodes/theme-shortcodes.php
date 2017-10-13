<?php 
/*
	Theme Shortcodes
*/


/*
	Margin and Dividers
*/
add_shortcode('sh_margin' , 'sh_margin');
function sh_margin($attrs)
{
		extract(shortcode_atts(array('margin' => '40')  , $attrs));
		$margin = $margin / 2;

		return '<div style="margin-top:'.$margin.'px; margin-bottom:'.$margin.'px; float: left; clear: both; width: 100%;" class="margin"></div>';
}

add_shortcode('sh_clear' , 'sh_clear');
function sh_clear($attrs , $content)
{
    return '<!-- clear --><div class="clearfix"></div>';
}


/*
	Highlight
*/
add_shortcode('sh_highlight' , 'sh_highlight');
function sh_highlight($attrs , $content)
{
  return '<span class="highlight">'.do_shortcode($content).'</span>';
}


/*
	Columns
*/
add_shortcode('sh_columns_wrapper' , 'sh_columns');
function sh_columns($attrs , $content)
{
		if($content != '')
		{
			return '<div class="row">' . do_shortcode($content) . '</div><!-- end row -->';
		}
}	

add_shortcode('sh_column' , 'sh_column');
function sh_column($attrs , $content)
{		
	extract(shortcode_atts(array('width' => '4' , 'offset' => '') , $attrs));
	if($content != '')
	{
			$return = '<div class="span' . $width . '';
			if($offset != '' && is_numeric($offset)) $return .= ' offset'.$offset;

			$return .= '">'.do_shortcode($content).'</div><!-- end column -->';
			return $return;
	}
}


/*
	Page title
*/
add_shortcode('sh_page_title' , 'sh_page_title');
function sh_page_title($attrs , $content)
{
		return '<div class="row"><div class="section-title span12"><h2>'.$content.'</h2></div><!-- end page title --></div><!-- end row -->';
}


/*
	Column Title
*/
add_shortcode('sh_column_title' , 'sh_column_title');
function sh_column_title($attrs , $content)
{
	return '<h2 class="column-title">'.$content.'</h2>';
}

/*
	Large Text
*/
add_shortcode('sh_large_text' , 'sh_large_text');
function sh_large_text($attrs , $content)
{
	return '<p class="large">'.do_shortcode($content).'</p>';
}

/*
Light font
*/
add_shortcode('sh_light_text' , 'sh_light_text');
function sh_light_text($attrs , $content)
{
	return '<p class="light-font">'.do_shortcode($content).'</p>';
}
/*
Our Team
*/
add_shortcode('sh_team' , 'sh_team');
function sh_team($attrs , $content){
		return '<div class="our-team row">'.do_shortcode($content).'</div><!-- end our team -->';
}
add_shortcode('sh_team_member' , 'sh_team_member');
function sh_team_member($attrs , $content)
{
		extract(shortcode_atts(array(
				'image' => '',
				'name' => '',
				'facebook' => '', 
				'twitter' => '',
				'dribbble' => '',
				'rss' => '',
				'job' => '',
			) , $attrs));

		if($name != '')
		{
				$return = '<!-- member --><div class="member span4">';
				if($image != '') $return .= '<img src="'.$image.'" alt="'.$name.'" />';

				$return .= '<div class="content">';
				$return .= '<h4>'.$name.'</h4>';
				$return .= '<span class="title">'.$job.'</span>';
				$return .= '<!-- social icons --><div class="social-icons">';
				if($facebook != '') $return .= '<a href="'.$facebook.'" class="facebook"></a>';
				if($twitter != '') $return .= '<a href="'.$twitter.'" class="twitter"></a>';
				if($dribbble != '') $return .= '<a href="'.$dribbble.'" class="dribbble"></a>';
				if($rss != '') $return .= '<a href="'.$rss.'" class="rss"></a>';

				$return .= '</div><!-- end social icons -->';
				
				$return .= '</div><!-- end content -->';
				$return .= '</div><!-- end member -->';
                                
				return $return;
                                     
		}
}


/* Skills */
add_shortcode('sh_skills' , 'sh_skills');
function sh_skills($attrs , $content)
{
		extract(shortcode_atts(array(
				'stick_to_footer' => 'yes' ,
				'background' => get_template_directory_uri() . '/img/map.png',
				'graph_image' => get_template_directory_uri() . '/img/skills.png',
				'title' => __('Our Skills' , 'dsf')
		)  , $attrs));

		if($content != '' && $graph_image != '')
		{

					$return = '</div><!-- end row --></div><!-- end container --></section><!-- end page section -->';
					$return .=  '<!-- skills section --><section class="skills page dark-section"><!-- Background --><div class="background-image" style="background-image: url('.$background.')"></div>';

					$return .= '<div class="container"><div class="row">';
					$return .= '<h2 class="span12">'.$title.'</h2>';
					$return .= '<div class="span12 skills-wrapper" style="'.$graph_image.'">';
					$return .= do_shortcode($content);
					$return .= '</div><!-- end skills wrapper --></div><!-- end row --></div><!-- end container -->';
					$return .= '</section><!-- end skills -->';
					if($stick_to_footer == 'yes'){

							$return .= '<section class="empty-section"><div class="container"><div class="row">';
					}
					else{
							$return .= '<!-- page --><section class="page"><div class="container"><div class="row"><div class="span12">';
					}

					return $return;
		}	
}


add_shortcode('sh_skill' , 'sh_skill');
function sh_skill($attrs , $content)
{
		extract(shortcode_atts(array(
				'title' => '',
				'position' => 'one'
			) , $attrs));

		if($content != '')
		{
				$return = '<!-- '.$position.' --><div class="skill '.$position.'">';
				$return .= '<h4>'.$title.'</h4><p>'.$content.'</p>';
				$return .= '</div><!-- end skill '.$position.' -->';
				return $return;

		}
}


/* 
Floated Image
*/
add_shortcode('sh_floated_image' , 'sh_floated_image');
function sh_floated_image($attrs , $content)
{
		extract(shortcode_atts(array('float' => 'left') , $attrs));
		if($content != '')
		{		
				if($float == 'left') $margin = 'right'; else $margin = 'left';

				return '<div class="floatImage" style="float: '.$float.'; margin-'.$margin.':30px;">'.$content.'</div>';
		}
}



/* Blog Grid */
add_shortcode('sh_blog_grid' , 'sh_blog_grid');
function sh_blog_grid($attrs , $content)
{
		extract(shortcode_atts(array(
				'limit' => 3,
				'section_title' => __('Our Blog' , 'dsf') ,
				'enable_blog_link' => 'no'
			) , $attrs));

		if($section_title != '') :

				?>
					
				<!-- section title -->
				<div class="row">
                <div class="section-title span12">
                            
                            
                            <h2><?php echo $section_title; ?></h2>

                             <a href="<?php 
                                        if(get_option('mocha_blog_home_link') != ''){ 

                                            $pageInfo = get_page_by_title(get_option('mocha_blog_home_link'));
                                            echo get_page_link($pageInfo->ID);

                                        }else{ 
                                            echo '#'; 
                                        }   ?>" class="section-link"><?php _e('Go to blog' , 'dsf'); ?></a>

                </div>
                <!-- end section title -->

				<?php

		endif;


		?>

		<!-- content / blog -->
        <div class="content-wrapper blog-grid">
            
                <?php // Blog Loop

                  $blog_home_args = array(
                        'posts_per_page' => $limit ,
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
    	</div><!-- end main row wrapper -->

		<?php

}

?>