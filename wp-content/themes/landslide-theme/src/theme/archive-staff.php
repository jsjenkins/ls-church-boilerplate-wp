<?php $current_page = get_page_by_path('staff');

get_header(); ?>

<main role="main" id="main-content">
	<?php $post = $current_page;
	setup_postdata($post); 
	if( $post ) {
		get_template_part('partials/page', 'header');
	}
	wp_reset_postdata(); ?>

	<div class="page-section staff-list white-bg" id="staff-list">
		<div class="grid-container intro-section">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell">
					<p class="staff-filter-label">Filter Staff</p>
					<form id="staff-filter" method="get" action="#staff-list">
						<?php $current_department = get_query_var( 'department' );
						$departments = get_terms( array( 'taxonomy' => 'department') );
						if( $departments ) { ?>
							<div class="select-container">
								<select name="department">
									<option value="">All Departments</option>
									<?php foreach( $departments as $department ) { ?>
										<option value="<?php echo $department->slug; ?>" <?php if($department->slug==$current_department) { echo 'selected'; } ?>><?php echo $department->name; ?></option>
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
			<div class="grid-x grid-padding-x">
				<?php get_template_part('loop', 'staff'); ?>
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