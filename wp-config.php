<?php

// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {

	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );

} else {

	define( 'WP_CACHE', true );

	define( 'WP_DEBUG', false );

	define( 'WP_LOCAL_DEV', false );
	define( 'DB_NAME', 'db_name' );
	define( 'DB_USER', 'user' );
	define( 'DB_PASSWORD', 'password' );
	define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

	define( 'WP_SITEURL', 'http://wordpress.dev/wp' );
	define( 'WP_HOME', 'http://wordpress.dev' );

    // The default user which feedback is assigned to when no matching advsier is set
    define( 'DEFAULT_AUTHOR', 354 ); // NOTE this is the user ID in production

	define( 'DISALLOW_FILE_EDIT', true );
	define( 'DISABLE_WP_CRON', true );

}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         'iP,i2T>9R&.K|IaUYjzI=6UM?vFg}cwklq;bePl4|F-98>`I2h}54+@,vQ_InnG|');
define('SECURE_AUTH_KEY',  '-`;Irr#51l$4&cXbkvedRCn:YFnwZ8b)(;21xTEWYi/KI`($5c:C~}Vas|,#J{g;');
define('LOGGED_IN_KEY',    'vD-7B|)hYx9eeu]5X].D{S18>Ka?]-Rq;8RI4Y-[cm]3c2Hd;kU/3.>W#hU(q{*D');
define('NONCE_KEY',        '?Q$^]l/+qW<`6}E}f=7{Q=nWt]v=u]yo@4`3%SPB$%mcXw jyiC^|+-0w5,Nb;MM');
define('AUTH_SALT',        'I6I;W(O/@5wcM1rZA2<>wZfC3#,6-jEH#O& .PV:Ok$w6?P3FkkI1M%(F.V[y$nJ');
define('SECURE_AUTH_SALT', 'H|ptP7D4Ipyp~-D9/NdpoCJ+G/z?sP$s*.%qww@#S&R@Em+KoMEH:!qE3zH6Tx1x');
define('LOGGED_IN_SALT',   'i+^XI)M!>vG;;$u%`SZR>FnU;]l-O#G(,Wabcrk]01J0Y+9n*PS+,x~Gq3k5|W4@');
define('NONCE_SALT',       '|JTBd7x5<p>B!|X0Ao:Z&NLPrdUU-gW8j&&JY#Wo&uo,i--XO+;p@6VDS$FC[u/c');

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) && FALSE === WP_LOCAL_DEV )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}

require_once( ABSPATH . 'wp-settings.php' );
