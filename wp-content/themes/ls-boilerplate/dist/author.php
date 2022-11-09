<?php get_header(); ?>

<main role="main" id="main-content">
	<div class="page-section white-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="medium-10 large-8 cell">

					<?php if( have_posts() ) {
						the_post(); ?>
						
						<h1>Posts by <?php echo get_the_author(); ?></h1>
						
						<?php if( get_the_author_meta('description') ) {
							// Author Gravatar
							echo get_avatar(get_the_author_meta('user_email')); ?>

							<h2>About <?php echo get_the_author() ; ?></h2>

							<?php // Author Description
							echo wpautop( get_the_author_meta('description') );
						}

						rewind_posts(); 

						// Posts from Author
						while (have_posts()) : the_post();
							get_template_part('partials/post', 'list-item');
						endwhile;

						get_template_part('pagination');

					} else {
						get_template_part('partials/error', 'missing');
					} ?>

				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
