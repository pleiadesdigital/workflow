<?php

/* THEME FILES */
function rowebdev_files() {

  /* SCRIPTS */
  wp_enqueue_script('main-scripts', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);


  /* GOOGLE FONTS */
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Rajdhani:400,500,600|Raleway:300,400,500');

  /* FONT-AWESOME */
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  /* MAIN STYLES */
  wp_enqueue_style( 'main-styles', get_stylesheet_uri(), NULL, microtime());


}
add_action('wp_enqueue_scripts', 'rowebdev_files');






