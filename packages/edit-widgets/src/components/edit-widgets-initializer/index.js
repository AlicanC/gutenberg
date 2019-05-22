/**
 * External dependencies
 */
import { pick } from 'lodash';

/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { useEffect, useMemo } from '@wordpress/element';
import { withDispatch } from '@wordpress/data';

/**
 * Internal dependencies
 */
import Layout from '../layout';
import WidgetBlockEditorSettings from '../widget-block-editor-settings';

function EditWidgetsInitializer( { setupWidgetAreas, settings } ) {
	useEffect( () => {
		setupWidgetAreas();
	}, [] );
	const blockEditorSettings = useMemo(
		() => (
			pick( settings, [
				'allowedBlockTypes',
				'availableLegacyWidgets',
				'bodyPlaceholder',
				'colors',
				'disableCustomColors',
				'disableCustomFontSizes',
				'focusMode',
				'fontSizes',
				'hasFixedToolbar',
				'hasPermissionsToManageWidgets',
				'imageSizes',
				'isRTL',
				'maxWidth',
				'styles',
			] )
		),
		[ settings ]
	);
	return (
		<WidgetBlockEditorSettings.Provider
			value={ blockEditorSettings }
		>
			<Layout />
		</WidgetBlockEditorSettings.Provider>
	);
}

export default compose( [
	withDispatch( ( dispatch ) => {
		const { setupWidgetAreas } = dispatch( 'core/edit-widgets' );
		return {
			setupWidgetAreas,
		};
	} ),
] )( EditWidgetsInitializer );
