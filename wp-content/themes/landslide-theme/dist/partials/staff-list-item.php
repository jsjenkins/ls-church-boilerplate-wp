<?php // Staff List Item ?>

<div class="cell" >
	<?php if($post->post_content != '') { ?>
		<a href="<?php the_permalink(); ?>" class="staff-list-item">
	<?php } else { ?>
		<div class="staff-list-item">
	<?php } ?>

		<?php if( has_post_thumbnail() ) {  ?>
			<?php the_post_thumbnail('small-square'); ?>
		<?php } ?>

		<h4 class="staff-list-name"><?php the_title(); ?></h4>
		
		<?php if( get_field('position') ) { ?>
			<p class="staff-list-position"><?php the_field('position'); ?></p>
		<?php } ?>

	<?php if($post->post_content != '') { ?>
		</a>
	<?php } else { ?>
		</div>
	<?php } ?>
</div>
