<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'plugincontact' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'e=8rrEJF_8o`8W(,NL8,fj~^5Sdcr}8$<8C14pv|]TNTj-SWK,VP5X<QWU)]<;V]' );
define( 'SECURE_AUTH_KEY',  '!lDo=M(C7 (Z|!LEk|NlSe)0U_D3|z(.ymz2vAz#4JF%U2VW _5wTwA-x7A/vT;~' );
define( 'LOGGED_IN_KEY',    '/qt@}Sd~3eXgm3A#N>4t2FEe`sGQ:fIbn38=gxJ^(y:GOD?/-oS*y4b+qX ?AkIg' );
define( 'NONCE_KEY',        'ml[Q9Ri8A0@|te*C86kX`&L@_%5i./8SX_u(Zra{BC_JORlc*#L34,(kXIXm>|sB' );
define( 'AUTH_SALT',        'c3k:y<R0E+bM_hq% AwC{&JqCh2v~D|4sT7FJ,8]hlE9rJnBTBcxms^pOi@S(;]y' );
define( 'SECURE_AUTH_SALT', ';U7A[,;sVi@yaH=^)M)3Z8K]?h^yF:=87M`  2SX 7jl@:.~3edPY@SE+3BPlFJD' );
define( 'LOGGED_IN_SALT',   'jwh_[$4Pj7%g-!8*A[;%:+9+j{B$%f3GMk2zf]ZT7L&UyJz@f#v|c}5#fK3*XQkw' );
define( 'NONCE_SALT',       '0Ko=.u26,jdUYwP5B+)L-v53L@/f2/(iz-1KCHzhtFNDSLb:/iCIaRDIoBDaggAG' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
