<?php
/* ------------------------------------------------------------------------- *
 *  ______
 *
 *  Contact Section
 *  ________________
 *
 *  Settings and controls options
 *  _____________________________
 *
 *  You can find the callback functions in:
 *  ../inc/customizer/helpers.php
 *
/* ------------------------------------------------------------------------- */


	/**
	 * Add section
	 */
	$wp_customize->add_section( 'businessx_section__contact', array(
		'title'     => esc_html__( 'Contact Section', 'businessx-extensions' ),
		'panel'     => 'businessx_panel__sections',
		'priority'  => absint( businessx_extensions_sec_prio( 'businessx_section__contact' ) ),
	) );

		/**
		 * A list of options to register based on a callback function and arguments
		 * Use the `bx_contact_section___options` to add options
		 *
		 * @var array
		 */
		$bx_contact_section = apply_filters( 'bx_contact_section___options', array(

			/* Hide section */
			'hide_section' => array(
				'callback'   => 'simple',
				'args'       => array(
					'type'        => 'checkbox',
					'setting_id'  => 'contact_section_hide',
					'section_id'  => 'businessx_section__contact',
					'label'       => esc_html__( 'Hide this section', 'businessx-extensions' ),
					'default'     => true,
					'transport'   => false,
					'sanitize'    => 'businessx_sanitize_checkbox',
				)
			),

			/* Section title */
			'section_title' => array(
				'callback'    => 'simple',
				'args'        => array(
					'setting_id'  => 'contact_section_title',
					'section_id'  => 'businessx_section__contact',
					'label'       => esc_html__( 'Section title', 'businessx-extensions' ),
					'description' => esc_html__( 'Set a title for this section.', 'businessx-extensions' ),
					'default'     => esc_html__( 'Contact Us', 'businessx-extensions' ),
					'selector'    => '.sec-contact .section-title',
				)
			),

			/* Section description */
			'section_description' => array(
				'callback'          => 'simple',
				'args'              => array(
					'type'        => 'textarea',
					'setting_id'  => 'contact_section_description',
					'section_id'  => 'businessx_section__contact',
					'label'       => esc_html__( 'Section description', 'businessx-extensions' ),
					'description' => esc_html__( 'Set a description for this section. It will automatically add paragraph tags. You can also use html tags and shortcodes (not recommended).', 'businessx-extensions' ),
					'default'     => esc_html__( 'This is a description for the Contact section. You can set it up in the Customizer where you can also add items for it.', 'businessx-extensions' ),
					'selector'    => '.sec-contact .section-description',
					'sanitize'    => 'businessx_ext_sanitize_content_filtered',
					'escape'      => 'businessx_ext_escape_content_filtered',
				)
			),

			/* Contact form shortcode */
			'contact_form' => array(
				'callback'   => 'simple',
				'args'       => array(
					'type'        => 'textarea',
					'setting_id'  => 'contact_section_shortcode',
					'section_id'  => 'businessx_section__contact',
					'label'       => esc_html__( 'Contact form shortcode', 'businessx-extensions' ),
					'description' => esc_html__( 'You can paste your contact form shortcode here. We recommend the Contact Form 7 plugin. You can also add text before or after the shortcode (with html tags if needed).', 'businessx-extensions' ),
					'default'     => esc_html__( 'Your contact form shortcode appears here...', 'businessx-extensions' ),
					'selector'    => '.sec-contact .sec-contact-form',
					'sanitize'    => 'businessx_ext_sanitize_content_filtered',
					'escape'      => 'businessx_ext_escape_content_filtered',
				)
			),

			/* Social buttons shortcodes */
			'social_buttons' => array(
				'callback'     => 'simple',
				'args'         => array(
					'type'        => 'textarea',
					'setting_id'  => 'contact_section_social',
					'section_id'  => 'businessx_section__contact',
					'default'     => '[bx_contact_social icon="facebook" link="https://www.facebook.com/acosmincom"]
		[bx_contact_social icon="twitter" link="https://twitter.com/acosmin"]
		[bx_contact_social icon="google-plus" link="#"]
		[bx_contact_phone number="tel:055222312" text="Call 055 222 312"]',
					'selector'    => '.sec-contact .sec-contact-social',
					'sanitize'    => 'businessx_ext_sanitize_content_filtered',
					'escape'      => 'businessx_ext_escape_content_filtered',
				)
			),

			/* Section background color */
			'section_bg_color' => array(
				'callback'       => 'simple',
				'args'           => array(
					'type'        => 'rgb',
					'setting_id'  => 'contact_color_background',
					'section_id'  => 'businessx_section__contact',
					'label'       => esc_html__( 'Section background color:', 'businessx-extensions' ),
					'description' => esc_html__( 'In case you do not have a background image', 'businessx-extensions' ),
					'default'     => '#2e910e',
				)
			),

			/* Section background image */
			'section_bg_image' => array(
				'callback'       => 'custom',
				'args'           => array(
					'setting_id'  => 'contact_bg_image',
					'section_id'  => 'businessx_section__contact'
				)
			),

			/* Section overlay */
			'section_bg_overlay' => array(
				'callback'         => 'custom',
				'args'             => array(
					'type'           => 'overlay',
					'setting_id'     => 'contact_bg_overlay',
					'section_id'     => 'businessx_section__contact'
				)
			),

			/* Background parallax */
			'section_bg_parallax' => array(
				'callback'          => 'simple',
				'args'              => array(
					'type'            => 'checkbox',
					'setting_id'      => 'contact_bg_parallax',
					'section_id'      => 'businessx_section__contact',
					'label'           => esc_html__( 'Parallax Background Image', 'businessx-extensions' ),
					'description'     => esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'businessx-extensions' ),
					'default'         => false,
					'transport'       => false,
					'sanitize'        => 'businessx_sanitize_checkbox',
				)
			),

			/* Background parallax image */
			'section_bg_parallax_img' => array(
				'callback'              => 'simple',
				'args'                  => array(
					'type'                => 'image',
					'setting_id'          => 'contact_bg_parallax_img',
					'section_id'          => 'businessx_section__contact',
					'label'               => esc_html__( 'Parallax Background Image', 'businessx-extensions' ),
					'description'         => esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'businessx-extensions' ),
					'default'             => '',
					'transport'           => false,
				)
			),

		) ); // End options

		/**
		 * Register controls based on the above options
		 */
		bx_ext_controller_register( $bx_contact_section );
