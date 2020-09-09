<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<main role="main" aria-label="Content">
		<?php if($post->post_content != '') { ?>
			<div class="page-section transparent-bg">
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-center">
						<div class="large-9 cell">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php get_template_part('partials/page', 'builder'); ?>
	</main>

<?php endwhile; ?>
<?php else: ?>

	<?php get_template_part('partials/error', 'missing'); ?>

<?php endif; ?>

<?php get_footer(); ?>