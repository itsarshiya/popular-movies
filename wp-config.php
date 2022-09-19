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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'netvlies' );

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
define( 'AUTH_KEY',         '}G4t8uOe<LhkZx2$5|]b[geP/*qYb:oxFJUJWAx$x)<+L~$9/jW*{.%Qm_g}>%Mq' );
define( 'SECURE_AUTH_KEY',  '&U9jvw!>eV)nLXa&BzNxl=}*n)W|liwiEi+{oyBDJ&.[HU*Px j1-EuGvd (NP%#' );
define( 'LOGGED_IN_KEY',    '(U4:-a_FQX,,M+h6Uk,sRUSH%U^INU!*WVgs_U/^Cq8q!H>8Cbo_^2-)vk0mPJZj' );
define( 'NONCE_KEY',        '[{,U2YKf3fO;Z--wSK)d%,kA$tjMB: X=~cLA._UE?JIn>$NNj#MxJTR@B$pSj&)' );
define( 'AUTH_SALT',        'P7|P^ySW+?LH${ Tq`0TSNWBNld/OB;oZ{xMi=k?tIG0D6O31di$IS!2?8Xa?$JB' );
define( 'SECURE_AUTH_SALT', ')S_4LcC6l?gNkYwr?(hz&~MJn*09kCRA?=Hu|a#:?0#b[9W},-27h?~A7(%Lz@P)' );
define( 'LOGGED_IN_SALT',   'c*V)5*3u[zX/$|4Tf0Uez<cq)m|u~~hY_P[W8pstD=y,/}ggZU]w/,b%Rsr}P2C)' );
define( 'NONCE_SALT',       '*1zxL`UPwLjOcq><c}}~tzUL]3xCNFta*UY3}Icp*[woRNqk=&?hy^7Qp~,3crMe' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
