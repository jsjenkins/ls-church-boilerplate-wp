<?php // Display functions

// Get single featured image size URL
function thumbnail_image_single( $size='medium' ) {
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$image = wp_get_attachment_image_src( $thumb_id, $size, FALSE );
		$image = $image[0];
	} else {
		return FALSE;
	}

	return $image;
}

// Get featured image alt tag
function thumbnail_alt() {
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', TRUE);
	} else {
		return FALSE;
	}

	return $alt;
}

// Get full array of featured image URLs
function thumbnail_image_array() {
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$image['alt'] = get_post_meta($thumb_id, '_wp_attachment_image_alt', TRUE);
		$image['full'] = wp_get_attachment_image_src( $thumb_id, 'full', FALSE );
		$image['full'] = $image['full'][0];
		$all_sizes = get_intermediate_image_sizes();
		foreach( $all_sizes as $size ) {
			$image[$size] = wp_get_attachment_image_src( $thumb_id, $size, FALSE );
			$image[$size] = $image[$size][0];
		}
	} else {
		return FALSE;
	}

	return $image;
}

// Get single acf image size URL
function acf_image_single( $variable_name, $size='medium', $sub=FALSE, $options='' ) {
	if( $sub ) {
		$variable_image = get_sub_field($variable_name);
	} else {
		$variable_image = get_field($variable_name, $options);
	}

	if( $variable_image ) {
		if( $size =='full' ) {
			$image = $variable_image['url'];
		} else {
			$image = $variable_image['sizes'][$size];
		}
	} else {
		return FALSE;
	}

	return $image;
}

// Get full array of ACF image URLs
function acf_image_array( $variable_name, $sub=FALSE, $options='' ) {
	if( $sub ) {
		$variable_image = get_sub_field($variable_name);
	} else {
		$variable_image = get_field($variable_name, $options);
	}

	if( $variable_image ) {
		$image['alt'] = $variable_image['alt'];
		$image['full'] = $variable_image['url'];
		$all_sizes = get_intermediate_image_sizes();
		foreach( $all_sizes as $size ) {
			$image[$size] = $variable_image['sizes'][$size];
		}
	} else {
		return FALSE;
	}

	return $image;
}

// Get link from link
function link_from_link( $variable_name, $sub=FALSE, $options='', $class='' ) {

	if( $sub ) {
		$link = get_sub_field($variable_name);
	} else {
		$link = get_field($variable_name, $options);
	}

	if( $link ) { 
		echo '<a href="'.$link['url'].'" class="'.$class.'" target="'.$link['target'].'">'.$link['title'].'</a>';
	} else {
		return FALSE;
	}

	return TRUE;
}

// Get button from link
function button_from_link( $variable_name, $sub=FALSE, $options='', $class=''  ) {

	if( $sub ) {
		$link = get_sub_field($variable_name);
	} else {
		$link = get_field($variable_name, $options);
	}

	if( $link ) {
		echo '<a class="button'.$class.'" href="'.$link['url'].'" target="'.$link['target'].'">'.$link['title'].'</a>';
	} else {
		return FALSE;
	}

	return TRUE;
}