<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Maps Section
 *  ________________
 *
 *  Settings and controls options
 *  _____________________________
 *
 *  All the "businessx_controller_*" are located in the theme:
 *  ../acosmin/customizer/customizer.php
 *
 *  They use $wp_customize->add_setting and $wp_customize->add_control to
 *  add settings and controls, all sanitized.
 *
/* ------------------------------------------------------------------------- */



	/*  Add section
	/* ------------------------------------ */
	$wp_customize->add_section( 'businessx_section__maps', array(
		'title'     => esc_html__( 'Maps Section', 'businessx-extensions' ),
		'panel'     => 'businessx_panel__sections',
		'priority'  => absint( businessx_extensions_sec_prio( 'businessx_section__maps' ) ),
	) );



		/*  Maps Section options
		/* ------------------------------------ */

		// Hide section
		businessx_controller_checkbox(
			'maps_section_hide',
			'businessx_section__maps',
			esc_html__( 'Hide this section', 'businessx-extensions' ), '', true );
		/*=====*/

		// Section title
		businessx_controller_txt(
			'maps_section_title',
			'businessx_section__maps',
			esc_html__( 'Section title', 'businessx-extensions' ),
			esc_html__( 'Set a title for this section.', 'businessx-extensions' ),
			esc_html__( 'Maps Section Title', 'businessx-extensions' ),
			'.sec-maps .smo-title a' );
		/*=====*/

		// Hide icon
		businessx_controller_checkbox(
			'maps_section_hide_icon',
			'businessx_section__maps',
			esc_html__( 'Hide icon', 'businessx-extensions' ) );
		/*=====*/
