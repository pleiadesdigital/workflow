<?php get_header(); ?>

<!-- PAGE BANNER -->
<?php
  pageBanner(array(
    'title'         => 'Welcome to our Blog',
    'subtitle'      =>  'Keep up with our latest news',
    'photo'         => get_theme_file_uri('/images/cover.jpg')
  ));
?>


<div class="container container--narrow page-section">
  <?php while(have_posts()) : the_post(); ?>
  <div class="post-item">
    <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="metabox">
      <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.Y'); ?> in <?php echo get_the_category_list(', ') ?></p>
    </div>
    <div class="generic-content">
      <?php the_excerpt(); ?>
      <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading...</a></p>
    </div>
  </div>
  <?php endwhile; ?>
</div>

  <center>
    <?php
    echo paginate_links(array(
      'prev_text' => __('<< Previous'),
      'next_text' => __('Next >>'),
      'type' => 'plain'
    ));
    ?>
  </center>




<?php get_footer(); ?>

