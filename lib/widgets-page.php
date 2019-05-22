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
	/** This action is documented in wp-admin/admin-footer.php */
	// phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
	do_action( 'admin_print_styles-widgets.php' );
	// phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
	do_action( 'admin_print_scripts-widgets.php' );
	?>
	<div id="widgets-editor" class="blocks-widgets-container">
	</div>
	<?php
	/** This action is documented in wp-admin/admin-footer.php */
	// phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
	do_action( 'admin_footer-widgets.php' );
	/** This action is documented in wp-admin/admin-footer.php */
	// phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
	do_action( 'admin_print_footer_scripts-widgets.php' );
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

	wp_add_inline_script(
		'wp-edit-widgets',
		'wp.editWidgets.initialize( "widgets-editor" );'
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
