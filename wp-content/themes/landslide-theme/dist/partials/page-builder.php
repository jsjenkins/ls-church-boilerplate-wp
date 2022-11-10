<?php 
$page_section_counter = 1;

if( have_rows('page_builder') ):
	$section_header = '';
	while( have_rows('page_builder') ) : the_row();
		
		// One Column
		if( get_row_layout() == 'one_column' ):
			$background_color = get_sub_field('background_color');
			$large_width = get_sub_field('width'); 
			if( $large_width>10 ) {
				$medium_width = 12;
				$small_width = 12;
			} else if( $large_width>8 ) {
				$medium_width = 11;
				$small_width = 12;
			} else {
				$medium_width = 10;
				$small_width = 11;
			}
			if( get_sub_field('intro') ) {
				$section_header = '<div class="grid-container intro-section">
					<div class="grid-x grid-margin-x align-center">
						<div class="small-'.$small_width.' medium-'.$medium_width.' large-'.$large_width.' cell">'.
							get_sub_field('copy').
						'</div>
					</div>
				</div>';
			} else { ?>
				<section class="page-section <?php echo $background_color; ?>-bg one-column">
					<div class="grid-container">
						<div class="grid-x grid-padding-x align-center">
							<div class="small-<?php echo $small_width; ?> medium-<?php echo $medium_width; ?> large-<?php echo $large_width; ?> cell">
								<?php the_sub_field('copy'); ?>
							</div>
						</div>
					</div>
				</section>
			<?php } ?>

		<?php // Two Column
		elseif( get_row_layout() == 'two_column' ):
			$background_color = get_sub_field('background_color');
			$col_1 = get_sub_field('column_1');
			$col_2 = get_sub_field('column_2');

			// Calculate column widths
			$col_1_width = $col_1['width'];
			$col_1_small = 12;
			$col_1_medium = $col_1_width;
			$col_1_large = $col_1_width;
			if( $col_1_width<4 ) {
				$col_1_medium = 4;
				$col_1_small = 6;
			} else if( $col_1_width>8 ) {
				$col_1_medium=8;
			}

			$col_2_width = $col_2['width'];
			$col_2_small = 12;
			$col_2_medium = 12-$col_1_medium;
			$col_2_large = $col_2_width;
			if( ($col_1_width==6 & $col_2_width==4) || ($col_1_width==7 & $col_2_width==4) ) {
				$col_1_medium = 7;
				$col_2_medium = 5;
			} else if( ($col_1_width==4 & $col_2_width==6) || ($col_1_width==4 & $col_2_width==7) ) {
				$col_1_medium = 5;
				$col_2_medium = 7;
			} else if( ($col_1_width==5 & $col_2_width==5) || ($col_1_width==6 & $col_2_width==5) || ($col_1_width==5 & $col_2_width==6) ) {
				$col_1_medium = 6;
				$col_2_medium = 6;
			} ?>

			<section class="page-section <?php echo $background_color; ?>-bg two-column">
				<?php if($section_header!='') {
					echo $section_header;
					$section_header='';
				} ?>
				<div class="grid-container">
					<div class="grid-x grid-padding-x two-column-content align-center <?php if( get_sub_field('vertical_alignment') ) { ?>vertical-center<?php } ?> <?php if( get_sub_field('mobile_order') ) { ?>reverse-mobile<?php } ?>">
						<div class="small-<?php echo $col_1_small; ?> medium-<?php echo $col_1_medium; ?> large-<?php echo $col_1_large; ?> cell">
							<?php $image = $col_1['image'];
							if($image) {
								$image['medium'] = $image['sizes']['medium']; ?>
								<img src="<?php echo $image['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php }
							echo $col_1['copy']; ?>
						</div>
						<div class="small-<?php echo $col_2_small; ?> medium-<?php echo $col_2_medium; ?> large-<?php echo $col_2_large; ?> cell">
							<?php $image = $col_2['image'];
							if($image) {
								$image['medium'] = $image['sizes']['medium']; ?>
								<img src="<?php echo $image['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php }
							echo $col_2['copy']; ?>
						</div>
					</div>
				</div>
			</section>

		<?php // Content Blocks
		elseif( get_row_layout() == 'content_blocks' ):
			$background_color = get_sub_field('background_color');
			$layout = get_sub_field('layout'); 
			$columns = get_sub_field('blocks_per_row');
			if( $columns == 2 ) {
				$block_grid = 'medium-up-2';
			} else if( $columns == 3 ) {
				$block_grid = 'medium-up-3';
			} else if( $columns == 4 ) {
				$block_grid = 'medium-up-2 large-up-4';
			}
			if( have_rows('blocks') ): ?>
				<section class="page-section <?php echo $background_color; ?>-bg content-blocks <?php echo $columns; ?>-column">
					<?php if($section_header!='') {
						echo $section_header;
						$section_header='';
					} ?>
					<div class="grid-container content-blocks-container">
						<div class="grid-x grid-padding-x <?php echo $block_grid; ?>">
							
							<?php while ( have_rows('blocks') ) : the_row(); ?>
								<div class="cell">
									<?php $image = get_sub_field('image');
									if( $layout == 'images' && $image ) { ?>
										<div class="content-blocks-image">
											<?php acf_image_tag( 'image', '(max-width: 640px) 100vw, 50vw', 'large', TRUE ); ?>
										</div>
									<?php } else if( $layout == 'images-circle' && $image ) { ?>
										<div class="content-blocks-image circle">
											<?php acf_image_tag( 'image', '(max-width: 1024px) 225px, 300px', 'small-square', TRUE ); ?>
										</div>
									<?php } else if( $layout == 'icons' && $image ) { 
											$image = acf_image_single( 'image', 'thumbnail', TRUE ); ?>
											<div class="content-blocks-image icon">
												<img src="<?php echo $image; ?>" alt="" />
											</div>
									<?php } ?>
									<?php the_sub_field('copy'); ?>
								</div>
							<?php endwhile; ?>

						</div>
					</div>
				</section>
			<?php endif; ?>

		<?php // Expandable Content
		elseif( get_row_layout() == 'expandable_content' ): 
			$background_color = get_sub_field('background_color'); ?>
			<section class="page-section <?php echo $background_color; ?>-bg expandable-content">
				<?php if($section_header!='') {
					echo $section_header;
					$section_header='';
				} ?>
				<?php if( have_rows('content') ): ?>
					<div class="grid-container">
						<div class="grid-x grid-padding-x align-center">
							<div class="cell medium-10 large-8">
								<ul class="accordion" data-accordion data-allow-all-closed="true" data-multi-expand="true">
									<?php $item_counter = 1;
									while ( have_rows('content') ) : the_row(); ?>
										<li class="accordion-item" data-accordion-item>
											<a href="#" class="accordion-title">
												<h4><?php the_sub_field('label'); ?></h4>
											</a>

											<div class="accordion-content" data-tab-content>
												<?php the_sub_field('copy'); ?>
											</div>
										</li>
										<?php $item_counter++; 
									endwhile; ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</section>

		<?php // Image Overlay
		elseif( get_row_layout() == 'image_overlay' ):
			$image = acf_image_array( 'background_image', TRUE );
			$image_bg = 'data-interchange="['. $image['medium'] .', small], ['. $image['x-large'] .', medium], ['. $image['1536x1536'] .', large], ['. $image['full'] .', xlarge]" alt="'.$image['alt'].'"';
			$content_position = get_sub_field('copy_side'); ?>
			<section class="page-section image-overlay">
				<div class="image-bg" <?php echo $image_bg; ?>></div>
				<div class="grid-container">
					<div class="grid-x grid-margin-x <?php echo $content_position; ?>">
						<div class="cell medium-6 large-5">
							<?php the_sub_field('copy'); ?>
						</div>
					</div>
				</div>
			</section>

		<?php // CTA
		elseif( get_row_layout() == 'cta' ): 
			$background_color = get_sub_field('cta_background_color'); ?>
			<section class="page-section cta">
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-center">
						<div class="large-10 cell">
							<div class="cta-container <?php echo $background_color; ?>-bg">
								<div class="cta-copy">
									<?php the_sub_field('copy'); ?>
								</div>
								<div class="cta-button">
									<?php button_from_link( 'button', TRUE, '', ' hollow'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		
		<?php /* // Page Specific Content (Needs to be added to custom fields)
		elseif( get_row_layout() == 'page_specific_content' ):
			if( is_page_template( 'templates/template-sample.php' ) ) {
				get_template_part('partials/page', 'sample');
			} */ ?>

		<?php else: ?>
			<section class="page-section">
				<div class="grid-container">
					<div class="grid-x grid-padding-x">
						<div class="cell">
							<h2>This section type does not exist.</h2>
						</div>
					</div>
				</div>
			</section>

		<?php endif;
		$page_section_counter++;
	endwhile;
endif;