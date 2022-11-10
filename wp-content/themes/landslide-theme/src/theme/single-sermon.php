<?php $series = get_the_terms( $post->ID, 'series' );
$speakers = get_the_terms( $post->ID, 'speaker' );

get_header(); ?>

<main role="main" id="main-content">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<section class="page-section white-bg">
			<div class="grid-container">
				<div class="grid-x grid-padding-x align-center">
					<div class="large-10 cell">

						<h1 class="single-sermon-title"><?php the_title(); ?></h1>
						
						<?php if( get_field('video_embed') ) { ?>
							<div class="single-sermon-video">
								<?php $iframe = get_field('video_embed');
						
								// Use preg_match to find iframe src.
								preg_match('/src="(.+?)"/', $iframe, $matches);
								$src = $matches[1];

								// Add extra parameters to src and replace HTML.
								$params = array(
								    'modestbranding' => 1,
								    'rel'  => 0
								);
								$new_src = add_query_arg($params, $src);
								$iframe = str_replace($src, $new_src, $iframe);
								
								echo $iframe; ?>
							</div>
						<?php } else if( has_post_thumbnail() ) {  ?>
							<div class="single-sermon-image">
								<?php the_post_thumbnail('medium'); ?>
							</div>
						<?php } else if( get_field('series_art', $series[0]) ) { ?>
							<div class="single-sermon-image">
								<?php acf_image_tag( 'series_art', '100vw', 'medium', FALSE, $series[0] ); ?>
							</div>
						<?php } ?>

						<p class="single-sermon-date"><?php the_field('sermon_date'); ?></p>

						<?php if( get_field('scripture') ) { ?>
							<p class="single-sermon-scripture"><?php the_field('scripture'); ?></p>
						<?php } ?>

						<?php if( $speakers ) { ?>
							<p class="single-sermon-speaker">
								<?php $speaker_counter = 1;
								foreach($speakers as $speaker ) {
									echo '<a href="'.get_post_type_archive_link('sermon').'?speaker='.$speaker->slug.'">'.$speaker->name.'</a>';
									if( $speaker_counter>1 ) {
										echo ", ";
									}
									$speaker_counter++;
								} ?>
							</p>
						<?php } ?>

						<?php if( $series ) { ?>
							<p class="single-sermon-series">From the series <a href="<?php echo get_term_link($series[0]); ?>"><?php echo $series[0]->name; ?></a></p>
						<?php } ?>

						<?php if( get_field('audio_url') ) { ?>
							<div class="single-sermon-audio">
								<?php echo do_shortcode('[audio src="'.get_field('audio_url').'"]'); ?>
								<p><a href="<?php the_field('audio_url'); ?>" class="sermon-audio-download" download><i class="icon-download"></i> <span>Download sermon audio</span></a></p>
							</div>
						<?php } ?>

						<div class="single-sermon-description">
							<?php the_content(); ?>
						</div>
						
					</div>
				</div>
			</div>
		</section>

	<?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
