<?php
/*
Plugin Name: Businessx Extensions
Plugin URI: http://www.acosmin.com/themes/businessx/
Description: Adds front page sections and other extensions to Businessx WordPress theme.
Version: 1.0.2.2
Author: Acosmin
Author URI: http://www.acosmin.com/
Text Domain: businessx-extensions
Domain Path: /languages
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if ( ! function_exists( 'add_action' ) ) {
	die( 'Nothing to do...' );
}



/* Some constants */
define( 'BUSINESSX_EXTS_THEME_NAME', 'Businessx' );
define( 'BUSINESSX_EXTS_THEME_URL', 'http://www.acosmin.com/theme/businessx/' );
define( 'BUSINESSX_EXTS_VERSION', '1.0.2.2' );
define( 'BUSINESSX_EXTS_URL', plugin_dir_url( __FILE__ ) );
define( 'BUSINESSX_EXTS_PATH', plugin_dir_path( __FILE__ ) );



/* Theme names */
function businessx_extensions_theme( $parent = false ) {
	$theme = wp_get_theme();
	if( ! $parent ) {
		return $theme->name;
	} else {
		return $theme->parent_theme;
	}
}



/* Load text domain */
function businessx_extensions_textdomain() {
	load_plugin_textdomain( 'businessx-extensions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'businessx_extensions_textdomain' );



/* Add front page sections */
function businessx_extensions_sections() {
	return $sections = array(
		'slider',
		'features',
		'about',
		'team',
		'clients',
		'portfolio',
		'actions',
		'testimonials',
		'pricing',
		'faq',
		'hero',
		'blog',
	);
}

function businessx_extensions_add_sections() {
	add_filter( 'businessx_sections_filter', 'businessx_extensions_sections' );
}
add_action( 'plugins_loaded', 'businessx_extensions_add_sections' );


/* Add Admin notices */
if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] ) {
    add_action( 'admin_notices', 'businessx_extensions_admin_notices', 0 );
}



/* Notices */
function businessx_extensions_admin_notices() {

    $businessx_extensions_errors = businessx_extensions_requirements();

    if ( empty ( $businessx_extensions_errors ) )
        return;

    /* Suppress "Plugin activated" notice. */
    unset( $_GET['activate'] );

	echo '<div class="notice error my-acf-notice is-dismissible">';
		echo '<p>' . join( $businessx_extensions_errors )  .'</p>';
        echo '<p>' . __( '<i>Businessx Extensions</i> has been deactivated.', 'businessx-extensions' ) . '</p>';
    echo '</div>';

    deactivate_plugins( plugin_basename( __FILE__ ) );
}



/* Requirements */
function businessx_extensions_requirements() {

	$businessx_extensions_errors = array();
	$theme = wp_get_theme();

	if ( ( 'Businessx' != businessx_extensions_theme() ) && ( 'Businessx' != businessx_extensions_theme( true ) ) ) {
		$businessx_extensions_errors[] = sprintf(
			__( 'You need to have %s theme in order to use Businessx Extensions plugin.', 'businessx-extensions' ),
			'<a href="' . BUSINESSX_EXTS_THEME_URL . '" target="_blank">' . BUSINESSX_EXTS_THEME_NAME . '</a>'
		);
	}

	if( defined( 'BUSINESSX_EXTS_PRO_PATH' ) ){
		$businessx_extensions_errors[] = __( 'There is no need for activating Businessx Extensions. You already have the Pro version of Businessx which includes this plugin.', 'businessx-extensions' );
	}

	return $businessx_extensions_errors;
}



/*
	Needed functions
	----------------
	Sanitization functions are included in the theme. (../acosmin/function/sanitization.php)
	Icons function are included in the theme. (../acosmin/function/icons.php)
	Some other used functions (../acosmin/function/helpers.php)
*/
if ( ( 'Businessx' == businessx_extensions_theme() ) || ( 'Businessx' == businessx_extensions_theme( true ) ) ) :
	require_once ( dirname( __FILE__ ) . '/inc/templating.php' );
	require_once ( dirname( __FILE__ ) . '/inc/scripts/scripts.php' );
	require_once ( dirname( __FILE__ ) . '/inc/sidebars/register.php' );
	require_once ( dirname( __FILE__ ) . '/inc/functions/helpers.php' );
	require_once ( dirname( __FILE__ ) . '/inc/customizer/customizer.php' );
	require_once ( dirname( __FILE__ ) . '/inc/customizer/sections-widgets/init.php' );
	require_once ( dirname( __FILE__ ) . '/inc/customizer/sections-widgets/styles.php' );
endif;
