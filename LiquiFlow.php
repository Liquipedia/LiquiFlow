<?php

$GLOBALS['wgExtensionCredits']['skin'][] = array(
	'path' => __FILE__,
	'name' => 'LiquiFlow',
	'namemsg' => 'skinname-liquiflow',
	'descriptionmsg' => 'liquiflow-skin-desc',
	'url' => '',
	'author' => array( 'Philip Becker-Ehmck and others' ),
	'license-name' => 'GPLv2+',
);

// Register files
$GLOBALS['wgAutoloadClasses']['SkinLiquiFlow'] = __DIR__ . '/SkinLiquiFlow.php';
$GLOBALS['wgAutoloadClasses']['LiquiFlowTemplate'] = __DIR__ . '/LiquiFlowTemplate.php';
$wgExtensionMessagesFiles['SkinLiquiFlow'] = __DIR__ . '/LiquiFlow.i18n.php';


// Register skin
$wgValidSkinNames['liquiflow'] = 'LiquiFlow';
$wgLiquiFlowWikiTitle = 'StarCraft II';
$wgLiquiFlowSkinTheme = 'themes/starcraft-2.css';

// Register modules
$wgResourceModules['skins.liquiflow'] = array(
	'styles' => array(
		'font.css' => array( 'position' => 'top' ),
		'font-awesome/css/font-awesome.min.css',
		$wgLiquiFlowSkinTheme => array( 'position' => 'top' ),
	),
	'scripts' => array(
		'js/jquery.min.js',
		//'js/jquery-ui.min.js',
		'js/bootstrap.min.js',
		'js/toc.js',
		'js/lp.js',						
		'js/hover-dropdown.js',
		'js/ie10-viewport-bug-workaround.js',
	),
	'dependencies' => array(
		'mw.user',
	),
	'remoteSkinPath' => 'LiquiFlow',
	'localBasePath' => __DIR__,
);

$wgResourceModules['skins.liquiflowloggedin'] = array(
	'styles' => array(
		'themes/loggedin.css' => array( 'media' => 'screen' ),
	),
	'remoteSkinPath' => 'LiquiFlow',
	'localBasePath' => __DIR__,
);

