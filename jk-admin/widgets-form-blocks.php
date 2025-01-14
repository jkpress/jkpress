<?php
/**
 * The block-based widgets editor, for use in widgets.php.
 *
 * @package JKPress
 * @subpackage Administration
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Flag that we're loading the block editor.
$current_screen = get_current_screen();
$current_screen->is_block_editor( true );

$block_editor_context = new JK_Block_Editor_Context( array( 'name' => 'core/edit-widgets' ) );

$preload_paths = array(
	array( rest_get_route_for_post_type_items( 'attachment' ), 'OPTIONS' ),
	'/jk/v2/widget-types?context=edit&per_page=-1',
	'/jk/v2/sidebars?context=edit&per_page=-1',
	'/jk/v2/widgets?context=edit&per_page=-1&_embed=about',
);
block_editor_rest_api_preload( $preload_paths, $block_editor_context );

$editor_settings = get_block_editor_settings(
	array_merge( get_legacy_widget_block_editor_settings(), array( 'styles' => get_block_editor_theme_styles() ) ),
	$block_editor_context
);

// The widgets editor does not support the Block Directory, so don't load any of
// its assets. This also prevents 'jk-editor' from being enqueued which we
// cannot load in the widgets screen because many widget scripts rely on `jk.editor`.
remove_action( 'enqueue_block_editor_assets', 'jk_enqueue_editor_block_directory_assets' );

jk_add_inline_script(
	'jk-edit-widgets',
	sprintf(
		'jk.domReady( function() {
			jk.editWidgets.initialize( "widgets-editor", %s );
		} );',
		jk_json_encode( $editor_settings )
	)
);

// Preload server-registered block schemas.
jk_add_inline_script(
	'jk-blocks',
	'jk.blocks.unstable__bootstrapServerSideBlockDefinitions(' . jk_json_encode( get_block_editor_server_block_settings() ) . ');'
);

// Preload server-registered block bindings sources.
$registered_sources = get_all_registered_block_bindings_sources();
if ( ! empty( $registered_sources ) ) {
	$filtered_sources = array();
	foreach ( $registered_sources as $source ) {
		$filtered_sources[] = array(
			'name'        => $source->name,
			'label'       => $source->label,
			'usesContext' => $source->uses_context,
		);
	}
	$script = sprintf( 'for ( const source of %s ) { jk.blocks.registerBlockBindingsSource( source ); }', jk_json_encode( $filtered_sources ) );
	jk_add_inline_script(
		'jk-blocks',
		$script
	);
}

jk_add_inline_script(
	'jk-blocks',
	sprintf( 'jk.blocks.setCategories( %s );', jk_json_encode( get_block_categories( $block_editor_context ) ) ),
	'after'
);

jk_enqueue_script( 'jk-edit-widgets' );
jk_enqueue_script( 'admin-widgets' );
jk_enqueue_style( 'jk-edit-widgets' );

/** This action is documented in jk-admin/edit-form-blocks.php */
do_action( 'enqueue_block_editor_assets' );

/** This action is documented in jk-admin/widgets-form.php */
do_action( 'sidebar_admin_setup' );

require_once ABSPATH . 'jk-admin/admin-header.php';

/** This action is documented in jk-admin/widgets-form.php */
do_action( 'widgets_admin_page' );
?>

<div id="widgets-editor" class="blocks-widgets-container">
	<?php // JavaScript is disabled. ?>
	<div class="wrap hide-if-js widgets-editor-no-js">
		<h1 class="jk-heading-inline"><?php echo esc_html( $title ); ?></h1>
		<?php
		if ( file_exists( JK_PLUGIN_DIR . '/classic-widgets/classic-widgets.php' ) ) {
			// If Classic Widgets is already installed, provide a link to activate the plugin.
			$installed           = true;
			$plugin_activate_url = jk_nonce_url( 'plugins.php?action=activate&amp;plugin=classic-widgets/classic-widgets.php', 'activate-plugin_classic-widgets/classic-widgets.php' );
			$message             = sprintf(
				/* translators: %s: Link to activate the Classic Widgets plugin. */
				__( 'The block widgets require JavaScript. Please enable JavaScript in your browser settings, or activate the <a href="%s">Classic Widgets plugin</a>.' ),
				esc_url( $plugin_activate_url )
			);
		} else {
			// If Classic Widgets is not installed, provide a link to install it.
			$installed          = false;
			$plugin_install_url = jk_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=classic-widgets' ), 'install-plugin_classic-widgets' );
			$message            = sprintf(
				/* translators: %s: A link to install the Classic Widgets plugin. */
				__( 'The block widgets require JavaScript. Please enable JavaScript in your browser settings, or install the <a href="%s">Classic Widgets plugin</a>.' ),
				esc_url( $plugin_install_url )
			);
		}
		/**
		 * Filters the message displayed in the block widget interface when JavaScript is
		 * not enabled in the browser.
		 *
		 * @since 6.4.0
		 *
		 * @param string $message The message being displayed.
		 * @param bool   $installed Whether the Classic Widget plugin is installed.
		 */
		$message = apply_filters( 'block_widgets_no_javascript_message', $message, $installed );
		jk_admin_notice(
			$message,
			array(
				'type'               => 'error',
				'additional_classes' => array( 'hide-if-js' ),
			)
		);
		?>
	</div>
</div>

<?php
/** This action is documented in jk-admin/widgets-form.php */
do_action( 'sidebar_admin_page' );

require_once ABSPATH . 'jk-admin/admin-footer.php';