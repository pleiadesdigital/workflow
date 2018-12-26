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
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
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


  /* PROGRAMS POST TYPE */
  $labels = array(
    'name'            => 'Programs',
    'add_new_item'    => 'Add New Program',
    'edit_item'       => 'Edit Program',
    'all_items'       => 'All Programs',
    'singular_name'   => 'Program'
  );
  $args = array(
    'supports'        => array('title', 'editor'),
    'rewrite'         => array('slug' => 'programs'),
    'has_archive'     => true,
    'public'          => true,
    'labels'          => $labels,
    'menu_icon'       => 'dashicons-awards'
  );
  register_post_type('program', $args);

  /* PROFESSOR POST TYPE */
  $labels = array(
    'name'            => 'Professor',
    'add_new_item'    => 'Add New Professor',
    'edit_item'       => 'Edit Professor',
    'all_items'       => 'All Professors',
    'singular_name'   => 'Professor'
  );
  $args = array(
    'supports'        => array('title', 'editor', 'thumbnail'),
    'has_archive'     => false,
    'public'          => true,
    'labels'          => $labels,
    'menu_icon'       => 'dashicons-admin-users'
  );
  register_post_type('professor', $args);



}
add_action('init', 'rowebdev_cpts');


/* CUSTOMIZING DEFAULT QUERY BEHAVIOR */

function rowebdev_adjust_queries($query) {
  $today = date('Ymd');
  // Manipulating EVENTS
  if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(array(
      'key' => 'event_date',
      'compare'   => '>=',
      'value'     => $today,
      'type'      => 'numeric'
    )));
  }
  // Manipulating PROGRAMS
  if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }


}

add_action('pre_get_posts', 'rowebdev_adjust_queries');

