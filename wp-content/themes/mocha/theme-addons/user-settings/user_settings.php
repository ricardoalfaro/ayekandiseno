<?php 
/*
Mocha Theme User Settings
*/
header('Content-Type: text/css');
/**
 * This will fetch custom theme style from the backend
 */
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');
?>
<?php if(get_option('mocha_head_font_name') != '') : ?>
	
/* Main Font */
h1 , h1 span , h1 a ,

h2 , h2 span , h2 a ,

h3 , h3 span , h3 a ,

h4 , h4 span , h4 a ,

h5 , h5 span , h5 a ,

h6 , h6 span , h6 a
{
	<?php if(get_option('mocha_head_font_name') == 'Lato') : ?> 
					font-family: '<?php echo get_option('mocha_head_font_name'); ?>' , sans-serif;
	<?php else : ?>
					font-family: '<?php echo get_option('mocha_head_font_name'); ?>' !important;

	<?php endif; ?>
}
	
<?php endif; ?>

/* Main Theme Color */
<?php if(get_option('mocha_main_color') != '') : ?>
header ,  section.skills  , .section-title .section-link ,
.blog-grid .blog-item .post-image
, .portfolio-slider .portfolio-item , .portfolio-nav a:hover , .home-portfolio-pagination a:hover  , .our-team .member, .portfolio-page .portfolio-item , .portfolio-sortlist ul li a:hover , .portfolio-sortlist ul li a.active,.pagination .navigation a , .pagination .links a , section.page .section-title .section-link:hover , .wpcf7-submit , .mocha-button , #submit-comment , 
span.highlight
{
		background-color: #<?php echo get_option('mocha_main_color'); ?> !important;
}

header .m-slider a:hover , section.page .section-title .section-link:hover , dt, .portfolio-sortlist ul li a , .recent-post-tab span , .widget ul li a:hover:before ,  .comment .comment-meta a , .tweet a , .post > .meta span , .post > .meta a , a:hover , nav.menu ul ul  li a , nav.menu ul ul li a:hover {
	color: #<?php echo get_option('mocha_main_color'); ?> !important;
}
nav.menu > ul li a:hover {
	color: #fff !important;
}
.widget .flickr a:hover , .portfolio-nav a , .portfolio-sortlist ul li a ,  section.page .section-title .section-link:hover{
	border-color:  #<?php echo get_option('mocha_main_color'); ?> !important;
}
.works-wrapper a:hover {
	box-shadow: inset 0px 0px 0px 6px #<?php echo get_option('mocha_main_color'); ?>;
      -webkit-box-shadow: inset 0px 0px 0px 6px #<?php echo get_option('mocha_main_color'); ?>;
}

<?php endif; ?>


/* Hover Color */
<?php if(get_option('mocha_hover_color') != '') : ?>
section.alt-section  , .pagination .links a:hover , .pagination .navigation a:hover , .pagination a.active  ,.mocha-button:hover , .wpcf7-submit:hover , #submit-comment:hover {
	 background-color: #<?php echo get_option('mocha_hover_color'); ?> !important;
}	

<?php endif; ?>

/* footer color */
<?php if(get_option('mocha_footer_bg_color') != '') : ?>
footer {
	background-color: #<?php echo get_option('mocha_footer_bg_color'); ?> !important;
}
<?php endif; ?>

/* copyrights section color */
<?php if(get_option('mocha_copyrights_bg_color') != '') : ?>

footer  > .copyrights {
	background-color: #<?php echo get_option('mocha_copyrights_bg_color'); ?> !important;
}

<?php endif; ?>

/* Heading Color */
<?php if(get_option('mocha_heading_color') != '') : ?>
h1 , h1 a , h1 span ,
h2 , h2 a , h2 span , 
h3 , h3 a , h3 span ,
h4 , h4 a , h4 span ,
h5 , h5 a , h5 span ,
h6 , h6 a , h6 span {
	color: #<?php echo get_option('mocha_heading_color'); ?> !important;
}
<?php endif; ?>


/* Font Color */
<?php if(get_option('mocha_font_color') != '') : ?>
 ul , .gallery-caption , div , footer p , li a ,  p , span , article , a
  	, nav , blockquote , dl ,  dt , dd , td , tr , th , code , caption , figcaption , input , label , textarea {
  		color: #<?php echo get_option('mocha_font_color'); ?>;
  	}
<?php endif; ?>

/* Header and Footer Font Color */
<?php if(get_option('mocha_header_footer_font_color') != '') : ?>
 header ul , header .gallery-caption , header footer p , header li a , header  p , header span , header article 
, header nav , header blockquote , header dl , header  dt , header dd , header td , header tr , header th , header code 
, header caption , header figcaption , header input , header label , header textarea ,
 footer ul , footer .gallery-caption , footer footer p , footer li a , footer  p , footer span , footer article 
, footer nav , footer blockquote , footer dl , footer  dt , footer dd , footer td , footer tr , footer th , footer code 
, footer caption , footer figcaption , footer input , footer label , footer textarea , 
.dark-section ul , .dark-section .gallery-caption , .dark-section .dark-section p , .dark-section li a , .dark-section  p , .dark-section span , .dark-section article 
, .dark-section nav , .dark-section blockquote , .dark-section dl , .dark-section  dt , .dark-section dd , .dark-section td , .dark-section tr , .dark-section th , .dark-section code 
, .dark-section caption , .dark-section div, .dark-section ul li a , .dark-section .tagcloud a , .dark-section figcaption , .dark-section input , .dark-section label , .dark-section textarea 
{
	color: #<?php echo get_option('mocha_header_footer_font_color'); ?> !important;
}
<?php else : ?>
 header ul , header .gallery-caption , header footer p ,  header  p , header span , header article 
, header nav , header blockquote , header dl , header  dt , header dd , header td , header tr , header th , header code 
, header caption , header figcaption , header input , header label , header textarea ,
 footer ul , footer .gallery-caption , footer footer p , footer li a , footer  p , footer span , footer article 
, footer nav , footer blockquote , footer dl , footer  dt , footer dd , footer td , footer tr , footer th , footer code 
, footer caption , footer figcaption , footer input , footer label , footer textarea , 
.dark-section ul , .dark-section .gallery-caption , .dark-section .dark-section p , .dark-section li a , .dark-section  p , .dark-section span , .dark-section article 
, .dark-section nav , .dark-section blockquote , .dark-section dl , .dark-section  dt , .dark-section dd , .dark-section td , .dark-section tr , .dark-section th , .dark-section code 
, .dark-section caption , .dark-section div, .dark-section ul li a , .dark-section .tagcloud a , .dark-section figcaption , .dark-section input , .dark-section label , .dark-section textarea 
{
	color: #fff !important;
}	
<?php endif; ?>
/* Link Color */
<?php if(get_option('mocha_link_color') !=  '') : ?>
a {
	color: #<?php echo get_option('mocha_link_color'); ?>;
}
<?php endif; ?>
/* custom css */
<?php if(get_option('mocha_custom_css') != '') echo get_option('mocha_custom_css'); ?>