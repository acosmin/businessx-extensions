<?php
/* ------------------------------------------------------------------------- *
 *  Helper Functions
/* ------------------------------------------------------------------------- */



/*  Check theme version
/* ------------------------------------ */
if( ! function_exists( 'businessx_extensions_ck_theme_v' ) ) {
    function businessx_extensions_ck_theme_v( $version, $sign = '>' ) {
        $theme_name = apply_filters( 'businessx_extensions___get_theme_name', 'businessx');
        $theme_ver = wp_get_theme( $theme_name )->get('Version');
        if( version_compare( $theme_ver, $version, $sign ) ) {
            return true;
        } else {
            return false;
        }
    }
}



/*  Check if Jetpack specific module
 *  is enabled
/* ------------------------------------ */
if( ! function_exists( 'businessx_extensions_jp_active' ) ) {
    function businessx_extensions_jp_active( $module ) {
        $active_modules = get_option( 'jetpack_active_modules' );
        if( $active_modules !== false ) {
            if( in_array( $module, $active_modules, TRUE ) ) { return true; } else { return false;  }
        } else {
            return false;
        }
    }
}



/*  Check if Jetpack specific module
 *  is enabled
/* ------------------------------------ */
if( ! function_exists( 'businessx_extensions_jp_ck_mobile_theme' ) ) {
    function businessx_extensions_jp_ck_mobile_theme() {
        if( businessx_extensions_jp_active( 'minileven' ) ) {
            echo '<div class="notice error is-dismissible">';
        		echo '<p>' . __( 'Jetpack\'s <i> Mobile Theme</i> module is activated.', 'businessx-extensions' )  .'</p>';
                echo '<p>' . __( 'This will cause an error or blank page on mobile devices. Businessx is already a responsive/mobile theme. Please disable the Mobile Theme module.', 'businessx-extensions' ) . '</p>';
            echo '</div>';
        }
    }
}
add_action( 'admin_notices', 'businessx_extensions_jp_ck_mobile_theme', 0 );



/*  Get theme mod wrapper
/* ------------------------------------ */
if( ! function_exists( 'bx_ext_tm' ) ) {
	/**
	 * Wrapper for get_theme_mod with a filter applied on the default value.
	 * @param  string  $theme_mod Theme modification name.
	 * @param  boolean $default   The default value. If not set, returns false.
	 * @return mixed              Returns theme modification value.
	 */
	function bx_ext_tm( $theme_mod, $default = false ) {
		$def = $default ? apply_filters( 'bx_ext___tm_' . $theme_mod . '_default', $default ) : $default;
		$mod = get_theme_mod( $theme_mod, $def );
		return $mod;
	}
}



/*  Sanitization
/* ------------------------------------ */

// Textarea with autop
if( ! function_exists( 'businessx_ext_sanitize_content_filtered' ) ) {
	function businessx_ext_sanitize_content_filtered( $content ) {
		return wp_kses_post( wptexturize( $content ) );
	}
}



/*  Escaping
/* ------------------------------------ */
// Textarea with autop
if( ! function_exists( 'businessx_ext_escape_content_filtered' ) ) {
	function businessx_ext_escape_content_filtered( $content ) {
		$new_content = shortcode_unautop( do_shortcode( wpautop( wptexturize( wp_kses_post( $content ) ) ) ) );
		$partials    = apply_filters( 'businessx_ext_escape_content_filtered___partials', array(
			'<p></p>'    => '',
			'<p><div'    => '<div',
			'</div></p>' => '</div>',
		), $new_content );

		foreach ( $partials as $partial => $change ) {
			$new_content = str_replace( $partial, $change, $new_content );
		}

		return $new_content;
	}
}



/*  New controllers
/* ------------------------------------ */
if ( ! function_exists( 'bx_ext_controller_register' ) ) {
	/**
	 * Wrapper for $wp_customize->add_*, registers a Customizer
	 * setting and control
	 *
	 * @see    https://developer.wordpress.org/reference/classes/wp_customize_manager/add_control/
	 * @see    https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
	 * @since  1.0.4.3
	 * @param  array  $args An array containing new arguments for add_setting & add_control
	 * @return object       WP_Customize_Manager instance
	 */
	function bx_ext_controller_register( $args = array() ) {
		global $wp_customize;

		/* Vars */
		$setting_args = $control_args = array();

		/* Defaults */
		$defaults = array(
			'type'        => 'text',
			'setting_id'  => '',
			'section_id'  => '',
			'label'       => '',
			'description' => '',
			'default'     => '',
			'selector'    => '',
			'transport'   => true,
			'sanitize'    => 'sanitize_text_field',
			'escape'      => 'esc_html',
			'priority'    => 10,
			'capability'  => 'edit_theme_options'
		);

		/* New args */
		$args         = wp_parse_args( $args, $defaults );
		$args         = apply_filters( 'bx_ext_controller_register___' . $type .'_args', $args, $defaults, $type );
		$type         = $args['type'];
		$setting_id   = $args['setting_id'];
		$section_id   = $args['section_id'];
		$label        = $args['label'];
		$description  = $args['description'];
		$default      = $args['default'];
		$selector     = $args['selector'];
		$sanitize     = $args['sanitize'];
		$escape       = $args['escape'];
		$priority     = $args['priority'];
		$capability   = $args['capability'];



		/**
		 * Transport type
		 * @see https://codex.wordpress.org/Theme_Customization_API#Part_2:_Generating_Live_CSS
		 * @var string
		 */
		$transport = $args['transport'] ? 'postMessage' : 'refresh';

		/* Default section args */
		$settings_args = apply_filters( 'bx_ext_controller_register___' . $type .'_settings_args', array(
			'default'           => $default,
			'sanitize_callback' => $sanitize,
			'capability'        => $capability,
			'transport'         => $transport,
		), $args, $type, $transport );

		/* Default control args */
		$control_args  = apply_filters( 'bx_ext_controller_register___' . $type .'_control_args', array(
			'label'             => $label,
			'description'       => $description,
			'section'           => $section_id,
			'settings'          => $setting_id,
			'type'              => $type,
			'priority'          => intval( $priority ),
		), $args, $type );

		/* The type of control and setting we display and register. */
		$types = array(
			'select'     => 1,
			'checkbox'   => 1,
			'textarea'   => 1,
			'text'       => 1,
			'rgb'        => 1,
			'rgba'       => 1,
			'image'      => 1,
			'background' => 1
		);

		if( array_key_exists( $type, $types ) ) {
			switch( $type ) {

				/**
				 * Background image options
				 */
				case 'background':
					// Upload image
					$control_args['type']         = 'background';
					$settings_args['sanitize']    = $sanitize !== 'esc_html' ? $sanitize : 'esc_url_raw';
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, $control_args ) );

					// Select a backgroud size
					$control_args['type']         = 'select';
					$control_args['label']        = esc_html__( 'Background-size:', 'businessx' );
					$control_args['settings']     = $setting_id . '_size';
					$control_args['choices']      = businessx_bg_options_size();
					$settings_args['sanitize']    = 'businessx_sanitize_select';
					$settings_args['default']     = 'cover';
					$wp_customize->add_setting( $setting_id . '_size', $settings_args );
					$wp_customize->add_control( $setting_id . '_size', $control_args );

					// Select how the background repeats
					$control_args['label']        = esc_html__( 'Background-repeat:', 'businessx' );
					$control_args['choices']      = businessx_bg_options_repeat();
					$control_args['settings']     = $setting_id . '_repeat';
					$settings_args['default']     = 'no-repeat';
					$wp_customize->add_setting( $setting_id . '_repeat', $settings_args );
					$wp_customize->add_control( $setting_id . '_repeat', $control_args );

					// Select a background position
					$control_args['label']        = esc_html__( 'Background-position:', 'businessx' );
					$control_args['choices']      = businessx_bg_options_position();
					$control_args['settings']     = $setting_id . '_position';
					$settings_args['default']     = 'center center';
					$wp_customize->add_setting( $setting_id . '_position', $settings_args );
					$wp_customize->add_control( $setting_id . '_position', $control_args );
					break;

				/**
				 * Image uploader
				 */
				case 'image':
					$control_args['type']         = 'image';
					$settings_args['sanitize']    = $sanitize !== 'esc_html' ? $sanitize : 'esc_url_raw';
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, $control_args ) );
					break;

				/**
				 * RGBA color picker
				 */
				case 'rgba':
					$control_args['type']         = 'alpha-color';
					$control_args['show_opacity'] = ! empty( $args['show_opacity'] ) ? $args['show_opacity'] : true;
					$control_args['palette']      = ! empty( $args['palette'] ) ? $args['palette'] : array();
					$settings_args['sanitize']    = $sanitize !== 'esc_html' ? $sanitize : 'businessx_sanitize_rgba';
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( new Businessx_Control_RGBA( $wp_customize, $setting_id, $control_args ) );
					break;

				/**
				 * RGB color picker
				 */
				case 'rgb':
					$control_args['type']      = 'color';
					$settings_args['sanitize'] = $sanitize !== 'esc_html' ? $sanitize : 'sanitize_hex_color';
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, $control_args ) );
					break;

				/**
				 * Select box
				 */
				case 'select':
					$control_args['type']    = 'select';
					$control_args['width']   = ! empty( $args['width'] ) ? $args['width'] : '100';
					$control_args['choices'] = ! empty( $args['choices'] ) ? $args['choices'] : array();
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( $setting_id, $control_args );
					break;

				/**
				 * Checkbox input
				 */
				case 'checkbox':
					$control_args['type'] = 'checkbox';
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( $setting_id, $control_args );
					break;

				/**
				 * Textarea field
				 */
				case 'textarea':
					$control_args['type'] = 'textarea';
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( $setting_id, $control_args );
					break;

				/**
				 * Simple text field
				 */
				default:
					$wp_customize->add_setting( $setting_id, $settings_args );
					$wp_customize->add_control( $setting_id, $control_args );
					
			}
		}

		/* Add new controls & settings */
		do_action( 'bx_ext_controller_register__new', $defaults, $args, $type, $settings_args, $control_args );

		/* Selective refresh in case transport is set to true */
		if( $args['transport'] && $type !== 'rgb' && $type !== 'rgba' && $type !== 'image' && $type !== 'background' ) {
			$wp_customize->selective_refresh->add_partial( $setting_id, array(
				'selector' => $selector,
				'render_callback' => function() use ( &$setting_id, &$escape )  {
					$tm = get_theme_mod( $setting_id );
					if( function_exists( $escape ) ) {
						return call_user_func( $escape, $tm );
					} else {
						return esc_html( $tm );
					}
				},
			) );
		}

	}
}



/*  Section Parallax
/* ------------------------------------ */
if( businessx_extensions_ck_theme_v( '1.0.4', '>=' ) || ! ( 'Businessx' == businessx_extensions_theme() ) || ! ( 'Businessx' == businessx_extensions_theme( true ) ) ) :
if ( ! function_exists( 'businessx_section_parallax' ) ) {
	function businessx_section_parallax( $enabled, $bgimg, $return = false ) {
		$background			= get_theme_mod( $bgimg, '' );
		$parallax			= get_theme_mod( $enabled, false );
		$output				= '';

		if( $bgimg != '' && $parallax ) {
			$output = ' data-parallax="scroll" data-speed="0.5" data-image-src="' . esc_url( $background ) . '" style="background: none !important;"';
		}

		if( $return ) { return $output; } else { echo $output; }
	}
}
endif;



if( businessx_extensions_ck_theme_v( '1.0.3' ) || ! ( 'Businessx' == businessx_extensions_theme() ) || ! ( 'Businessx' == businessx_extensions_theme( true ) ) ) : // Backwards compatibility
/*  Hero buttons output
/* ------------------------------------ */
if( ! function_exists( 'businessx_hero_btns_output' ) ) {
    function businessx_hero_btns_output() {
    	$type = get_theme_mod( 'hero_section_btns', apply_filters( 'businessx_hero___btns_type_default', 'btns-2-def-op' ) );
    	$btn_1_text = get_theme_mod( 'hero_section_1st_btn', __( 'Call to Action', 'businessx-extensions' ) );
    	$btn_1_link = get_theme_mod( 'hero_section_1st_btn_link', '#' );
    	$btn_1_target = get_theme_mod( 'hero_section_1st_btn_target', false ) ? '_blank' : '_self';
    	$btn_2_text = get_theme_mod( 'hero_section_2nd_btn', __( 'Call to Action', 'businessx-extensions' ) );
    	$btn_2_link = get_theme_mod( 'hero_section_2nd_btn_link', '#' );
    	$btn_2_target = get_theme_mod( 'hero_section_2nd_btn_target', false ) ? '_blank' : '_self';
    	$btns_between = get_theme_mod( 'hero_section_btns_or', __( 'Or', 'businessx-extensions' ) );
    	$output = '';

    	switch( $type ) {
    		// One button - default
    		case 'btns-1-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One button - opaque
    		case 'btns-1-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One large - default
    		case 'btns-1-l-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st btn-width-50">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One large - opaque
    		case 'btns-1-l-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st btn-width-50 btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// Two - default
    		case 'btns-2-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-2nd">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - opaque
    		case 'btns-2-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - default + opaque
    		case 'btns-2-def-op' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - opaque + default
    		case 'btns-2-op-def' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-2nd">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Default
    		default : $output .= '';
    	}

    	return apply_filters( 'businessx_hero___btns_output', $output );

    }
}



/*  Slider buttons output
/* ------------------------------------ */
if( ! function_exists( 'businessx_slider_btns_output' ) ) {
    function businessx_slider_btns_output( $type = 'btns-2-def-op', $btns_between = ' ', $btn_1_text = '', $btn_1_link = '', $btn_1_target = false, $btn_2_text = '', $btn_2_link = '', $btn_2_target = false ) {
    	$btn_1_text 	= ! empty( $btn_1_text ) ? $btn_1_text : esc_html__( 'Call to Action #1', 'businessx-extensions' );
    	$btn_1_link 	= ! empty( $btn_1_link ) ? $btn_1_link : '#';
    	$btn_1_target	= $btn_1_target ? '_blank' : '_self';
    	$btn_2_text 	= ! empty( $btn_2_text ) ? $btn_2_text : esc_html__( 'Call to Action #2', 'businessx-extensions' );
    	$btn_2_link 	= ! empty( $btn_2_link ) ? $btn_2_link : '#';
    	$btn_2_target	= $btn_2_target ? '_blank' : '_self';
    	$output = '';

    	switch( $type ) {
    		// One button - default
    		case 'btns-1-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One button - opaque
    		case 'btns-1-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One large - default
    		case 'btns-1-l-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st btn-width-50">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// One large - opaque
    		case 'btns-1-l-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-width-50 btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    		break;

    		// Two - default
    		case 'btns-2-default' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - opaque
    		case 'btns-2-opaque' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - default + opaque
    		case 'btns-2-def-op' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Two - opaque + default
    		case 'btns-2-op-def' :
    			$output .= '<a target="' . esc_attr( $btn_1_target ) . '" href="' . esc_url( $btn_1_link ) . '" class="ac-btn btn-biggest ac-btn-2nd btn-opaque">' . esc_html( $btn_1_text ) . '</a>';
    			if( $btns_between != '' ) {
    				$output .= '<span class="ac-btns-or fw-bolder">' . esc_html( $btns_between ) . '</span>'; }
    			$output .= '<a target="' . esc_attr( $btn_2_target ) . '" href="' . esc_url( $btn_2_link ) . '" class="ac-btn btn-biggest ac-btn-1st">' . esc_html( $btn_2_text ) . '</a>';
    		break;

    		// Default
    		default : $output .= '';
    	}

    	return apply_filters( 'businessx_slider___btns_output', $output );

    }
}



/*  Slider buttons options
/* ------------------------------------ */
if( ! function_exists( 'businessx_slider_btns_select' ) ) {
    function businessx_slider_btns_select( $just_values = false ) {
    	if( ! $just_values ) {
    		$options = apply_filters( 'businessx_slider_btns___select', $options = array(
    				array(
    					'value' 	=> 'btns-1-default',
    					'title'		=> esc_html__( 'One - Default', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-1-opaque',
    					'title'		=> esc_html__( 'One - Opaque', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-1-l-default',
    					'title'		=> esc_html__( 'One Large - Default', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-1-l-opaque',
    					'title'		=> esc_html__( 'One Large - Opaque', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-default',
    					'title'		=> esc_html__( 'Two - Default', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-opaque',
    					'title'		=> esc_html__( 'Two - Opaque', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-def-op',
    					'title'		=> esc_html__( 'Two - Default + Opaque', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    				array(
    					'value' 	=> 'btns-2-op-def',
    					'title'		=> esc_html__( 'Two - Opaque + Default', 'businessx-extensions' ),
    					'disabled'	=> false
    				),
    		) );
    	} else {
    		$options = apply_filters( 'businessx_slider_btns___select_values', $options = array(
    			'btns-1-default', 'btns-1-opaque', 'btns-1-l-default', 'btns-1-l-opaque', 'btns-2-default', 'btns-2-opaque', 'btns-2-def-op', 'btns-2-op-def'
    		) );
    	}

    	return $options;
    }
}
endif; // Backwards compatibility END
