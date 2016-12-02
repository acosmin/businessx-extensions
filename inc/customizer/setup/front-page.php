<?php
function bxext_used_frontpage() {
	$page_title = apply_filters( 'businessx_extensions___frontpage_name', 'Businessx Front Page' );
	$page = get_page_by_title( $page_title );
	$check = bxext_has_frontpage();

	if ( $check && get_option( 'page_on_front', -1 ) === $page->ID."" ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Checks if a Businessx Extensions front page is published
 * @return boolean true or false
 */
function bxext_has_frontpage() {
	$page_title = apply_filters( 'businessx_extensions___frontpage_name', 'Businessx Front Page' );
	$page = get_page_by_title( $page_title );

	if ( $page ) {
		if ( is_object( $page ) && property_exists( $page, 'post_status' ) && $page->post_status === 'publish' ) {
			return true;
		}
		return false;
	}
	return false;
}

/**
 * Creates a front page and blog page and sets up
 * the static page option.
 * @return void
 */
function bxext_create_frontpage() {
	// Check nonce
	$nonce = $_POST[ 'bxext_create_frontpage' ];
	if ( ! wp_verify_nonce( $nonce, 'bxext_create_frontpage' ) ) {
		die();
	}

	// Setup front page
	$page_title = apply_filters( 'businessx_extensions___frontpage_name', 'Businessx Front Page' );
	$page_slug  = apply_filters( 'businessx_extensions___frontpage_slug', 'businessx-front-page' );

	$page = get_page_by_title( $page_title );
	if ( $page == null  || $page->post_status !== 'publish' ) {
		// Front Page
		$page_id = wp_insert_post(
			array(
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_name'      => $page_slug,
				'post_title'     => $page_title,
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'page_template'  => 'template-frontpage.php',
			)
		);

		// Update static front page settings
		update_option('show_on_front', 'page');
		update_option('page_on_front', $page_id);

		// Blog view
		if ( get_page_by_title( 'Blog' ) == null ) {
			$page_id = wp_insert_post(
				array(
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
					'post_name'      => 'blog',
					'post_title'     => 'Blog',
					'post_status'    => 'publish',
					'post_type'      => 'page',
				)
			);

			// Update option
			$blog = get_page_by_title( 'Blog' );
			update_option( 'page_for_posts', $blog->ID );
		}
	}

}
add_action( 'wp_ajax_bxext_create_frontpage', 'bxext_create_frontpage' );

function bxext_frontpage_vars() {
		wp_localize_script( 'businessx-extensions-customizer-js', 'bxext_frontpage_vars', array(
			'used_frontpage' => bxext_used_frontpage(),
			'has_frontpage' => bxext_has_frontpage(),
			'modal_title' => esc_html__( 'Businessx Front Page Setup', 'businessx-extensions' )
		) );
		wp_enqueue_style( 'thickbox' ); // CHECK IF PAGE TO LOAD
        wp_enqueue_script( 'thickbox' );
}
add_filter( 'customize_controls_enqueue_scripts', 'bxext_frontpage_vars', 20 );

function bxext_frontpage_modal() {
	?>
	<div id="businessx-frontpage-modal" style="display:none">
		<div class="button-group">
			<a href="#" class="button-primary button button-hero" id="insert-frontpage">Insert Frontpage</a>
			<a href="#" class="button-secondary button button-hero" id="insert-frontpage">Never Ask Again</a>
		</div>
	</div>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'bxext_frontpage_modal' );
