<?php

namespace Liquipedia\LiquiFlow;

class Colors {

	private static $colors = array(
		'default' => array(
			'wiki-dark' => '#e6e6e6',
			'wiki-light' => '#4a4a4a',
			'body-bg' => '#e5e5e5',
		),
		'apexlegends' => array(
			'wiki-dark' => '#b12a2a',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'arenafps' => array(
			'wiki-dark' => '#4a4a4a',
			'wiki-light' => '#fbecdf',
			'body-bg' => '#e5e5e5',
		),
		'arenaofvalor' => array(
			'wiki-dark' => '#196b6b',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'artifact' => array(
			'wiki-dark' => '#4a4a4a',
			'wiki-light' => '#fbf6df',
			'body-bg' => '#e5e5e5',
		),
		'battlerite' => array(
			'wiki-dark' => '#955623',
			'wiki-light' => '#fbecdf',
			'body-bg' => '#e5e5e5',
		),
		'callofduty' => array(
			'wiki-dark' => '#54711b',
			'wiki-light' => '#dbeded',
			'body-bg' => '#e5e5e5',
		),
		'clashroyale' => array(
			'wiki-dark' => '#31519c',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'commons' => array(
			'wiki-dark' => '#e6e6e6',
			'wiki-light' => '#4a4a4a',
			'body-bg' => '#e5e5e5',
		),
		'counterstrike' => array(
			'wiki-dark' => '#54711b',
			'wiki-light' => '#f0f9de',
			'body-bg' => '#e5e5e5',
		),
		'crossfire' => array(
			'wiki-dark' => '#196b6b',
			'wiki-light' => '#fbecdf',
			'body-bg' => '#e5e5e5',
		),
		'dota2' => array(
			'wiki-dark' => '#b12a2a',
			'wiki-light' => '#fbdfdf',
			'body-bg' => '#e5e5e5',
		),
		'fifa' => array(
			'wiki-dark' => '#1e7a1d',
			'wiki-light' => '#fbf2df',
			'body-bg' => '#e5e5e5',
		),
		'fighters' => array(
			'wiki-dark' => '#1e7a1d',
			'wiki-light' => '#f9f9c7',
			'body-bg' => '#e5e5e5',
		),
		'fortnite' => array(
			'wiki-dark' => '#5d5d16',
			'wiki-light' => '#fbf2df',
			'body-bg' => '#e5e5e5',
		),
		'hearthstone' => array(
			'wiki-dark' => '#7a691d',
			'wiki-light' => '#fbf6df',
			'body-bg' => '#e5e5e5',
		),
		'heroes' => array(
			'wiki-dark' => '#732b9c',
			'wiki-light' => '#e8ddef',
			'body-bg' => '#e5e5e5',
		),
		'leagueoflegends' => array(
			'wiki-dark' => '#196b6b',
			'wiki-light' => '#f4db96',
			'body-bg' => '#e5e5e5',
		),
		'magic' => array(
			'wiki-dark' => '#a4276e',
			'wiki-light' => '#fbecdf',
			'body-bg' => '#e5e5e5',
		),
		'overwatch' => array(
			'wiki-dark' => '#a4276e',
			'wiki-light' => '#f4ddea',
			'body-bg' => '#e5e5e5',
		),
		'paladins' => array(
			'wiki-dark' => '#dee3ef',
			'wiki-light' => '#31519c',
			'body-bg' => '#e5e5e5',
		),
		'pokemon' => array(
			'wiki-dark' => '#4a4a4a',
			'wiki-light' => '#fbdfdf',
			'body-bg' => '#e5e5e5',
		),
		'pubg' => array(
			'wiki-dark' => '#7a5a1d',
			'wiki-light' => '#fbfbd7',
			'body-bg' => '#e5e5e5',
		),
		'rainbowsix' => array(
			'wiki-dark' => '#a4276e',
			'wiki-light' => '#fbf2df',
			'body-bg' => '#e5e5e5',
		),
		'rocketleague' => array(
			'wiki-dark' => '#31519c',
			'wiki-light' => '#fbf2df',
			'body-bg' => '#e5e5e5',
		),
		'runeterra' => array(
			'wiki-dark' => '#f4db96',
			'wiki-light' => '#196b6b',
			'body-bg' => '#e5e5e5',
		),
		'simracing' => array(
			'wiki-dark' => '#31519c',
			'wiki-light' => '#fbdfdf',
			'body-bg' => '#e5e5e5',
		),
		'smash' => array(
			'wiki-dark' => '#196b6b',
			'wiki-light' => '#dbeded',
			'body-bg' => '#e5e5e5',
		),
		'starcraft' => array(
			'wiki-dark' => '#4a4a4a',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'starcraft2' => array(
			'wiki-dark' => '#31519c',
			'wiki-light' => '#dee3ef',
			'body-bg' => '#e5e5e5',
		),
		'teamfortress' => array(
			'wiki-dark' => '#4a4a4a',
			'wiki-light' => '#e8ddef',
			'body-bg' => '#e5e5e5',
		),
		'trackmania' => array(
			'wiki-dark' => '#1e7a1d',
			'wiki-light' => '#dee3ef',
			'body-bg' => '#e5e5e5',
		),
		'underlords' => array(
			'wiki-dark' => '#732b9c',
			'wiki-light' => '#fbdfdf',
			'body-bg' => '#e5e5e5',
		),
		'valorant' => array(
			'wiki-dark' => '#e6e6e6',
			'wiki-light' => '#b12a2a',
			'body-bg' => '#e5e5e5',
		),
		'warcraft' => array(
			'wiki-dark' => '#dbeded',
			'wiki-light' => '#31519c',
			'body-bg' => '#e5e5e5',
		),
		'worldofwarcraft' => array(
			'wiki-dark' => '#732b9c',
			'wiki-light' => '#dee3ef',
			'body-bg' => '#e5e5e5',
		),
	);

	public static function getSkinColors( $wiki, $entity = null ) {
		$colors = self::getSkinColorsInternal( $wiki );
		if ( is_null( $entity ) ) {
			return $colors;
		} else {
			return $colors[ $entity ];
		}
	}

	private static function getSkinColorsInternal( $wiki ) {
		$colors = null;
		if ( isset( self::$colors[ $wiki ] ) ) {
			$colors = self::$colors[ $wiki ];
		} else {
			$colors = self::$colors[ 'default' ];
		}
		return $colors;
	}

}
