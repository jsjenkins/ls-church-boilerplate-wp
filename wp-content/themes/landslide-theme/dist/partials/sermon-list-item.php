<?php // Post List Item 
$series = get_the_terms( $post->ID, 'series' );
$speakers = get_the_terms( $post->ID, 'speaker' ); ?>

<li>
	<a href="<?php the_permalink(); ?>" class="sermon-list-item">

		<?php if( has_post_thumbnail() ) {  ?>
			<div class="sermon-list-image">
				<?php the_post_thumbnail('medium'); ?>
			</div>
		<?php } else if( $series && get_field('series_art', $series[0]) ) { ?>
			<div class="sermon-list-image">
				<?php acf_image_tag( 'series_art', '100vw', 'medium', FALSE, $series[0] ); ?>
			</div>
		<?php } ?>

		<h3 class="sermon-list-title"><?php the_title(); ?></h3>

		<div class="sermon-list-date"><?php the_field('sermon_date'); ?></div>

		<?php if( $series ) { ?>
			<p class="sermon-list-series"><?php echo $series[0]->name; ?></p>
		<?php } ?>

		<?php if( $speakers ) { ?>
			<p class="sermon-list-speaker">
				<?php $speaker_counter = 1;
				foreach($speakers as $speaker ) {
					echo $speaker->name;
					if( $speaker_counter>1 ) {
						echo ", ";
					}
					$speaker_counter++;
				} ?>
			</p>
		<?php } ?>

	</a>
</li>
