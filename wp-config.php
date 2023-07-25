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
define( 'DB_NAME', 'taskovnet' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'xbqeagTZvTako3|Xj-SHxbs+hp0$#ld|e1j7OyBwO~w@z!}L9<7]xU%RFg)5/89j' );
define( 'SECURE_AUTH_KEY',  '7pKD28s1Ge&xSfkf^(deA/Kyr`<,Pj C?Vc%>S}*<ZZXZvS;/:u7hA=l9$zP6?h;' );
define( 'LOGGED_IN_KEY',    '&Tqwge2d&a2XbB+Q[N>c5^6UU?jyPZMZ%APzh1t JlDb:V{%,c~.a~P@2cy@P7&4' );
define( 'NONCE_KEY',        'Sz|D~tdQ:YWM-}Zikv+?g{1`j?la#[CLKh(GUEtL|)M-0%diB,|20mRL-s|U=Xqo' );
define( 'AUTH_SALT',        'pG((r/=y!!5TcOn$Ad5tZgL@]23$T1452VQRu8;Io3r@a#fy#u1/s% $P14[1Yg#' );
define( 'SECURE_AUTH_SALT', '%uKe<qY=oY/+IB9ve}_Pgj?>dhu26hf)tmb?.e~(,J=tiQijOY,d<q)8`=1&xHn*' );
define( 'LOGGED_IN_SALT',   'Xm<(w#Z*(TK@1;nVFfL@gfDW}D64~mujC;-A$})9%otW(cb^egKFmxV_VR]EkJ>J' );
define( 'NONCE_SALT',       '3XJJ23SS$z2C?c-c|<!*(7N8;(}|1)+=}V{Nz{.zMoJ5.z;;Ed>R2IS@M7t=b%<4' );

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
