<?php

namespace Liquipedia\LiquiFlow;

use Hooks;
use OutputPage;
use SkinTemplate;

/**
 * SkinTemplate class for LiquiFlow skin
 * @ingroup Skins
 */
class Skin extends SkinTemplate {

	public $skinname = 'liquiflow';
	public $stylename = 'LiquiFlow';
	public $template = 'Liquipedia\\LiquiFlow\\Template';

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$config = $out->getConfig();

		if ( $out->getUser()->getBoolOption( 'teamliquidintegration-enable-beta-features' ) ) {
			$out->addHeadItem( 'migratetrace', '<script>jQuery.migrateTrace = true;</script>' );
		}

		// Edge compatibility mode (don't run in outdated compat)
		$out->addHeadItem( 'ie-edge', '<meta http-equiv="X-UA-Compatible" content="IE=edge">' );

		// Meta tags for mobile
		$out->addHeadItem( 'responsive', '<meta name="viewport" content="width=device-width, initial-scale=1.0">' );
		$out->addHeadItem( 'theme-color', '<meta name="theme-color" content="' . Colors::getSkinColors( substr( $config->get( 'ScriptPath' ), 1 ), 'wiki-dark' ) . '">' );

		Hooks::run( 'LiquiFlowStartCode', [ &$out ] );

		$scripts = [ 'skins.liquiflow.scripts', 'skins.liquiflow.bottom' ];
		$out->addModuleScripts( $scripts );
		if ( $this->getSkin()->getUser()->getOption( 'liquiflow-prefs-show-dropdown-on-hover' ) == true ) {
			$out->addModuleScripts( 'skins.liquiflow.hoverdropdown' );
		}

		if ( $out->msg( 'liquiflow-js-urls' )->exists() ) {
			$urlScripts = $out->msg( 'liquiflow-js-urls' )->plain();
			$urlScripts = explode( "\n", $urlScripts );
			foreach ( $urlScripts as $urlId => $urlScript ) {
				if ( strpos( trim( $urlScript ), '*' ) !== 0 ) {
					continue;
				}
				$urlScript = str_replace( $out->msg( 'liquiflow-cache-version-placeholder' )->text(), $out->msg( 'liquiflow-cache-version' )->text(), str_replace( '|', '%7C', ltrim( trim( $urlScript ), '* ' ) ) );
				$out->addHeadItem( 'liquiflow-script-' . $urlId, "<script src=\"" . $urlScript . "\"></script>\n" );
			}
		}
	}

	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$scriptPath = $out->getConfig()->get( 'ScriptPath' );
		$user = $this->getSkin()->getUser();

		$out->addStyle( 'https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic%7CDroid+Sans+Mono%7CRoboto:500%7CSource+Code+Pro:400,700' );
		$styles = [ 'mediawiki.skinning.interface', 'skins.liquiflow.styles' ];
		$out->addModuleStyles( $styles );
		if ( $out->getResourceLoader()->isModuleRegistered( 'skins.liquiflow.theme.' . substr( $scriptPath, 1 ) ) ) {
			$out->addModuleStyles( 'skins.liquiflow.theme.' . substr( $scriptPath, 1 ) );
		} else {
			$out->addModuleStyles( 'skins.liquiflow.theme.commons' );
		}
		if ( $user->isLoggedIn() ) {
			$out->addModuleStyles( 'skins.liquiflow.loggedin' );
		}

		$liquiflowCssUrls = $out->msg( 'liquiflow-css-urls' );
		if ( $liquiflowCssUrls->exists() ) {
			$urlStyles = $liquiflowCssUrls->plain();
			$urlStyles = explode( "\n", $urlStyles );
			foreach ( $urlStyles as $urlStyle ) {
				if ( strpos( trim( $urlStyle ), '*' ) !== 0 ) {
					continue;
				}
				$urlStyle = str_replace( $out->msg( 'liquiflow-cache-version-placeholder' )->text(), $out->msg( 'liquiflow-cache-version' )->text(), str_replace( '|', '%7C', ltrim( trim( $urlStyle ), '* ' ) ) );
				if ( !empty( $urlStyle ) && strlen( $urlStyle ) > 0 ) {
					$out->addStyle( $urlStyle );
				}
			}
		}
	}

	/**
	 * Return values for <html> element
	 * @return array Array of associative name-to-value elements for <html> element
	 */
	public function getHtmlElementAttributes() {
		$lang = $this->getLanguage();
		return [
			'lang' => $lang->getHtmlCode(),
			'dir' => $lang->getDir(),
			'class' => 'client-nojs Send_pizza_to_FO-nTTaX All_glory_to_Liquipedia',
			'prefix' => 'og: http://ogp.me/ns#',
		];
	}

}

// MediaWiki can't handle a namespaced \SkinTemplate without an alias
class_alias( Skin::class, 'SkinLiquiFlow' );
