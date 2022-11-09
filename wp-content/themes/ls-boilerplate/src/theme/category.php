<?php get_header(); ?>

<main role="main" id="main-content">
	<div class="page-section white-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="medium-10 large-8 cell">
					<h1>Posts About <?php single_cat_title(); ?></h1>
					<?php get_template_part('loop'); ?>
					<?php get_template_part('pagination'); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
