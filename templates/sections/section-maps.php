<?php
/* ------------------------------------------------------------------------- *
 *  Maps Section Wrapper
/* ------------------------------------------------------------------------- */

	// Vars
	$maps_sec__hide_default = apply_filters( 'maps_section_hide___def', 1 );
	$maps_sec__hide         = bx_ext_tm( 'maps_section_hide', $maps_sec__hide_default ) == 0 ? true : false;

if( $maps_sec__hide ) :

	/**
	 * Hooked:
	 * bx_ext_part__map_wrap_start - 10
	 * bx_ext_part__map_overlay    - 20
	 * bx_ext_part__map_output     - 30
	 * bx_ext_part__map_wrap_end   - 999
	 *
	 * @see ../inc/partials/sections/maps.php
	 */
	do_action( 'bx_ext_part__map' );

endif; // END Maps Section
