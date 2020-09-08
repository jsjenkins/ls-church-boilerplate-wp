<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="page-section transparent-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="medium-8 cell">

					<?php if (have_posts()): the_post(); ?>
						<h1><?php _e( 'Posts by ', 'html5blank' ); echo get_the_author(); ?></h1>
						
						<?php if ( get_the_author_meta('description')) :

							echo get_avatar(get_the_author_meta('user_email')); ?>
							<h2><?php _e( 'About ', 'html5blank' ); echo get_the_author() ; ?></h2>

						<?php echo wpautop( get_the_author_meta('description') );
					endif; ?>

					<?php rewind_posts(); while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php if ( has_post_thumbnail()) : ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('small'); ?>
								</a>
							<?php endif; ?>

							<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							<span class="date">
								<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
									<?php the_date(); ?> <?php the_time(); ?>
								</time>
							</span>
							<span class="author"><?php the_author_posts_link(); ?></span>

							<?php ls_boilerplate_excerpt('ls_excerpt_index'); ?>

						</article>

					<?php endwhile; ?>

					<?php else: ?>

						<?php get_template_part('partials/error', 'missing'); ?>

					<?php endif; ?>

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
