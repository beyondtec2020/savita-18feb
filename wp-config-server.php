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
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'DB_NAME', 'beyond' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'a3Tazn-$' );

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
define( 'AUTH_KEY',         'H~G_@ivi^|&>B/[XjOuf[x7b&NBYx;nOVZ*Gp{|`#:i-[jt P Wnw;LXBSX:i:7~' );
define( 'SECURE_AUTH_KEY',  'w{@X,0Tq`clU?A[*-Z|+Q/U[kh/oJHGAUUFHg1,_aZ9:y`^rpdJA251UWAjiyH6M' );
define( 'LOGGED_IN_KEY',    '-RT9.qPcJhT37Hsmz:|8_!c47J2Xhkue0x;%! &-*Lp6l%`QD8f]HHf]Z,$T37eR' );
define( 'NONCE_KEY',        'C!9.*:aQ` Z>kH:@6SD5e$smq8GTpM@xFpYD8o.K7pf,uz/OB5Q:X/)A#w=m>pc`' );
define( 'AUTH_SALT',        '6O>qgNK+!4NKoOJrJpx)pE<O$sK|1ZC]f@#9Fw[&:XBz[oM]7$.$#fJs,*~Cj#KJ' );
define( 'SECURE_AUTH_SALT', 'Py2Tb_Og?*=4]Gznw]tP-rd}H:`a,B>MD}}6M:zC|Z_0<n_:-Phww9PK2a{*m2yH' );
define( 'LOGGED_IN_SALT',   'WP2>HSU4:x]fsHz&#%xLvP{>}Or[.*3F[p6562BH&wjO`s(HIS33zcZ8S% Y0Nm^' );
define( 'NONCE_SALT',       'x.**Tuf$XehFyR%c:VMLb*kGE2NZ@zonjK)maE;nJ/HMg#Dd 88jY%|W]#]U7wdu' );

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

define('WP_CACHE', true); // Added by WP Hummingbird
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );