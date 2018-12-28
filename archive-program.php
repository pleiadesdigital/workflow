<?php get_header(); ?>
<!-- PAGE BANNER -->
<?php
  pageBanner(array(
    'title'         => 'All Programs',
    'subtitle'      =>  'There is something for everyone!',
    'photo'         => get_theme_file_uri('/images/cover.jpg')
  ));
?>

<div class="container container--narrow page-section">
  <ul class="link-list min-list">


  <?php while (have_posts()) : the_post(); ?>

    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

  <?php endwhile; ?>

  </ul>
</div>


<?php get_footer(); ?>

