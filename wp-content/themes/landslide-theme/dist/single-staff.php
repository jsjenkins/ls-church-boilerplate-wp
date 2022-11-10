<?php get_header(); ?>

<main role="main" id="main-content">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<section class="page-section white-bg single-staff">
			<div class="grid-container">
				<div class="grid-x grid-padding-x align-center">
					<div class="medium-10 large-8 cell">

						<h1 class="single-staff-title"><?php the_title(); ?></h1>

						<?php if( get_field('position') ) { ?>
							<h3 class="single-staff-position"><?php the_field('position'); ?></h3>
						<?php } ?>

						<?php if ( has_post_thumbnail()) : ?>
							<div class="single-staff-headshot">
								<?php the_post_thumbnail('small-sqaure'); ?>
							</div>
						<?php endif; ?>

						<?php if( get_field('email_address') ) { ?>
							<p class="single-staff-email"><a href="mailto:<?php echo antispambot(get_field('email_address')); ?>"><?php echo antispambot(get_field('email_address')); ?></a></p>
						<?php } ?>

						<?php if( get_field('phone_number') ) { ?>
							<p class="single-staff-phone"><a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a></p>
						<?php } ?>

						<?php the_content(); ?>

						<a href="<?php echo get_post_type_archive_link('staff'); ?>">Back to all Staff</a>
						
					</div>
				</div>
			</div>
		</section>

	<?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
