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
 *  All the "businessx_controller_*" are located in the theme:
 *  ../acosmin/customizer/customizer.php
 *
 *  They use $wp_customize->add_setting and $wp_customize->add_control to
 *  add settings and controls, all sanitized.
 *
/* ------------------------------------------------------------------------- */



	/*  Add section
	/* ------------------------------------ */
	$wp_customize->add_section( 'businessx_section__contact', array(
		'title'     => esc_html__( 'Contact Section', 'businessx-extensions' ),
		'panel'     => 'businessx_panel__sections',
		'priority'  => absint( businessx_extensions_sec_prio( 'businessx_section__contact' ) ),
	) );



		/*  Contact Section options
		/* ------------------------------------ */

		// Hide section
		bx_ext_controller_register( array(
			'type'        => 'checkbox',
			'setting_id'  => 'contact_section_hide',
			'section_id'  => 'businessx_section__contact',
			'label'       => esc_html__( 'Hide this section', 'businessx-extensions' ),
			'default'     => true,
			'transport'   => false,
			'sanitize'    => 'businessx_sanitize_checkbox',
		) );
		/*=====*/

		// Section title
		bx_ext_controller_register( array(
			'setting_id'  => 'contact_section_title',
			'section_id'  => 'businessx_section__contact',
			'label'       => esc_html__( 'Section title', 'businessx-extensions' ),
			'description' => esc_html__( 'Set a title for this section.', 'businessx-extensions' ),
			'default'     => esc_html__( 'Contact Us', 'businessx-extensions' ),
			'selector'    => '.sec-contact .section-title',
		) );
		/*=====*/

		// Section description
		bx_ext_controller_register( array(
			'type'        => 'textarea',
			'setting_id'  => 'contact_section_description',
			'section_id'  => 'businessx_section__contact',
			'label'       => esc_html__( 'Section description', 'businessx-extensions' ),
			'description' => esc_html__( 'Set a description for this section. It will automatically add paragraph tags. You can also use html tags and shortcodes (not recommended).', 'businessx-extensions' ),
			'default'     => esc_html__( 'This is a description for the Contact section. You can set it up in the Customizer where you can also add items for it.', 'businessx-extensions' ),
			'selector'    => '.sec-contact .section-description',
			'sanitize'    => 'businessx_ext_sanitize_content_filtered',
			'escape'      => 'businessx_ext_escape_content_filtered',
		) );
		/*=====*/

		// Contact Shortcode
		bx_ext_controller_register( array(
			'type'        => 'textarea',
			'setting_id'  => 'contact_section_shortcode',
			'section_id'  => 'businessx_section__contact',
			'label'       => esc_html__( 'Contact form shortcode', 'businessx-extensions' ),
			'description' => esc_html__( 'You can paste your contact form shortcode here. We recommend the Contact Form 7 plugin. You can also add text before or after the shortcode (with html tags if needed).', 'businessx-extensions' ),
			'default'     => esc_html__( 'Your contact form shortcode appears here...', 'businessx-extensions' ),
			'selector'    => '.sec-contact .sec-contact-form',
			'sanitize'    => 'businessx_ext_sanitize_content_filtered',
			'escape'      => 'businessx_ext_escape_content_filtered',
		) );
		/*=====*/

		businessx_controller_info(
			'contact_section_social_about',
			'businessx_section__contact',
			__( 'Social buttons', 'businessx' ),
			__( '<p>You can use the following shortcodes, one on each new line</p>
			<p>
				<code>[bx_contact_social]</code>
			</p>
			<p>
				<code>icon</code> attribute, represents the icon name without <code>fa fa-</code> prefix. You can find a list of <a href="http://fontawesome.io/icons/"  target="_blank">supported icons here</a>.
			</p>
			<p>
				<code>link</code> attribute, represents the URL to the social network profile, ex: <code>https://twitter.com/acosmin</code>.
			</p>
			<p>
				<code>[bx_contact_phone]</code>
			</p>
			<p>
				<code>number</code> attribute, represents the phone number, ex: <code>tel:055222312</code>.
			</p>
			<p>
				<code>text</code> attribute, represents some text added next to the icon.
			</p>
			<p>
				<a href="https://codex.wordpress.org/Shortcode" target="_blank">More info about Shortcodes</a>
			</p>', 'businessx-extensions' ) );

		// Social Shortcodes
		bx_ext_controller_register( array(
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
		) );
		/*=====*/


		//
		// // Section colors
		// businessx_controller_color_picker(
		// 	'features_color_background',
		// 	'businessx_section__features',
		// 	esc_html__( 'Section background color:', 'businessx-extensions' ),
		// 	esc_html__( 'In case you do not have a background image', 'businessx-extensions' ),
		// 	'#ffffff' );
		// /*=====*/
		//
		// businessx_controller_color_picker(
		// 	'features_color_heading_link',
		// 	'businessx_section__features',
		// 	esc_html__( 'Headings and buttons colors:', 'businessx-extensions' ),
		// 	'', '#232323' );
		// /*=====*/
		//
		// businessx_controller_color_picker(
		// 	'features_color_heading_border',
		// 	'businessx_section__features',
		// 	esc_html__( 'Section heading border color:', 'businessx-extensions' ),
		// 	'', '#e3e3e3' );
		// /*=====*/
		//
		// businessx_controller_color_picker(
		// 	'features_color_text',
		// 	'businessx_section__features',
		// 	esc_html__( 'Text color:', 'businessx-extensions' ),
		// 	'', '#636363' );
		// /*=====*/
		//
		// businessx_controller_color_picker(
		// 	'features_color_hover',
		// 	'businessx_section__features',
		// 	esc_html__( 'Button hover border color:', 'businessx-extensions' ),
		// 	'',
		// 	'#232323' );
		// /*=====*/
		//
		// // Background image
		// businessx_controller_bg_image( 'features_bg_image', 'businessx_section__features', esc_html__( 'Background Image:', 'businessx-extensions' ), '', esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'businessx-extensions' ) );
		// /*=====*/
		//
		// // Background overlay
		// businessx_controller_bg_overlay( 'features_bg_overlay', 'businessx_section__features', esc_html__( 'Show Background Overlay', 'businessx-extensions' ) );
		// /*=====*/
		//
		// // Backgroud parallax
		// businessx_controller_bg_parallax( 'features_bg_parallax', 'businessx_section__features', esc_html__( 'Enable Parallax Effect', 'businessx-extensions' ) );
		// businessx_controller_simple_image(
		// 	'features_bg_parallax_img',
		// 	'businessx_section__features',
		// 	esc_html__( 'Parallax Background Image', 'businessx-extensions' ),
		// 	esc_html__( 'Use a HD image, suggested size: 1920x1080px', 'businessx-extensions' ), '', false
		// );
		// /*=====*/
