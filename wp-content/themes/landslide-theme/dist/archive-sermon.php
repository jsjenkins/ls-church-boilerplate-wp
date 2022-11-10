<?php $current_page = get_page_by_path('sermons');

get_header(); ?>

<main role="main" id="main-content">
	<?php $post = $current_page;
	setup_postdata($post); 
	if( $post ) {
		get_template_part('partials/page', 'header');
	}
	wp_reset_postdata(); ?>

	<div class="page-section white-bg" id="sermon-list">
		<div class="grid-container intro-section sermon-filter">
			<div class="grid-x grid-padding-x align-center">
				<div class="medium-10 large-8 cell">
					<p class="sermon-filter-label">Filter Sermons</p>
					<form id="sermon-filter" method="get" action="#sermon-list">
						<?php $current_speaker = get_query_var( 'speaker' );
						$speakers = get_terms( array( 'taxonomy' => 'speaker') );
						if( $speakers ) { ?>
							<div class="select-container">
								<select name="speaker">
									<option value="">All Speakers</option>
									<?php foreach( $speakers as $speaker ) { ?>
										<option value="<?php echo $speaker->slug; ?>" <?php if($speaker->slug==$current_speaker) { echo 'selected'; } ?>><?php echo $speaker->name; ?></option>
									<?php } ?>
								</select>
							</div>
						<?php } ?>

						<input type="submit" class="button hollow" value="Go">
					</form>
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

	<?php $post = $current_page;
	setup_postdata($post); 
	if( $post ) {
		get_template_part('partials/page', 'builder');
	}
	wp_reset_postdata(); ?>
</main>

<?php get_footer(); ?>