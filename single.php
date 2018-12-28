<?php get_header(); ?>

<!-- PAGE BANNER -->
	<?php
	pageBanner(array(
		'photo'			=> get_theme_file_uri('/images/cover.jpg')
	));
	?>

<?php while (have_posts()) : the_post(); ?>

	<div class="container container--narrow page-section">
		<div class="metabox metabox--position-up metabox--with-home-link">
		  <p><a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home </a> <span class="metabox__main"> Posted by <?php the_author_posts_link(); ?> on <?php the_time('M j, Y'); ?> in <?php echo get_the_category_list(', '); ?></span></p>
		</div>

		<!-- GENERIC CONTENT -->
		<div class="generic-content">
			<?php the_content(); ?>
		</div>

	</div>

<?php endwhile; ?>



<?php get_footer(); ?>
