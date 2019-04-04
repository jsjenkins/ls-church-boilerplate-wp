<?php 
// Display functions

function thumbnail_image_array() {

	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$image['full'] = wp_get_attachment_image_src( $thumb_id, 'full', FALSE );
		$image['full'] = $image['full'][0];
		$image['large'] = wp_get_attachment_image_src( $thumb_id, 'large', FALSE );
		$image['large'] = $image['large'][0];
		$image['medium'] = wp_get_attachment_image_src( $thumb_id, 'medium', FALSE );
		$image['medium'] = $image['medium'][0];
		$image['small'] = wp_get_attachment_image_src( $thumb_id, 'small', FALSE );
		$image['small'] = $image['small'][0];
		$image['square'] = wp_get_attachment_image_src( $thumb_id, 'square', FALSE );
		$image['square'] = $image['square'][0];
		$image['small-square'] = wp_get_attachment_image_src( $thumb_id, 'small-square', FALSE );
		$image['small-square'] = $image['small-square'][0];
	} else {
		return FALSE;
	}

	return $image;
}

function acf_image_array( $variable_name, $sub=FALSE, $options='' ) {

	if( $sub ) {
		$variable_image = get_sub_field($variable_name);
	} else {
		$variable_image = get_field($variable_name, $options);
	}

	if( $variable_image ) {
		$image['full'] = $variable_image['url'];
		$image['large'] = $variable_image['sizes']['large'];
		$image['medium'] = $variable_image['sizes']['medium'];
		$image['small'] = $variable_image['sizes']['small'];
		$image['square'] = $variable_image['sizes']['square'];
		$image['small-square'] = $variable_image['sizes']['small-square'];
	} else {
		return FALSE;
	}

	return $image;
}

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