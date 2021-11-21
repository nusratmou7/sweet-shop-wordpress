<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Bi9!_y:!SAZw ,^ta5m?|NHG$&12Xm`$>qyxV[W+6tb[`A SMu.-aRyJc*^nr/+6' );
define( 'SECURE_AUTH_KEY',  'HQ 8Hgm kZ.&&Q-~rJY7UAp{.3Ix!DR%v4M=El;)KueH_gSJ5(|W3]/ROsh=dy={' );
define( 'LOGGED_IN_KEY',    'ynPF1v6v;ro<LeK2(J,YK8}cSvp^r aLL_TBg>uT64fmgp826/Z<4,4dRML){u.j' );
define( 'NONCE_KEY',        'R-&=c1W<#M19*ULF5/{0FIXXBo`00^!F~U.HfMB0@[KY2N@MWtfm-NUkGL;V+]PS' );
define( 'AUTH_SALT',        'PyWn06txr5REiDJ[)&P)=AF>R&#fP]Oc9R}*Qr?Z# :fi,{&d%>qY,IBh0RS#fj^' );
define( 'SECURE_AUTH_SALT', 'MGuBZ~c36p`@1<NNQj[8a=gv8by>o.s:5G!_C}%1pSB,ZEaaLyP2A9=Y,3WdGy|3' );
define( 'LOGGED_IN_SALT',   'G}1G$;gCA>/IT]4},p6+y_g<sQl6~FqeV%cCc=@V+cZ`?$kW~3ukFSg2YLc!d^]2' );
define( 'NONCE_SALT',       'Ij2%-I&IS2=7ifgzWB]K={fWI7P2So+0U%g#0Y.y$%?#p3Z)GU=C~L`6!xHP0R6:' );
	define('WP_MEMORY_LIMIT','256M');
	ini_set('memory_limit','256M');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
