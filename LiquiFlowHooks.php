<?php

/**
 * Callback functions for hooks
 */
class LiquiFlowHooks {
	// Add skin-specific user preferences (registered in skin.json)    
	public static function onGetPreferences( $user, &$preferences ) {
		// Toggle setting to show dropdown menus on hover instead of click
		$preferences['liquiflow-prefs-show-dropdown-on-hover'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-dropdown-on-hover',
			'section' => 'rendering/liquiflow'
		);

		// CodeMirror settings
		$preferences['liquiflow-prefs-use-codemirror-phone'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-use-codemirror-phone',
			'section' => 'editing/liquiflow'
		);
		$preferences['liquiflow-prefs-use-codemirror-tablet'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-use-codemirror-tablet',
			'section' => 'editing/liquiflow'
		);
		$preferences['liquiflow-prefs-use-codemirror'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-use-codemirror',
			'section' => 'editing/liquiflow'
		);
		$preferences['liquiflow-prefs-use-codemirror-linewrap'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-use-codemirror-linewrap',
			'section' => 'editing/liquiflow'
		);

		// Setting to show old editor tabs
		$preferences['liquiflow-prefs-show-buggy-editor-tabs'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-buggy-editor-tabs',
			'section' => 'editing/liquiflow'
		);

		// Setting for right click menu
		$preferences['liquiflow-prefs-show-rightclick-menu'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-rightclick-menu',
			'section' => 'rendering/liquiflow'
		);
		return true;
	}

	public static function onMakeGlobalVariablesScript( array &$vars, OutputPage $out ) {
		$config = $out->getConfig();
		$context = $out->getContext();
		// add CodeMirror vars only for edit pages
		if( in_array( $context->getRequest()->getText( 'action' ), array( 'edit', 'submit' ) ) ) {
			$parser = $config->get( 'Parser' );
			$contObj = $context->getLanguage();

			if( !isset( $parser->mFunctionSynonyms ) ) {
				$parser->initialiseVariables();
				$parser->firstCallInit();
			}

			// initialize global vars
			$vars += array(
				'liquiflowCodemirrorExtModes' => array(
					'tag' => array(
						'pre' => 'mw-tag-pre',
						'nowiki' => 'mw-tag-nowiki',
					),
					'func' => array(),
					'data' => array(),
				),
				'liquiflowCodemirrorTags' => array_fill_keys( $parser->getTags(), true ),
				'liquiflowCodemirrorDoubleUnderscore' => array( array(), array() ),
				'liquiflowCodemirrorFunctionSynonyms' => $parser->mFunctionSynonyms,
				'liquiflowCodemirrorUrlProtocols' => $parser->mUrlProtocols,
				'liquiflowCodemirrorLinkTrailCharacters' =>  $contObj->linkTrail(),
			);

			$mw = $contObj->getMagicWords();
			foreach( MagicWord::getDoubleUnderscoreArray()->names as $name ) {
				if( isset( $mw[$name] ) ) {
					$caseSensitive = array_shift( $mw[$name] ) == 0 ? 0 : 1;
					foreach( $mw[$name] as $n ) {
						$vars['liquiflowCodemirrorDoubleUnderscore'][$caseSensitive][$caseSensitive ? $n : $contObj->lc( $n )] = $name;
					}
				} else {
					$vars['liquiflowCodemirrorDoubleUnderscore'][0][] = $name;
				}
			}

			foreach( MagicWord::getVariableIDs() as $name ) {
				if( isset( $mw[$name] ) ) {
					$caseSensitive = array_shift( $mw[$name] ) == 0 ? 0 : 1;
					foreach( $mw[$name] as $n ) {
						$vars['liquiflowCodemirrorFunctionSynonyms'][$caseSensitive][$caseSensitive ? $n : $contObj->lc( $n )] = $name;
					}
				}
			}
		}
		$vars += array(
			'liquiflowCacheVersion' => wfMessage( 'liquiflow-cache-version' )->text(),
		);
	}

	public static function onBeforePageDisplay( OutputPage &$out, Skin &$skin ) {
		if ( $skin->skinname == 'liquiflow' && $skin->getUser()->getOption( 'liquiflow-prefs-use-codemirror' ) == true ) {
			$out->addModules( 'skins.liquiflow.codemirror' );
		}
	}

	public static function onResourceLoaderGetLessVars( &$lessVars ) {
		global $wgScriptPath;
		$lessVars = array_merge( $lessVars, LiquiFlowColors::getSkinColors( substr( $wgScriptPath, 1 ) ) );
	}

}
