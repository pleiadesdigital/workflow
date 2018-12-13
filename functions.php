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

/* THEME FEATURES */
function rowebdev_features () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  // IMAGE SIZES
  add_image_size('page-banner');
  add_image_size('feat-image', 960, 600, array('center', 'top'));
}
add_action('after_setup_theme', 'rowebdev_features');


/* CUSTOM POST TYPES */

function rowebdev_cpts() {
  /* EVENTS POST TYPE */
  $labels = array(
    'name'            => 'Events',
    'add_new_item'    => 'Add New Event',
    'edit_item'       => 'Edit Event',
    'all_items'       => 'All Events',
    'singular_name'   => 'Event'
  );
  $args = array(
    'supports'        => array('title', 'editor', 'excerpt'),
    'rewrite'         => array('slug' => 'events'),
    'has_archive'     => true,
    'public'          => true,
    'labels'          => $labels,
    'menu_icon'       => 'dashicons-calendar-alt'
  );
  register_post_type('event', $args);
}
add_action('init', 'rowebdev_cpts');


