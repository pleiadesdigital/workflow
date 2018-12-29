<?php get_header(); ?>
<!-- PAGE BANNER -->
<?php
  pageBanner(array(
    'title'         => 'All Campuses',
    'subtitle'      =>  'Check out our different locations',
    'photo'         => get_theme_file_uri('/images/cover.jpg')
  ));
?>

<div class="container container--narrow page-section">

  <div class="acf-map">

  <?php while (have_posts()) : the_post(); ?>

    <?php $mapLocation = get_field('map_location'); ?>
    <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">

      <h3 class="headline headline--small "><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <p><?php echo $mapLocation['address']; ?></p>
    </div>

  <?php endwhile; ?>

  </div>

</div>


<?php get_footer(); ?>

