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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dbpassword' );

/** MySQL hostname */
define( 'DB_HOST', 'lt_mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', 'utf8mb4_unicode_ci' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']d07TIUvp!5fFU>.w?Z{Aj9).n Oq#<MEcR2ldL~<XZ(`24U/t3 ,l+ns$DA)zEm');
define('SECURE_AUTH_KEY',  '.Zl,b86p{s{+OFebC{7>*3* Y)]kTSSW<?/,6?!ql-0V_o<yiiUL)LfhGLJIv}C]');
define('LOGGED_IN_KEY',    '0PRE%tEBD0tyy-ny4W7OvOvfv%Ofcd[d/S_<~/gF|XM0~,cyzi7||z/u-d5[~o*,');
define('NONCE_KEY',        'B,T%_{g>.wMPC9/]<1ZIAvw+Ne3+j+(CA{HH0-StL}[T< +pr!7OZj5A6yL&6XCY');
define('AUTH_SALT',        '!KVvC&#j>u*IpCQ9^}T.|Ns~@gX0F#[(;(XHo;596|=<FD|f1NjCTj$P^z)FN.xW');
define('SECURE_AUTH_SALT', 'J|0G+_tK&IGOX+VV=|ZrZlN*Kh!d^WU651 mW>hMO 3j[Rjfm%`9e2a^n!q(jB7e');
define('LOGGED_IN_SALT',   'g3j:$u_KRAk_2hl/[{Gp:Y( qT(^D5uH|sXF8q>8(-zy0wo` F}Kx-d-`D`*McE3');
define('NONCE_SALT',       'G|^G%YkUo+=M+:zUDO`^oqf+gbZEY;f0]gH~rmE: cmU`4LNct<9:w}7l_X3A_T%');

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
