<?php get_header(); ?>
<!-- PAGE BANNER -->
<?php
  pageBanner(array(
    'title'         => 'All Events',
    'subtitle'      =>  'See what is going on in our world',
    'photo'         => get_theme_file_uri('/images/cover.jpg')
  ));
?>

<div class="container container--narrow page-section">
  <?php while (have_posts()) : the_post(); ?>

  <?php get_template_part('template-parts/content', 'event'); ?>

    <?php endwhile; ?>

    <center>
      <?php
      echo paginate_links(array(
        'prev_text' => __('<< Previous'),
        'next_text' => __('Next >>'),
        'type' => 'plain'
      ));
      ?>
    </center>
    <hr class="section-event">
    <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events'); ?>"</a>Check out our events archive.</a></p>

  </div>


<?php get_footer(); ?>

