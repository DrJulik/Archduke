<?php
/**
 * Custom scripts and styles.
 *
 * @package ArchDuke
 */

/**
 * Register Google font.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 * @author WDS
 * @return string
 */
function archd_font_url() {

	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by the following, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$lato    = esc_html_x( 'on', 'lato font: on or off', 'archd' );
	$playfair_display = esc_html_x( 'on', 'Playfair Display font: on or off', 'archd' );

	if ( 'off' !== $playfair_display || 'off' !== $playfair_display ) {
		$font_families = array();

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:400,700';
		}

		if ( 'off' !== $playfair_display ) {
			$font_families[] = 'Playfair Display:400,300,700';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 *
 * @author WDS
 */
function archd_scripts() {
	/**
	 * If WP is in script debug, or we pass ?script_debug in a URL - set debug to true.
	 */
	$debug = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) || ( isset( $_GET['script_debug'] ) ) ? true : false; // WPCS: CSRF OK.

	/**
	 * If we are debugging the site, use a unique version every page load so as to ensure no cache issues.
	 */
	$version = '1.0.0';

	/**
	 * Should we load minified files?
	 */
	$suffix = ( true === $debug ) ? '' : '.min';

	/**
	 * Global variable for IE.
	 */
	global $is_IE; // @codingStandardsIgnoreLine

	// Register styles & scripts.
	wp_register_style( 'archd-google-font', archd_font_url(), array(), null ); // @codingStandardsIgnoreLine - required to avoid Google caching issues.
	wp_register_style( 'slick-carousel', get_template_directory_uri() . '/assets/bower_components/slick-carousel/slick/slick.css', null, '1.8.1' );
	wp_register_script( 'slick-carousel', get_template_directory_uri() . '/assets/bower_components/slick-carousel/slick/slick' . $suffix . '.js', array( 'jquery' ), '1.8.1', true );

	// Enqueue styles.
	wp_enqueue_style( 'archd-google-font' );
	wp_enqueue_style( 'archd-style', get_stylesheet_directory_uri() . '/style' . $suffix . '.css', array(), $version );

	// Enqueue scripts.
	if ( $is_IE ) {
		wp_enqueue_script( 'archd-babel-polyfill', get_template_directory_uri() . '/assets/scripts/babel-polyfill.min.js', array(), $version, true );
	}

	wp_enqueue_script( 'archd-scripts', get_template_directory_uri() . '/assets/scripts/project' . $suffix . '.js', array( 'jquery' ), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue the scaffolding Library script.
	if ( is_page_template( 'template-scaffolding.php' ) ) {
		wp_enqueue_script( 'archd-scaffolding', get_template_directory_uri() . '/assets/scripts/scaffolding' . $suffix . '.js', array( 'jquery' ), $version, true );
	}
}
add_action( 'wp_enqueue_scripts', 'archd_scripts' );

/**
 * Enqueue Slick scripts. This is done to avoid enqueueing scripts in the wrong spot by enqueuing them directly.
 *
 * @author Corey Collins
 */
function archd_enqueue_slick_scripts() {
	wp_enqueue_style( 'slick-carousel' );
	wp_enqueue_script( 'slick-carousel' );
}
add_action( 'wp_enqueue_scripts', 'archd_enqueue_slick_scripts' );

/**
 * Enqueue scripts for the customizer.
 *
 * @author Corey Collins
 */
function archd_customizer_scripts() {

	/**
	 * If WP is in script debug, or we pass ?script_debug in a URL - set debug to true.
	 */
	$debug = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) || ( isset( $_GET['script_debug'] ) ) ? true : false; // WPCS: CSRF OK.

	/**
	 * If we are debugging the site, use a unique version every page load so as to ensure no cache issues.
	 */
	$version = '1.0.0';

	/**
	 * Should we load minified files?
	 */
	$suffix = ( true === $debug ) ? '' : '.min';

	wp_enqueue_script( 'archd_customizer', get_template_directory_uri() . '/assets/scripts/customizer' . $suffix . '.js', array( 'jquery' ), $version, true );
}
add_action( 'customize_controls_enqueue_scripts', 'archd_customizer_scripts' );

/**
 * Add SVG definitions to footer.
 *
 * @author WDS
 */
function archd_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once $svg_icons;
	}
}
add_action( 'wp_footer', 'archd_include_svg_icons', 9999 );
