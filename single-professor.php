<?php get_header(); ?>

<!-- PAGE BANNER -->
<div class="page-banner">
	<?php $pageBannerImage = get_field('page_banner_background_image'); ?>
  <div class="page-banner__bg-image" style="background-image: url(<?php echo $pageBannerImage['sizes']['pageBanner']; ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <div class="page-banner__intro">
      <p><?php the_field('page_banner_subtitle'); ?></p>
    </div>
  </div>
</div>

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

