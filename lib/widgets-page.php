<?php
/**
 * Bootstraping the Gutenberg widgets page.
 *
 * @package gutenberg
 */

/**
 * The main entry point for the Gutenberg widgets page.
 *
 * @since 5.2.0
 */
function the_gutenberg_widgets() {
	?>
	<div id="widgets-editor" class="blocks-widgets-container">
	</div>
	<?php
}

/**
 * Initialize the Gutenberg widgets page.
 *
 * @since 5.2.0
 *
 * @param string $hook Page.
 */
function gutenberg_widgets_init( $hook ) {
	if ( 'gutenberg_page_gutenberg-widgets' !== $hook ) {
			return;
	}

	$block_editor_settings = apply_filters( 'block_editor_settings', $editor_settings, $post );

	wp_add_inline_script(
		'wp-edit-widgets',
		sprintf(
			'wp.editWidgets.initialize( "widgets-editor", %s );',
			wp_json_encode( $block_editor_settings )
		)
	);
	// Preload server-registered block schemas.
	wp_add_inline_script(
		'wp-blocks',
		'wp.blocks.unstable__bootstrapServerSideBlockDefinitions(' . wp_json_encode( get_block_editor_server_block_settings() ) . ');'
	);
	wp_enqueue_script( 'wp-edit-widgets' );
	wp_enqueue_style( 'wp-edit-widgets' );
}
add_action( 'admin_enqueue_scripts', 'gutenberg_widgets_init' );
