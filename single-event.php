<?php get_header(); ?>

<!-- PAGE BANNER -->
<?php
  pageBanner();
?>


<?php while (have_posts()) : the_post(); ?>

	<div class="container container--narrow page-section">
		<div class="metabox metabox--position-up metabox--with-home-link">
		  <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;All Events </a> <span class="metabox__main"><?php the_title(); ?></span></p>
		</div>

		<!-- GENERIC CONTENT -->
		<div class="generic-content">
			<?php the_content(); ?>
		</div>



		<!-- RELATED CONTENT -->
		<?php $relatedPrograms = get_field('related_programs'); ?>
		<?php if($relatedPrograms) : ?>

			<hr class="section-break">
			<h2 class="headline headline--medium">Related Programs</h2>
			<ul class="link-list min-list">

			<?php foreach ($relatedPrograms as $program) : ?>

				<li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>

			<?php endforeach; ?>
			</ul>

		<?php endif; ?>



	</div>

<?php endwhile; ?>



<?php get_footer(); ?>
