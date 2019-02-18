<?php

namespace Liquipedia\LiquiFlow;

class Colors {

	private static $colors = array(
		'apexlegends' => array(
			'wiki-dark' => '#b12a2a',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'arenaofvalor' => array(
			'wiki-dark' => '#196b6b',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'artifact' => array(
			'wiki-dark' => '#484848',
			'wiki-light' => '#fbf6df',
			'body-bg' => '#dee2ec',
		),
		'battlerite' => array(
			'wiki-dark' => '#945c2e',
			'wiki-light' => '#a8b7bb',
			'body-bg' => '#dee2ec',
		),
		'clashroyale' => array(
			'wiki-dark' => '#31519c',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e6e6e6',
		),
		'commons' => array(
			'wiki-dark' => '#e5e5e5',
			'wiki-light' => '#636363',
			'body-bg' => '#e5e5e5',
		),
		'counterstrike' => array(
			'wiki-dark' => '#7b932d',
			'wiki-light' => '#cde5b6',
			'body-bg' => '#e5e5e5',
		),
		'crossfire' => array(
			'wiki-dark' => '#0e4659',
			'wiki-light' => '#b9953f',
			'body-bg' => '#dcd7e6',
		),
		'dota2' => array(
			'wiki-dark' => '#93352d',
			'wiki-light' => '#ecd5cb',
			'body-bg' => '#e5e5e5',
		),
		'fighters' => array(
			'wiki-dark' => '#444444',
			'wiki-light' => '#ffa800',
			'body-bg' => '#e5e5e5',
		),
		'fortnite' => array(
			'wiki-dark' => '#5d5d16',
			'wiki-light' => '#fbf2df',
			'body-bg' => '#e5e5e5',
		),
		'hearthstone' => array(
			'wiki-dark' => '#937a2d',
			'wiki-light' => '#f2eec7',
			'body-bg' => '#e5e5e5',
		),
		'heroes' => array(
			'wiki-dark' => '#6b2d93',
			'wiki-light' => '#eadcf5',
			'body-bg' => '#e5e5e5',
		),
		'leagueoflegends' => array(
			'wiki-dark' => '#196b6b',
			'wiki-light' => '#f4db96',
			'body-bg' => '#e5e5e5',
		),
		'overwatch' => array(
			'wiki-dark' => '#932d64',
			'wiki-light' => '#f1d1e3',
			'body-bg' => '#e5e5e5',
		),
		'pokemon' => array(
			'wiki-dark' => '#444444',
			'wiki-light' => '#ff9999',
			'body-bg' => '#e5e5e5',
		),
		'pubg' => array(
			'wiki-dark' => '#6a4a3c',
			'wiki-light' => '#edc951',
			'body-bg' => '#f8fafb',
		),
		'quake' => array(
			'wiki-dark' => '#484038',
			'wiki-light' => '#d1753e',
			'body-bg' => '#eeeeee',
		),
		'rainbowsix' => array(
			'wiki-dark' => '#865879',
			'wiki-light' => '#f0e0a4',
			'body-bg' => '#f8f2ed',
		),
		'rocketleague' => array(
			'wiki-dark' => '#003f84',
			'wiki-light' => '#ffae51',
			'body-bg' => '#e5e5e5',
		),
		'smash' => array(
			'wiki-dark' => '#179c68',
			'wiki-light' => '#bdf2d1',
			'body-bg' => '#e5e5e5',
		),
		'starcraft' => array(
			'wiki-dark' => '#606060',
			'wiki-light' => '#e1e1e1',
			'body-bg' => '#e5e5e5',
		),
		'starcraft2' => array(
			'wiki-dark' => '#2d5f93',
			'wiki-light' => '#d1e2f1',
			'body-bg' => '#e5e5e5',
		),
		'teamfortress' => array(
			'wiki-dark' => '#444444',
			'wiki-light' => '#bc8e3d',
			'body-bg' => '#e5e5e5',
		),
		'trackmania' => array(
			'wiki-dark' => '#337238',
			'wiki-light' => '#c3bac5',
			'body-bg' => '#e2dce0',
		),
		'warcraft' => array(
			'wiki-dark' => '#aab9b7',
			'wiki-light' => '#1e4555',
			'body-bg' => '#f5f1fa',
		),
		'worldofwarcraft' => array(
			'wiki-dark' => '#831174',
			'wiki-light' => '#d1e2f1',
			'body-bg' => '#f1e8ea',
		),
	);

	public static function getSkinColors( $wiki, $entity = null ) {
		if ( $entity == null && isset( self::$colors[ $wiki ] ) ) {
			return self::$colors[ $wiki ];
		} elseif ( $entity == null ) {
			return self::$colors[ 'commons' ];
		} elseif ( isset( self::$colors[ $wiki ] ) ) {
			return self::$colors[ $wiki ][ $entity ];
		} else {
			return self::$colors[ 'commons' ][ $entity ];
		}
	}

}
