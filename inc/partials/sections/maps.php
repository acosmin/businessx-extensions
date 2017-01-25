<?php
/**
 * ------------------
 * Template functions
 * ------------------
 *
 * In case you need to add some custom functions,
 * add them below.
 *
 */



/**
 * -----------------
 * Template partials
 * -----------------
 *
 * @see ../inc/partials/sections/hooks.php
 */

	/**
	 * Map Section
	 * -----------
	 */

	// Section wrapper - start
	if( ! function_exists( 'bx_ext_part__map_wrap_start' ) ) {
		function bx_ext_part__map_wrap_start() {
			?><section id="section-maps" class="sec-maps"><?php
		}
	}

	// Section wrapper - end
	if( ! function_exists( 'bx_ext_part__map_wrap_end' ) ) {
		function bx_ext_part__map_wrap_end() {
			?></section><?php
		}
	}

		/**
		 * Overlay
		 */
		if( ! function_exists( 'bx_ext_part__map_overlay' ) ) {
			function bx_ext_part__map_overlay() {
				/**
				 * Hooked:
				 * bx_ext_part__map_overlay_start   - 10
				 * bx_ext_part__map_overlay_content - 20
				 * bx_ext_part__map_overlay_end     - 999
				 */
				do_action( 'bx_ext_part__map_overlay' );
			}
		}

			// Start
			if( ! function_exists( 'bx_ext_part__map_overlay_start' ) ) {
				function bx_ext_part__map_overlay_start() {
					?><div class="sec-maps-overlay"><?php
				}
			}

			// End
			if( ! function_exists( 'bx_ext_part__map_overlay_end' ) ) {
				function bx_ext_part__map_overlay_end() {
					?></div><?php
				}
			}

				/**
				 * Overlay Content
				 */
				 if( ! function_exists( 'bx_ext_part__map_overlay_content' ) ) {
 					function bx_ext_part__map_overlay_content() {
 						/**
 						 * Hooked:
 						 * bx_ext_part__map_overlay_content_start - 10
 						 * bx_ext_part__map_overlay_content_title - 20
 						 * bx_ext_part__map_overlay_content_icon  - 30
 						 * bx_ext_part__map_overlay_content_end   - 999
 						 */
 						do_action( 'bx_ext_part__map_overlay_content' );
 					}
 				}

					// Start
					if( ! function_exists( 'bx_ext_part__map_overlay_content_start' ) ) {
	 					function bx_ext_part__map_overlay_content_start() {
	 						?><div class="smo-center"><?php
	 					}
	 				}

					// End
					if( ! function_exists( 'bx_ext_part__map_overlay_content_end' ) ) {
	 					function bx_ext_part__map_overlay_content_end() {
	 						?></div><?php
	 					}
	 				}

						// Section title
						if( ! function_exists( 'bx_ext_part__map_overlay_content_title' ) ) {
		 					function bx_ext_part__map_overlay_content_title() {
								$placeholder = __( 'Maps Section Title', 'businessx-extensions' );
								$title       = get_theme_mod( 'maps_section_title', $placeholder );
								$format      = '<h2 class="smo-title"><a href="#" class="smo-open-map">%s</a></h2>';

								$output = sprintf( $format, $title );
								$output = apply_filters(
									'bx_ext_part__map_overlay_content_title___filter',
									$output, $format, esc_html( $title )
								);

								if( empty( $title ) ) return;

								echo $output;
		 					}
		 				}

						// Section icon
						if( ! function_exists( 'bx_ext_part__map_overlay_content_icon' ) ) {
		 					function bx_ext_part__map_overlay_content_icon() {
								$hide   = get_theme_mod( 'maps_section_hide_icon', 0 );
								$icon   = businessx_icon( 'map', false );
								$format = '<a href="#" class="smo-icon smo-open-map">%s</a>';

								$output = sprintf( $format, $icon );
								$output = apply_filters(
									'bx_ext_part__map_overlay_content_icon___filter',
									$output, $format, $icon
								);

								// Do nothing if hidden
								if( $hide ) return;

								echo $output;
		 					}
		 				}

		/**
		 * Map output
		 */
		if( ! function_exists( 'bx_ext_part__map_output' ) ) {
			function bx_ext_part__map_output() {
				?>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45193.04410541707!2d25.97487315579!3d44.932175799049126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b249a43bf5be3f%3A0x55c12fa0a13e08ce!2sPloie%C8%99ti+Vest!5e0!3m2!1sen!2sro!4v1485270083315" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
				<?php
			}
		}
