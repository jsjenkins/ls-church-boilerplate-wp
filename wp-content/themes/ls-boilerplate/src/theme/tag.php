<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="row">
		<div class="medium-8 columns">
			<h1><?php _e( 'Posts Tagged ', 'html5blank' ); echo single_tag_title('', false); ?></h1>
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
		</div>
		<div class="medium-4 columns">
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>