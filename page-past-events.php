<?php get_header(); ?>
<!-- PAGE BANNER -->
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>)"></div>

  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">Past events</h1>
    <div class="page-banner__intro">
      <p>A recap of our past events.</p>
    </div>
  </div>
</div>

<div class="container container--narrow page-section">
  <?php
    $today = date('Ymd');
    $args = array(
      'paged'            => get_query_var('paged', 1),
      'posts_per_page'   => 3,
      'post_type'        => 'event',
      'meta_key'         => 'event_date',
      'orderby'          => 'meta_value_num',
      'order'            => 'ASC',
      'meta_query'       => array(
        array(
          'key'          => 'event_date',
          'compare'      => '<',
          'value'        => $today,
          'type'         => 'numeric'
        )
      )
    );
    $pastEvents = new WP_Query($args);
  ?>
  <?php while ($pastEvents->have_posts()) : $pastEvents->the_post(); ?>
  <div class="event-summary">
    <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
    <?php $eventDate = new DateTime(get_field('event_date')); ?>
      <span class="event-summary__month"><?php echo $eventDate->format('M'); ?></span>
      <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
    </a>
    <div class="event-summary__content">
      <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
      <p><?php echo wp_trim_words(get_the_content(), 22); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
    </div>
  </div>


  <?php endwhile; ?>
</div>

  <center>
    <?php
      echo paginate_links(array(
        'total'       => $pastEvents->max_num_pages
      ));
    ?>
  </center>




<?php get_footer(); ?>
