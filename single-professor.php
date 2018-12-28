<?php get_header(); ?>

	<!-- PAGE BANNER -->
	<?php
	pageBanner(array(
		'photo'			=> get_theme_file_uri('/images/cover.jpg')
	));
	?>

<?php while (have_posts()) : the_post(); ?>

	<div class="container container--narrow page-section">

		<!-- GENERIC CONTENT -->
		<div class="generic-content">

      <div class="row group">
        <div class="one-third">
        <!-- THE FEATURE IMAGE -->
          <?php the_post_thumbnail('professorPortrait'); ?>
        </div>

        <div class="two-thirds">
        <!-- GENERIC CONTENT -->
			    <?php the_content(); ?>
        </div>
      </div>

		</div>

		<!-- RELATED CONTENT -->
		<?php $relatedPrograms = get_field('related_programs'); ?>
		<?php if($relatedPrograms) : ?>

			<hr class="section-break">
			<h2 class="headline headline--medium">Subject(s) Taught</h2>
			<ul class="link-list min-list">

			<?php foreach ($relatedPrograms as $program) : ?>

				<li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>

			<?php endforeach; ?>
			</ul>

		<?php endif; ?>



	</div>

<?php endwhile; ?>



<?php get_footer(); ?>

