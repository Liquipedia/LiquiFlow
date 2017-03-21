<?php

/**
 * Callback functions for hooks
 *
 * @author Marco Ammon <ammon.marco@t-online.de>
 */
class LiquiFlowHooks {

	//Add skin-specific user preferences (registered in skin.json)    
	public static function onGetPreferences($user, &$preferences) {
		//Toggle setting to show dropdown menus on hover instead of click
		$preferences['liquiflow-prefs-show-dropdown-on-hover'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-dropdown-on-hover', // a system message
			'section' => 'rendering/liquiflow'
		);
		$preferences['liquiflow-prefs-use-codemirror'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-use-codemirror', // a system message
			'section' => 'editing/liquiflow'
		);/*
		$preferences['liquiflow-prefs-use-codemirror-linewrap'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-use-codemirror-linewrap', // a system message
			'section' => 'editing/liquiflow'
		);*/
		$preferences['liquiflow-prefs-show-buggy-editor-tabs'] = array(
			'type' => 'check',
			'label-message' => 'liquiflow-prefs-show-buggy-editor-tabs', // a system message
			'section' => 'editing/liquiflow'
		);
		//Default return value for hooks
		return true;
	}

	public static function onMakeGlobalVariablesScript( array &$vars, OutputPage $out ) {
		$context = $out->getContext();
		global $wgParser;
		// add CodeMirror vars only for edit pages
		$contObj = $context->getLanguage();

		if ( !isset( $wgParser->mFunctionSynonyms ) ) {
			$wgParser->initialiseVariables();
			$wgParser->firstCallInit();
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
			'liquiflowCodemirrorTags' => array_fill_keys( $wgParser->getTags(), true ),
			'liquiflowCodemirrorDoubleUnderscore' => array( array(), array() ),
			'liquiflowCodemirrorFunctionSynonyms' => $wgParser->mFunctionSynonyms,
			'liquiflowCodemirrorUrlProtocols' => $wgParser->mUrlProtocols,
			'liquiflowCodemirrorLinkTrailCharacters' =>  $contObj->linkTrail(),
		);

		$mw = $contObj->getMagicWords();
		foreach ( MagicWord::getDoubleUnderscoreArray()->names as $name ) {
			if ( isset( $mw[$name] ) ) {
				$caseSensitive = array_shift( $mw[$name] ) == 0 ? 0 : 1;
				foreach ( $mw[$name] as $n ) {
					$vars['liquiflowCodemirrorDoubleUnderscore'][$caseSensitive][ $caseSensitive ? $n : $contObj->lc( $n ) ] = $name;
				}
			} else {
				$vars['liquiflowCodemirrorDoubleUnderscore'][0][] = $name;
			}
		}

		foreach ( MagicWord::getVariableIDs() as $name ) {
			if ( isset( $mw[$name] ) ) {
				$caseSensitive = array_shift( $mw[$name] ) == 0 ? 0 : 1;
				foreach ( $mw[$name] as $n ) {
					$vars['liquiflowCodemirrorFunctionSynonyms'][$caseSensitive][ $caseSensitive ? $n : $contObj->lc( $n ) ] = $name;
				}
			}
		}
	}

	public static function onLinkerMakeExternalLink( &$url, &$text, &$link, &$attribs, $linktype ) {
		$attribs['rel'] .= ' noopener';
		return true;
	}

	public static function onBeforePageDisplay( OutputPage &$out, Skin &$skin ) {
		if ( $skin->skinname == 'liquiflow' && $skin->getUser()->getOption ( 'liquiflow-prefs-use-codemirror' ) == true ) {
			$out->addModules( 'skins.liquiflow.codemirror' );
		}
	}

	public static function onOutputPageParserOutput( OutputPage &$out, ParserOutput $parserOutput ) {
		$parserOutput->setEditSectionTokens( true );
	}

}
