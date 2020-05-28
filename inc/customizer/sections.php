<?php
/**
 * Customizer sections.
 *
 * @package ArchDuke
 */

/**
 * Register the section sections.
 *
 * @author WDS
 * @param object $wp_customize Instance of WP_Customize_Class.
 */
function archd_customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'archd_additional_scripts_section',
		array(
			'title'    => esc_html__( 'Additional Scripts', 'archd' ),
			'priority' => 10,
			'panel'    => 'site-options',
		)
	);

	// Register a social links section.
	$wp_customize->add_section(
		'archd_social_links_section',
		array(
			'title'       => esc_html__( 'Social Media', 'archd' ),
			'description' => esc_html__( 'Links here power the display_social_network_links() template tag.', 'archd' ),
			'priority'    => 90,
			'panel'       => 'site-options',
		)
	);

	// Register a header section.
	$wp_customize->add_section(
		'archd_header_section',
		array(
			'title'    => esc_html__( 'Header Customizations', 'archd' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);

	// Register a footer section.
	$wp_customize->add_section(
		'archd_footer_section',
		array(
			'title'    => esc_html__( 'Footer Customizations', 'archd' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);
}
add_action( 'customize_register', 'archd_customize_sections' );
