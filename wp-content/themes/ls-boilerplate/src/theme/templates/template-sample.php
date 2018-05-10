<?php /* Template Name: Sample Template */ get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<main role="main" aria-label="Content">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="large-9 cell">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</main>

<?php endwhile; ?>
<?php else: ?>

	<?php get_template_part('partials/error', 'missing'); ?>

<?php endif; ?>

<?php get_footer(); ?>
