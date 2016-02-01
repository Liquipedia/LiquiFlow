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

		// Append CSS which includes IE only behavior fixes for hover support -
		// this is better than including this in a CSS file since it doesn't
		// wait for the CSS file to load before fetching the HTC file.
		// $min = $this->getRequest()->getFuzzyBool( 'debug' ) ? '' : '.min';
		
		$out->addHeadItem( 'ie-edge',  "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">");
		$out->addHeadItem( 'x-ie8-fix',
			"<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n" .
    		"<!--[if lt IE 9]>\n" .
      		"<script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>\n" .
      		"<script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>\n" .
    		"<![endif]-->");
		$out->addHeadItem( 'responsive', "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">");

		global $tlAdCode;
		include ('TLAdHeader.inc');
		$out->addHeadItem( 'tlads', $tlAdCode);
                
		$out->addModuleScripts( 'skins.liquiflow' );
                if ($this->getSkin()->getUser()->getOption ( 'liquiflow-prefs-show-dropdown-on-hover' ) == true) {
                    $out->addModuleScripts( 'skins.liquiflow.hoverdropdown' );
                }
        }
	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$styles = array( 'mediawiki.skinning.interface', 'skins.liquiflow' );
		$out->addModuleStyles( $styles );
		if ($this->getSkin()->getUser()->isLoggedIn()) {
			$out->addModuleStyles( 'skins.liquiflow.loggedin' );
		}

                global $wgScriptPath;
		$out->addModuleStyles( 'skins.liquiflow.theme.' . substr($wgScriptPath, 1));
	}

	/**
	 * Adds classes to the body element.
	 *
	 * @param OutputPage $out
	 * @param array &$bodyAttrs Array of attributes that will be set on the body element
	 */
	function addToBodyAttributes( $out, &$bodyAttrs ) {
		$bodyAttrs['id'] = static::$bodyId;
	}
}
