<?php
/**
 * Plugin compatibility with Polylang
 *
 * @see   https://polylang.pro/doc/function-reference/
 * @since 1.0.4.3
 */

if( ! function_exists( 'bxext_compt_polylang_check' ) ) {
	/**
	 * Check if Polylang is activated
	 *
	 * @since  1.0.4.3
	 * @return boolean True if it is, false if it isn't
	 */
	function bxext_compt_polylang_check() {
		return ( class_exists( 'Polylang' ) ) ? true : false;
	}
}

/**
 * Create other functions
 */
if( bxext_compt_polylang_check() ) {

	if( ! function_exists( 'bxext_compt_polylang_register' ) ) {
		/**
		 * Register Polylang strings and group theme
		 *
		 * @since  1.0.4.3
		 * @return void
		 */
		function bxext_compt_polylang_register() {
			// About section
			pll_register_string( 'Businessx Extensions', 'About Us Heading', 'About Section' );
			pll_register_string( 'Businessx Extensions', 'This is a description for the About section. You can set it up in the Customizer > Front Page Sections > About Section.', 'About Section', true );
		}
	}

	/**
	 * Actions
	 */
	add_action( 'init', 'bxext_compt_polylang_register', 999 );

} /* END - bxext_compt_polylang_check() */
