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
			'body-bg' => '#e5e5e5',
		),
		'battlerite' => array(
			'wiki-dark' => '#955623',
			'wiki-light' => '#fbecdf',
			'body-bg' => '#e5e5e5',
		),
		'callofduty' => array(
			'wiki-dark' => '#4a4a4a',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'clashroyale' => array(
			'wiki-dark' => '#31519c',
			'wiki-light' => '#e6e6e6',
			'body-bg' => '#e5e5e5',
		),
		'commons' => array(
			'wiki-dark' => '#e5e5e5',
			'wiki-light' => '#636363',
			'body-bg' => '#e5e5e5',
		),
		'counterstrike' => array(
			'wiki-dark' => '#7b932d',
			'wiki-dark-target' => '#54711b',
			'wiki-light' => '#cde5b6',
			'wiki-light-target' => '#f0f9de',
			'body-bg' => '#e5e5e5',
		),
		'crossfire' => array(
			'wiki-dark' => '#0e4659',
			'wiki-light' => '#b9953f',
			'body-bg' => '#e5e5e5',
		),
		'dota2' => array(
			'wiki-dark' => '#93352d',
			'wiki-light' => '#ecd5cb',
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
		'magic' => array(
			'wiki-dark' => '#a4276e',
			'wiki-light' => '#fbecdf',
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
			'body-bg' => '#e5e5e5',
		),
		'quake' => array(
			'wiki-dark' => '#484038',
			'wiki-light' => '#d1753e',
			'body-bg' => '#e5e5e5',
		),
		'rainbowsix' => array(
			'wiki-dark' => '#865879',
			'wiki-light' => '#f0e0a4',
			'body-bg' => '#e5e5e5',
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
			'body-bg' => '#e5e5e5',
		),
		'warcraft' => array(
			'wiki-dark' => '#aab9b7',
			'wiki-light' => '#1e4555',
			'body-bg' => '#e5e5e5',
		),
		'worldofwarcraft' => array(
			'wiki-dark' => '#831174',
			'wiki-light' => '#d1e2f1',
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
			$colors = self::$colors[ 'commons' ];
		}
		if ( array_key_exists( 'wiki-dark-target', $colors ) ) {
			$colors[ 'wiki-dark' ] = self::getGradient( $colors[ 'wiki-dark-target' ], $colors[ 'wiki-dark' ] );
			unset( $colors[ 'wiki-dark-target' ] );
		}
		if ( array_key_exists( 'wiki-light-target', $colors ) ) {
			$colors[ 'wiki-light' ] = self::getGradient( $colors[ 'wiki-light-target' ], $colors[ 'wiki-light' ] );
			unset( $colors[ 'wiki-light-target' ] );
		}
		return $colors;
	}

	private static function getGradient( $hex1, $hex2 ) {
		$per = self::getPer();
		$new = [];
		$parts1 = str_split( substr( $hex1, 1 ), 2 );
		$parts2 = str_split( substr( $hex2, 1 ), 2 );
		for ( $i = 0; $i < 3; $i++ ) {
			$h1 = hexdec( $parts1[ $i ] );
			$h2 = hexdec( $parts2[ $i ] );
			$new[ $i ] = str_pad( dechex( round( $h1 + ( $h2 - $h1 ) * ( 1 - $per ) ) ), 2, '0' );
		}
		$ret = '#' . implode( '', $new );
		return $ret;
	}

	private static function getPer() {
		$d = ( new \DateTime( ) )->format( 'U' );
		$d1 = ( new \DateTime( '2019-02-19' ) )->format( 'U' );
		$d2 = ( new \DateTime( '2019-08-19' ) )->format( 'U' );
		if ( $d > $d2 ) {
			return 1;
		}
		$i1 = $d - $d1;
		$i2 = $d2 - $d1;
		$per = $i1 / $i2;
		return $per;
	}

}
