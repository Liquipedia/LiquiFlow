<?php

namespace Liquipedia\LiquiFlow;
use \ExtensionRegistry;
use \Hooks as MWHooks;
use \Html;
use \OutputPage;
use \SkinTemplate;

/**
 * SkinTemplate class for LiquiFlow skin
 * @ingroup Skins
 */
class Skin extends SkinTemplate {
	public $skinname = 'liquiflow';
	public $stylename = 'LiquiFlow';
	public $template = 'Liquipedia\\LiquiFlow\\Template';

	protected static $bodyId = 'top';

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$config = $out->getConfig();
		$title = $this->getTitle();
		$faviconPath = $config->get( 'StylePath' ) . '/LiquiFlow/images/favicon/';

		// Do stuff for SEO
		if( ExtensionRegistry::getInstance()->isLoaded( 'TextExtracts' ) ) {

			if( $title && $title->exists() ) {
				// Try to find a good image
				$matches = null;
				preg_match_all( '/class="infobox-image".*?src="([^\\\"]+)"/' , $out->getHTML(), $matches );
				if( isset( $matches[1] ) && isset( $matches[1][0] ) ) {
					$image = $matches[1][0];
					if( strpos( $image, 'http') !== 0 ) {
						$image = $config->get( 'Server' ) . $image;
					}
					// add meta description tag if doesn't exist already
					$api = new \ApiMain(
						new \DerivativeRequest(
							$this->getRequest(), // Fallback upon $wgRequest if you can't access context
							array(
								'action' => 'query',
								'exintro' => '',
								'explaintext' => '',
								'prop' => 'extracts',
								'titles' => $title->getFullText()
							),
							false // treat this as a POST
						),
						false // Enable write.
					);
					$api->execute();
					$result = $api->getResult()->getResultData();
					$result = $result['query']['pages'][$title->getArticleID()]['extract']['*'];
					if( !empty( $result ) && strlen( $result ) > 20 ) {
						$description = $result;
						$addAutoMeta = true;
						foreach( $out->getMetaTags() as $metaTag) {
							if( $metaTag[0] == 'description' ) {
								$addAutoMeta = false;
								$description = htmlspecialchars( $metaTag[1] );
							}
						}
						if( $addAutoMeta ) {
							$out->addMeta( 'description', $description );
						}

						$domain = str_replace( array( '/', 'http', 'https', ':' ), '', $config->get( 'Server' ) );
						$twitterAccount = '@LiquipediaNet';
						$out->addHeadItem( 'twitterproperties',
							Html::element( 'meta', [
									'name' => 'twitter:card',
									'content' => 'summary'
								] ) . "\n"
							. Html::element( 'meta', [
									'name' => 'twitter:site',
									'content' => $twitterAccount
								] ) . "\n"
							. Html::element( 'meta', [
									'name' => 'twitter:title',
									'content' => htmlspecialchars( $out->getPageTitle() )
								] ) . "\n"
							. Html::element( 'meta', [
									'name' => 'twitter:description',
									'content' => $description
								] ) . "\n"
							. Html::element( 'meta', [
									'name' => 'twitter:image:src',
									'content' => $image
								] ) . "\n"
							. Html::element( 'meta', [
									'name' => 'twitter:domain',
									'content' => $domain
								] )
						);
						$out->addHeadItem( 'ogproperties',
							Html::element( 'meta', [
									'property' => 'og:type',
									'content' => 'article'
								] ) . "\n"
							. Html::element( 'meta', [
									'property' => 'og:image',
									'content' => $image
								] ) . "\n"
							. Html::element( 'meta', [
									'property' => 'og:url',
									'content' => $title->getFullURL()
								] ) . "\n"
							. Html::element( 'meta', [
									'property' => 'og:title',
									'content' => htmlspecialchars( $out->getPageTitle() )
								] ) . "\n"
							. Html::element( 'meta', [
									'property' => 'og:description',
									'content' => $description
								] ) . "\n"
							. Html::element( 'meta', [
									'property' => 'og:site_name',
									'content' => $config->get( 'Sitename' )
								] )
						);
					}
				}
			}
		}
		$out->addHeadItem( 'canonicallink', '<link rel="canonical" href="' . $title->getFullURL() . '">' );

		// add text to recruit people from landing page
		$out->addHeadItem('recruitment',
			"<!-- \n"
			. "\t _ _             _                _ _       \n"
			. "\t| (_) __ _ _   _(_)_ __   ___  __| (_) __ _ \n"
			. "\t| | |/ _` | | | | | '_ \ / _ \/ _` | |/ _` |\n"
			. "\t| | | (_| | |_| | | |_) |  __/ (_| | | (_| |\n"
			. "\t|_|_|\__, |\__,_|_| .__/ \___|\__,_|_|\__,_|\n"
			. "\t        |_|       |_|                       \n"
			. "\n"
			. "\tHi you, yes you who's looking at our source code! Are you a website specialist?\n"
			. "\tWe are looking for people to help us with our templates, especially with mobile development.\n"
			. "\tIf you want to help, be sure to visit us on discord (http://liquipedia.net/discord), or send us\n"
			. "\tan email to liquipedia <at> teamliquid <dot> net!\n"
			. "-->");

		// Edge compatibility mode (don't run in outdated compat)
		$out->addHeadItem( 'ie-edge', '<meta http-equiv="X-UA-Compatible" content="IE=edge">' );

		// Meta tags for mobile
		$out->addHeadItem( 'responsive', '<meta name="viewport" content="width=device-width, initial-scale=1.0">');
		$out->addHeadItem( 'theme-color', '<meta name="theme-color" content="' . Colors::getSkinColors( substr( $config->get( 'ScriptPath' ), 1 ), 'wiki-dark' ) . '">' );

		// Favicons
		$out->addHeadItem( 'favicons', 
			'<link rel="apple-touch-icon" sizes="57x57" href="' . $faviconPath . 'apple-touch-icon-57x57.png" />'
			. '<link rel="apple-touch-icon" sizes="114x114" href="' . $faviconPath . 'apple-touch-icon-114x114.png" />'
			. '<link rel="apple-touch-icon" sizes="72x72" href="' . $faviconPath . 'apple-touch-icon-72x72.png" />'
			. '<link rel="apple-touch-icon" sizes="144x144" href="' . $faviconPath . 'apple-touch-icon-144x144.png" />'
			. '<link rel="apple-touch-icon" sizes="60x60" href="' . $faviconPath . 'apple-touch-icon-60x60.png" />'
			. '<link rel="apple-touch-icon" sizes="120x120" href="' . $faviconPath . 'apple-touch-icon-120x120.png" />'
			. '<link rel="apple-touch-icon" sizes="76x76" href="' . $faviconPath . 'apple-touch-icon-76x76.png" />'
			. '<link rel="apple-touch-icon" sizes="152x152" href="' . $faviconPath . 'apple-touch-icon-152x152.png" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-196x196.png" sizes="196x196" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-96x96.png" sizes="96x96" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-32x32.png" sizes="32x32" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-16x16.png" sizes="16x16" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-128x128.png" sizes="128x128" />'
			. '<meta name="application-name" content="' . $config->get( 'Sitename' ) . '"/>'
			. '<meta name="msapplication-TileColor" content="#ffffff" />'
			. '<meta name="msapplication-TileImage" content="' . $faviconPath . 'mstile-144x144.png" />'
			. '<meta name="msapplication-square70x70logo" content="' . $faviconPath . 'mstile-70x70.png" />'
			. '<meta name="msapplication-square150x150logo" content="' . $faviconPath . 'mstile-150x150.png" />'
			. '<meta name="msapplication-wide310x150logo" content="' . $faviconPath . 'mstile-310x150.png" />'
			. '<meta name="msapplication-square310x310logo" content="' . $faviconPath . 'mstile-310x310.png" />' );

		MWHooks::run( 'LiquiFlowStartCode', array( &$out ) );

		$scripts = array( 'skins.liquiflow', 'skins.liquiflow.bottom', 'jquery.chosen' );
		$out->addModuleScripts( $scripts );
		if( $this->getSkin()->getUser()->getOption( 'liquiflow-prefs-show-dropdown-on-hover' ) == true) {
			$out->addModuleScripts( 'skins.liquiflow.hoverdropdown' );
		}

		if( wfMessage( 'liquiflow-js-urls' )->exists() ) {
			$urlScripts = wfMessage( 'liquiflow-js-urls' )->plain();
			$urlScripts = explode( "\n", $urlScripts );
			foreach( $urlScripts as $urlId => $urlScript ) {
				if( strpos( trim( $urlScript) , '*' ) !== 0 ) {
					continue;
				}
				$urlScript = str_replace( wfMessage( 'liquiflow-cache-version-placeholder' )->text(), wfMessage( 'liquiflow-cache-version' )->text(), str_replace( '|', '%7C', ltrim( trim( $urlScript ), '* ' ) ) );
				$out->addHeadItem( 'liquiflow-script-' . $urlId, "<script src=\"" . $urlScript . "\"></script>\n" );
			}
		}
	}
	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		$scriptPath = $out->getConfig()->get( 'ScriptPath' );
		$user = $this->getSkin()->getUser();
		parent::setupSkinUserCss( $out );

		$out->addStyle( 'https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic%7CDroid+Sans+Mono%7CRoboto:500%7CSource+Code+Pro:400,700' );
		$styles = array( 'mediawiki.skinning.interface', 'skins.liquiflow', 'skins.liquiflow.bottom' );
		$out->addModuleStyles( $styles );
		if( $out->getResourceLoader()->isModuleRegistered( 'skins.liquiflow.theme.' . substr( $scriptPath, 1 ) ) ) {
			$out->addModuleStyles( 'skins.liquiflow.theme.' . substr( $scriptPath, 1 ) );
		} else {
			$out->addModuleStyles( 'skins.liquiflow.theme.commons' );
		}
		if ( $user->isLoggedIn() ) {
			$out->addModuleStyles( 'skins.liquiflow.loggedin' );
		}
		if ( !$user->getOption( 'liquiflow-prefs-show-buggy-editor-tabs' ) ) {
			$out->addModuleStyles( 'skins.liquiflow.removebuggyeditortabs' );
		}

		if( wfMessage( 'liquiflow-css-urls' )->exists() ) {
			$urlStyles = wfMessage( 'liquiflow-css-urls' )->plain();
			$urlStyles = explode( "\n", $urlStyles );
			foreach( $urlStyles as $urlStyle ) {
				if ( strpos( trim( $urlStyle ) , '*' ) !== 0 ) {
					continue;
				}
				$urlStyle = str_replace( wfMessage( 'liquiflow-cache-version-placeholder' )->text(), wfMessage( 'liquiflow-cache-version' )->text(), str_replace( '|', '%7C', ltrim( trim( $urlStyle ), '* ' ) ) );
				if( !empty( $urlStyle ) && strlen( $urlStyle ) > 0 ) {
					$out->addStyle( $urlStyle );
				}
			}
		}
	}

	/**
	 * Adds stuff to the body element.
	 *
	 * @param OutputPage $out
	 * @param array &$bodyAttrs Array of attributes that will be set on the body element
	 */
	function addToBodyAttributes( $out, &$bodyAttrs ) {
		$scriptPath = $out->getConfig()->get( 'ScriptPath' );
		$user = $this->getSkin()->getUser();
		$bodyAttrs['id'] = static::$bodyId;
		if ( $user->isLoggedIn() ) {
			$bodyAttrs['class'] .= ' logged-in';
		} else {
			$bodyAttrs['class'] .= ' logged-out';
		}
		$bodyAttrs['class'] .= ' wiki-' . substr( $scriptPath, 1 );
		if( $user->getOption( 'liquiflow-prefs-show-rightclick-menu' ) ) {
			$bodyAttrs['contextmenu'] = 'wiki-menu';
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
class_alias( 'Liquipedia\LiquiFlow\Skin', 'SkinLiquiFlow' );