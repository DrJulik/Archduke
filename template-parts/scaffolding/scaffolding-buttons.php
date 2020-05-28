<?php
/**
 * The template used for displaying Buttons in the scaffolding library.
 *
 * @package ArchDuke
 */

?>

<section class="section-scaffolding">

	<h2 class="scaffolding-heading"><?php esc_html_e( 'Buttons', 'archd' ); ?></h2>
	<?php
		// Button.
		archd_display_scaffolding_section(
			array(
				'title'       => 'Button',
				'description' => 'Display a button.',
				'usage'       => '<button class="button" href="#">Click Me</button>',
				'output'      => '<button class="button">Click Me</button>',
			)
		);
	?>
</section>
