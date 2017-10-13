<?php 
get_header();
/*
	Template Name: Home Page
*/

/* -------------------------------------------------------------- 
 	Portfolio Slider Loop
 	dsf_get_loop() located in functions.php 
 	loops folder located in THEME_DIR/theme-addons/loops/
 -------------------------------------------------------------- */
if(get_option('mocha_enable_home_portfolio') != 'undefined') dsf_get_loop('portfolio-home.php');


/* -------------------------------------------------------------- 
	Blog Loop
-------------------------------------------------------------- */
dsf_get_loop('blog-home.php');

get_footer(); ?>