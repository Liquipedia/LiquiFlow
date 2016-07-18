<?php

/**
 * SkinTemplate class for LiquiFlow skin
 * @ingroup Skins
 */
class SkinLiquiFlow extends SkinTemplate {
	public $skinname = 'liquiflow';
	public $stylename = 'LiquiFlow';
	public $template = 'LiquiFlowTemplate';

	protected static $bodyId = 'top';

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {

		
		parent::initPage( $out );

		// add text to recruit people from landing page
		$out->addHeadItem('recruitment', 
			"<!-- \n" .
			"\t _ _             _                _ _       \n" .
			"\t| (_) __ _ _   _(_)_ __   ___  __| (_) __ _ \n" .
			"\t| | |/ _` | | | | | '_ \ / _ \/ _` | |/ _` |\n" .
			"\t| | | (_| | |_| | | |_) |  __/ (_| | | (_| |\n" .
			"\t|_|_|\__, |\__,_|_| .__/ \___|\__,_|_|\__,_|\n" .
			"\t        |_|       |_|                       \n" .
			"\n" .
			"\tHi you, yes you who's looking at our source code! Are you a website specialist?\n" .
			"\tWe are looking for people to help us with our templates, especially with mobile development.\n" .
			"\tIf you want to help, be sure to visit us on our IRC channel #liquipedia on QuakeNet,\n" .
			"\tor send us an email to liquipedia <at> teamliquid <dot> net!\n" .
			"-->");

		// Append CSS which includes IE only behavior fixes for hover support -
		// this is better than including this in a CSS file since it doesn't
		// wait for the CSS file to load before fetching the HTC file.
		// $min = $this->getRequest()->getFuzzyBool( 'debug' ) ? '' : '.min';
		
		$out->addHeadItem( 'ie-edge', "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">");
		$out->addHeadItem( 'x-ie8-fix',
			"<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n" .
		"<!--[if lt IE 9]>\n" .
		"<script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>\n" .
		"<script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>\n" .
		"<![endif]-->");
		$out->addHeadItem( 'responsive', "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">");

		Hooks::run( 'LiquiFlowAdStartCode', array( __DIR__, &$out ) );
		
		$out->addModuleScripts( 'skins.liquiflow' );
		if ($this->getSkin()->getUser()->getOption ( 'liquiflow-prefs-show-dropdown-on-hover' ) == true) {
			$out->addModuleScripts( 'skins.liquiflow.hoverdropdown' );
		}
		if ($this->getSkin()->getUser()->getOption ( 'liquiflow-prefs-use-codemirror' ) == true) {
			$out->addModuleScripts( 'skins.liquiflow.codemirror' );
		}
	}
	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$out->addStyle( 'https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic%7CRoboto:500' );
		$styles = array( 'mediawiki.skinning.interface', 'skins.liquiflow' );
		$out->addModuleStyles( $styles );
		global $wgScriptPath;
		if( $out->getResourceLoader()->isModuleRegistered( 'skins.liquiflow.theme.' . substr($wgScriptPath, 1) ) ) {
			$out->addModuleStyles( 'skins.liquiflow.theme.' . substr($wgScriptPath, 1) );
		} else {
			$out->addModuleStyles( 'skins.liquiflow.theme.commons' );
		}
		if ($this->getSkin()->getUser()->isLoggedIn()) {
			$out->addModuleStyles( 'skins.liquiflow.loggedin' );
		}
		if ($this->getSkin()->getUser()->getOption ( 'liquiflow-prefs-use-codemirror' ) == true) {
			$out->addModuleStyles( 'skins.liquiflow.codemirror' );
		}
	}

	/**
	 * Adds classes to the body element.
	 *
	 * @param OutputPage $out
	 * @param array &$bodyAttrs Array of attributes that will be set on the body element
	 */
	function addToBodyAttributes( $out, &$bodyAttrs ) {
		$bodyAttrs['id'] = static::$bodyId;
		if ($this->getSkin()->getUser()->isLoggedIn()) {
			$bodyAttrs['class'] .= ' logged-in';
		} else {
			$bodyAttrs['class'] .= ' logged-out';
		}
	}
}
