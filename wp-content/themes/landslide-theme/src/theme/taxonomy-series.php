<?php $sermon_series = get_queried_object();

get_header(); ?>

<main role="main" id="main-content">

	<div class="page-section white-bg single-series">
		<div class="grid-container intro-section">
			<div class="grid-x grid-padding-x align-center">
				<div class="medium-10 large-8 cell">
					<h1><?php echo $sermon_series->name; ?></h1>
					<?php if( get_field('series_art', $sermon_series) ) { ?>
						<div class="single-series-image">
							<?php acf_image_tag( 'series_art', '100vw', 'large', FALSE, $sermon_series ); ?>
						</div>
					<?php } ?>
					<?php if( $sermon_series->description!='' ) { ?>
						<p class="single-series-description"><?php echo $sermon_series->description; ?></p>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="grid-container intro-section">
			<div class="grid-x grid-padding-x align-center">
				<div class="medium-10 large-8 cell">
					<h2>Sermons</h2>
				</div>
			</div>
		</div>
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="medium-10 large-8 cell">

					<ul class="sermon-list">
						<?php get_template_part('loop', 'sermon'); ?>
					</ul>

					<?php get_template_part('pagination'); ?>
				</div>
			</div>
		</div>
	</div>

</main>

<?php get_footer(); ?>