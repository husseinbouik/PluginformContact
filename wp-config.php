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
define( 'AUTH_KEY',         '@}a@?YkLgIhCK?@R;Xp#!+swDIaIeYpbka~f_:W%YIJTffI1WhmT~%`IrZS~;^Fn' );
define( 'SECURE_AUTH_KEY',  'b7wVE97bNT] BAs)5:pz,sw.{a@2lBkO,cnOB.7!pZLvjnSuUx[D*=`28H8fl_:,' );
define( 'LOGGED_IN_KEY',    'GCrrySo3z]^2TVv(8e]Jgio{cfyp$1[j9s14L&FtmTy<2mgpx/ih{9FV?5!8?M;h' );
define( 'NONCE_KEY',        'PiF0uAqba|a;o5joftj=O}V$d>H:>N6`HCi;nok.XIocq3IK`+?^nl(R[E_?ego9' );
define( 'AUTH_SALT',        'wsa68|3w!F1CZ!^[MzZUwQ36{b,Qm(dz5 |@jLA<]e^z?j0?`{bWJRN8]B?<[-|`' );
define( 'SECURE_AUTH_SALT', '3>pKEi6%,NXSPL7^a,b6/7]encLW7:7|}t],f<lMxHZ&3LW0hzB|Ic;0gXrX.VJi' );
define( 'LOGGED_IN_SALT',   ';rBO1jnxoOX1[KrYN1rG(s*6TOV-H/bj7C%m$(/Xiib# ^}8__!a5rF3g17I6/t ' );
define( 'NONCE_SALT',       'Oi^~I</HYv+[5=3FFp,DlV%O~?;)&8+mo;G/c3O3s9GRT$nPwgt/Qb~(GK!^UdV~' );

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
