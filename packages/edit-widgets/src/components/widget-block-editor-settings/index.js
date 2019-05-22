/**
 * WordPress dependencies
 */
import { createContext } from '@wordpress/element';

/**
 * Reference to an empty object
 */
const EMPTY_OBJECT = {};
const WidgetBlockEditorSettings = createContext( EMPTY_OBJECT );
export default WidgetBlockEditorSettings;
