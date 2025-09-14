<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'emi_db' );

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
define( 'AUTH_KEY',         'q!7 r|xf?vGb_rG0!_95>6{D9E+l|<`zP;9~awslGjaum2/SPQ?tk%}nY<Z:j1Pm' );
define( 'SECURE_AUTH_KEY',  'cl<JS~|GggK;iv)7BP&D^iMw_$5gYZ^F;kRe3.79ieKd>8]!XH&O5!r6Od]tyN8m' );
define( 'LOGGED_IN_KEY',    '[W/%/caRXx>FGcMp)U_Ls%Ci_TzZl$^f#=7OdYA]$WEs)I:l>6Y *g3q|`?/Hx!u' );
define( 'NONCE_KEY',        'aa$inzb;*QUTOBVF/%c,hw`hjAXft,xfq9%KJE9*|5JI7=QP3dV7ak>D8aQdbNK8' );
define( 'AUTH_SALT',        'HT/[.-B$*?elKN T8q?mF!L*0bl8jez7BleA>TevlrU<#!ty|ty2BL#S~`mnApa5' );
define( 'SECURE_AUTH_SALT', 'XYm/J_+0s>}~:+LZZScTFGDQGoCV/7yog!l`9ruOu{%-|vvTT~==kft%D22f-%po' );
define( 'LOGGED_IN_SALT',   'Jh-49AjHU3=Nj-6lz]Q)~1q]O44PnE2(8I/4La@pRL?NjH!1UeW^sQyq#9&d{#RY' );
define( 'NONCE_SALT',       '4BZ:Cp>*91aP$HswZcguS#N=_PkxW6ygI9P[x9oWo&N47@iUQnHK91UllWkJM>5-' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
