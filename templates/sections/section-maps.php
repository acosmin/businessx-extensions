<?php
/* ------------------------------------------------------------------------- *
 *  Maps Section Wrapper
/* ------------------------------------------------------------------------- */

	// Vars
	$maps_sec__hide = get_theme_mod( 'maps_section_hide', 1 ) == 0 ? true : false;

if( $maps_sec__hide ) :

	/**
	 * Hooked:
	 * bx_ext_part__map_wrap_start - 10
	 * bx_ext_part__map_overlay    - 20
	 * bx_ext_part__map_output     - 30
	 * bx_ext_part__map_wrap_end   - 999
	 */
	do_action( 'bx_ext_part__map' );

endif; // END Maps Section
