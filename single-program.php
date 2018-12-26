<?php get_header(); ?>

<!-- PAGE BANNER -->
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>)"></div>

  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <div class="page-banner__intro">
      <p>CHANGE LATER</p>
    </div>
  </div>
</div>

<?php while (have_posts()) : the_post(); ?>

	<div class="container container--narrow page-section">

		<!-- BREADCRUMB -->
		<div class="metabox metabox--position-up metabox--with-home-link">
		  <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-linode" aria-hidden="true"></i> &nbsp;All Programs </a> <span class="metabox__main"><?php the_title(); ?></span></p>
		</div>

		<!-- GENERIC CONTENT -->
		<div class="generic-content">
			<?php the_content(); ?>
		</div>

	<?php
	/* RELATED PROFESSORS */
		$today = date('Ymd');
			$args = array(
				'posts_per_page'			=> -1,
				'post_type'						=> 'professor',
				'orderby'							=> 'title',
				'order'								=> 'ASC',
				'meta_query'					=> array(
					array(
						'key'							=> 'related_programs',
						'compare'					=> 'LIKE',
						'value'						=> '"' . get_the_ID() . '"'
					)
				)
			);
			$related_professors = new WP_Query($args);
		?>

		<?php if ($related_professors->have_posts()) :  ?>
			<hr class="section-break">
			<h2 class="headline headline--medium"> <?php echo get_the_title(); ?> Professors</h2>
			<ul class="professor-cards">
			<?php while($related_professors->have_posts()) : $related_professors->the_post(); ?>
				<li class="professor-card__list-item">
					<a class="professor-card" href="<?php the_permalink(); ?>">
						<img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>" alt="<?php ?>">
						<span class="professor-card__name"><?php the_title(); ?></span>
					</a>
				</li>
			<?php endwhile; ?>
			</ul>

			<?php endif; wp_reset_postdata(); ?>

		<!-- RELATED CONTENT -->

		<?php
			$today = date('Ymd');
			$args = array(
				'posts_per_page'			=> -1,
				'post_type'						=> 'event',
				'meta_key'						=> 'event_date',
				'orderby'							=> 'meta_value_num',
				'order'								=> 'ASC',
				'meta_query'					=> array(
					array(
						'key'							=> 'event_date',
						'compare'					=> '>=',
						'value'						=> $today,
						'type'						=> 'numeric'
					),
					array(
						'key'							=> 'related_programs',
						'compare'					=> 'LIKE',
						'value'						=> '"' . get_the_ID() . '"'
					)
				)
			);
			$related_content = new WP_Query($args);
		?>

		<?php if ($related_content->have_posts()) :  ?>
			<hr class="section-break">
			<h2 class="headline headline--medium">Upcoming <?php echo get_the_title(); ?> Events</h2>
			<?php while($related_content->have_posts()) : $related_content->the_post(); ?>
				<div class="event-summary">
					<a href="<?php the_permalink(); ?>" class="event-summary__date t-center">
						<span class="event-summary__month">
						<?php $eventDate = new DateTime(get_field('event_date')); echo $eventDate->format('M'); ?>
						</span>
						<span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
					</a>
					<div class="event-summary__content">
						<h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<p>
						<?php if (has_excerpt()) { echo get_the_excerpt(); } else { echo wp_trim_words(get_the_content(), 22); } ?> &nbsp; <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>

						</p>
					</div>
				</div>
			<?php endwhile; endif; ?>



	</div>

<?php endwhile; ?>

<?php get_footer(); ?>
