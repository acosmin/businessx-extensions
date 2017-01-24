<?php
/**
 * ----------
 * Shortcodes
 * ----------
 */

/**
 * SECTION - Contact
 */

// Social button
if( ! function_exists( 'businessx_ext_sc_contact_social_btn' ) ) {
	function businessx_ext_sc_contact_social_btn( $atts ) {
		$args = shortcode_atts( array(
			'icon'  => 'link',
			'class' => 'sec-contact-social-btn',
			'link'  => '#',
		), $atts );

		$format = '<a target="_blank" href="%1$s" class="%2$s">%3$s</a>';
		$output = sprintf( $format, esc_url( $args[ 'link' ] ), esc_attr( $args[ 'class' ] ), businessx_icon( $args[ 'icon' ], false ) );
		$output = apply_filters( 'businessx_ext_sc_contact_social_btn___output', $output, $format, $args );

	    return $output;
	}
}
add_shortcode( 'bx_contact_social', 'businessx_ext_sc_contact_social_btn' );

// Phone number
if( ! function_exists( 'businessx_ext_sc_contact_phone_btn' ) ) {
	function businessx_ext_sc_contact_phone_btn( $atts ) {
		$args = shortcode_atts( array(
			'icon'   => 'phone',
			'class'  => 'sec-contact-social-btn scsb-with-span',
			'number' => '#',
			'text'   => ''
		), $atts );

		$text   = ( $args[ 'text' ] !== '' ) ? ' ' . $args[ 'text' ] : '';
		$format = '<a target="_blank" href="%1$s" class="%2$s">%3$s%4$s</a>';

		$output = sprintf(
			$format,
			esc_url( $args[ 'number' ] ),
			esc_attr( $args[ 'class' ] ),
			businessx_icon( $args[ 'icon' ], false ),
			esc_html( $text )
		);
		$output = apply_filters( 'businessx_ext_sc_contact_phone_btn___output', $output, $format, $args, $text );

	    return $output;
	}
}
add_shortcode( 'bx_contact_phone', 'businessx_ext_sc_contact_phone_btn' );
