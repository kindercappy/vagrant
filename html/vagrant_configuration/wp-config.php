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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'DATABASE_NAME');

/** MySQL database username */
define('DB_USER', 'DATABASE_USERNAME');

/** MySQL database password */
define('DB_PASSWORD', 'DATABASE_PASSWORD');

/** MySQL hostname */
define('DB_HOST', 'DATABASE_HOSTNAME');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Vm*Y8WU[ ]WY H^zQbB&.D[<8DJ,_|/c-+IR{qj@,ij+`!|--(2:$+Gv>i>FqBHg');
define('SECURE_AUTH_KEY',  '|qrL|Eh`Fikm`v9-dS#}UzxrZ:_?|/uoYKe|9S<.Fx#hc8UbQ  )J|0>-sx4zrpV');
define('LOGGED_IN_KEY',    '!>w}cMMrJ |?6#Cw=iJZ;J&-t)$+WZ/dpvONuo<Z{0$yn]MRpw8Q`NETu,49_m3R');
define('NONCE_KEY',        '9=yAxG{8/g&0-uM[|{nzdm1+sQXnXTS%.o<!i/+]AN:7;LaT!Ifx;ojlS+<n0NkU');
define('AUTH_SALT',        '2^eC#!JgEH&&i{yoD;`U8B +EI_^uo8H|u0lws_cH!VPaz*q6LKRiCs|h!O+#n(w');
define('SECURE_AUTH_SALT', 'VX[kmB`Ge(PvT}|K[9^?P}k{Y_+T)=<~9=yU2zYWdF3/P@>X9&||&r0(ez{B|W18');
define('LOGGED_IN_SALT',   '~~!j#DG5D$I$F}0F%3<Z/J1l<@Ml-&fQ49gU i )eu(!8AI;6WCJx@!+XNDD-N]U');
define('NONCE_SALT',       '%f&N.3N9Ktp*{+U1|<fmHFws_&<v/zq&C.U.-%r6&9 !7/u%`2,_a!bfSJ9)j@g;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
/* Multisite */
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', '127.0.0.1');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
