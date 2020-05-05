<?php
/**
 * Neomorphic sanitizer
 *
 * @package neomorphic
 */

/**
 * Checkbox
 */
function neomorphic_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === $checked ) ? true : false;
}

/**
 * Select (Color skin)
 */
function neomorphic_sanitize_choices_color_skin( $select ) {
	$valid = array_keys( NEOMORPHIC_COLOR_SKIN );

	if ( in_array( $select, $valid, true ) ) {
		return $select;
	}

	return 'default';
}

/**
 * Select (Sidebar)
 */
function neomorphic_sanitize_choices_sidebar( $select ) {
	$valid = array( 'left', 'right' );

	if ( in_array( $select, $valid, true ) ) {
		return $select;
	}

	return NEOMORPHIC_SIDEBAR_POSITION;
}

/**
 * Select (SNS icon)
 */
function neomorphic_sanitize_choices_sns( $select ) {
	$valid = array_merge(
		array( 'none' => __( 'None', 'neomorphic' ) ),
		NEOMORPHIC_SNS_CHOICE
	);

	if ( array_key_exists( $select, $valid ) ) {
		return $select;
	}

	return 'none';
}

/**
 * HTML (Footer credit)
 */
function neomorphic_sanitize_footer_credit( $textarea ) {
	$allowed_html = array(
		'a'      => array(
			'href'    => array(),
			'onclick' => array(),
			'target'  => array(),
		),
		'br'     => array(),
		'strong' => array(),
		'b'      => array(),
	);

	return wp_kses( $textarea, $allowed_html );
}

/**
 * File uploader (Image)
 */
function neomorphic_sanitize_image( $image, $setting ) {
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
	);

	$file = wp_check_filetype( $image, $mimes );

	return $file['ext'] ? $image : $setting->default;
}
