<?php

/* THEME FILES */
function rowebdev_files() {

  /* GOOGLE FONTS */
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Rajdhani:400,500,600|Raleway:300,400,500');

  /* FONT-AWESOME */
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  /* MAIN STYLES */
  wp_enqueue_style( 'main-styles', get_stylesheet_uri(), NULL, microtime());

 /* GOOGLE API SCRIPT */
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyBLKfRg72Dz_juZhVky8cAj_sggF-2Lb08', NULL, microtime(), true);

  /* MAIN SCRIPTS */
  wp_enqueue_script('main-scripts', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);

  /* Allow Dynamic Flexible Communication between PHP and JavaScript */
  wp_localize_script('main-scripts', 'jsData', array(
    'root_url'      => get_site_url()
  ));


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

/* PAGE BANNER FUNCTION */
function pageBanner($args = NULL) {
  if (!$args['title']) {
    $args['title'] = get_the_title();
  }
  if (!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }
  if (!$args['photo']) {
    if (get_field('page_banner_background_image')) {
      $pageBannerImage = get_field('page_banner_background_image');
      $args['photo'] = $pageBannerImage['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>
<?php }

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

  /* CAMPUS POST TYPE */
  $labels = array(
    'name'            => 'Campuses',
    'add_new_item'    => 'Add New Campus',
    'edit_item'       => 'Edit Campus',
    'all_items'       => 'All Campuses',
    'singular_name'   => 'Campus'
  );
  $args = array(
    'supports'        => array('title', 'editor', 'excerpt'),
    'rewrite'         => array('slug' => 'campuses'),
    'has_archive'     => true,
    'public'          => true,
    'labels'          => $labels,
    'menu_icon'       => 'dashicons-building'
  );
  register_post_type('campus', $args);


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
  // Manipulating CAMPUSES
  if (!is_admin() && is_post_type_archive('campus') && $query->is_main_query()) {
    $query->set('posts_per_page', -1);
  }

}
add_action('pre_get_posts', 'rowebdev_adjust_queries');

/* GOOGLE APIS  */

function rowebdevMapKey($api) {
  $api['key'] = 'AIzaSyBLKfRg72Dz_juZhVky8cAj_sggF-2Lb08';
  return $api;
}
add_filter('acf/fields/google_map/api', 'rowebdevMapKey');



