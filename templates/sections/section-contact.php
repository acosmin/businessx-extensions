<?php
/* ------------------------------------------------------------------------- *
 *  Contact Section Wrapper
/* ------------------------------------------------------------------------- */

	// Vars
	$contact_sec__hide_default = apply_filters( 'contact_section_hide___def', 1 );
	$contact_sec__hide         = bx_ext_tm( 'contact_section_hide', $contact_sec__hide_default ) == 0 ? true : false;

if( $contact_sec__hide ) :

	/**
	 * Hooked:
	 * bx_ext_part__contact_wrap_start - 10
	 * bx_ext_part__contact_overlay    - 20
	 * bx_ext_part__contact_container  - 30
	 * bx_ext_part__contact_wrap_end   - 999
	 *
	 * @see ../inc/partials/sections/contact.php
	 */
	do_action( 'bx_ext_part__contact' );

endif; // END Contact Section
