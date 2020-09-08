<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="page-section transparent-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="medium-8 cell">
					<h1><?php _e( 'Archives', 'html5blank' ); ?></h1>
					<?php get_template_part('loop'); ?>
					<?php get_template_part('pagination'); ?>
				</div>
				<div class="medium-4 cell">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>