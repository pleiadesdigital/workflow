<?php get_header(); ?>

<!-- PAGE BANNER -->
	<?php
	pageBanner(array(
		'photo'			=> get_theme_file_uri('/images/cover.jpg')
	));
	?>

<?php while (have_posts()) : the_post(); ?>

	<div class="container container--narrow page-section">

		<!-- BREADCRUMB -->
		<div class="metabox metabox--position-up metabox--with-home-link">
		  <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-university" aria-hidden="true"></i> &nbsp;All Campuses </a> <span class="metabox__main"><?php the_title(); ?></span></p>
		</div>

    <!-- CONTENT -->

    <?php the_content(); ?>

    <!-- GOOGLE MAP -->
    <div class="acf-map">
      <?php $mapLocation = get_field('map_location'); ?>
      <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
        <h4 class="headline headline--small "><?php the_title(); ?></h4>
        <p><?php echo $mapLocation['address']; ?></p>
      </div>
    </div>

	<?php
	/* RELATED PROGRAMS */
		$today = date('Ymd');
			$args = array(
				'posts_per_page'			=> -1,
				'post_type'						=> 'program',
				'orderby'							=> 'title',
				'order'								=> 'ASC',
				'meta_query'					=> array(
					array(
						'key'							=> 'related_campus',
						'compare'					=> 'LIKE',
						'value'						=> '"' . get_the_ID() . '"'
					)
				)
			);
			$related_programs = new WP_Query($args);
		?>

		<?php if ($related_programs->have_posts()) :  ?>
			<hr class="section-break">
			<h2 class="headline headline--medium">Programs available at <?php echo get_the_title(); ?></h2>
			<ul class="link-list min-list">
			<?php while($related_programs->have_posts()) : $related_programs->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
			<?php endwhile; ?>
			</ul>
		<?php endif; wp_reset_postdata(); ?>

	</div>

<?php endwhile; ?>

<?php get_footer(); ?>
