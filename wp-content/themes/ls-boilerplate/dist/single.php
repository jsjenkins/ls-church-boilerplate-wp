<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="page-section transparent-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="medium-8 cell">

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<h1><?php the_title(); ?></h1>

							<?php if ( has_post_thumbnail()) :
								the_post_thumbnail('large');
							endif; ?>

							<span class="date">
								<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
									<?php the_date(); ?> <?php the_time(); ?>
								</time>
							</span>
							<span class="author"><?php the_author_posts_link(); ?></span>

							<?php the_content(); ?>

							<p>Tags <?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', ''); ?></p>

							<p>Categories: <?php the_category(', '); ?></p>

							<?php edit_post_link(); ?>

							<?php // comments_template(); ?>

						</article>

					<?php endwhile; ?>

					<?php else: ?>

						<?php get_template_part('partials/error', 'missing'); ?>

					<?php endif; ?>

				</div>
				<div class="medium-4 cell">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
