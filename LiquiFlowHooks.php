<?php

namespace Liquipedia\LiquiFlow;

/**
 * Callback functions for hooks
 */
class LFHooks {

	// Add skin-specific user preferences (registered in skin.json)
	public static function onGetPreferences( $user, &$preferences ) {
		// Toggle setting to show dropdown menus on hover instead of click
		$preferences[ 'liquiflow-prefs-show-dropdown-on-hover' ] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-dropdown-on-hover',
			'section' => 'rendering/liquiflow'
		);

		// Setting to show old editor tabs
		$preferences[ 'liquiflow-prefs-show-buggy-editor-tabs' ] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-buggy-editor-tabs',
			'section' => 'editing/liquiflow'
		);

		// Setting for right click menu
		$preferences[ 'liquiflow-prefs-show-rightclick-menu' ] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-rightclick-menu',
			'section' => 'rendering/liquiflow'
		);
		return true;
	}

	public static function onMakeGlobalVariablesScript( array &$vars, \OutputPage $out ) {
		$vars += array(
			'liquiflowCacheVersion' => wfMessage( 'liquiflow-cache-version' )->text(),
		);
	}

	public static function onResourceLoaderRegisterModules( \ResourceLoader $rl ) {
		global $wgResourceLoaderLESSVars, $wgScriptPath;
		$wgResourceLoaderLESSVars = array_merge( $wgResourceLoaderLESSVars, Colors::getSkinColors( substr( $wgScriptPath, 1 ) ) );
	}

}
