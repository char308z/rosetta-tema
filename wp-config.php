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
define( 'DB_NAME', 'charlottefranciska_dkrosetta' );

/** Database username */
define( 'DB_USER', 'charlottefranciska_dkrosetta' );

/** Database password */
define( 'DB_PASSWORD', 'rosetta123' );

/** Database hostname */
define( 'DB_HOST', 'charlottefranciska.dk.mysql' );

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
define( 'AUTH_KEY',         '%TvdZH?MF+[o:=v3C{R$S.fns:]*+G-QqQ>(?s74IX$n<Q?6igsr{K&Ofpw=26V}' );
define( 'SECURE_AUTH_KEY',  ' ?SQ04&pk#{_e1x%OL{WluB594;31YFL)5$g=6||D1<Ef2Pxzw,o}U&cKrA`GxYY' );
define( 'LOGGED_IN_KEY',    'mPf/pR- ^X~0Xx%%H$Hmf{rUBfcqcq_8WVr8i4<K}!9ck+ansO$3nw2%Y;F|Dz@3' );
define( 'NONCE_KEY',        'd N(h9%{~u_:ijf1`;M/e,m<`alke-9@H;4__u1x9sB-APZUM<K1q;=c%,u;ZKGx' );
define( 'AUTH_SALT',        '+Gc:N4qg<djEJ@9+{.ip-4-hxSA4+xV>HD1BtyRw$hJLC7 E>O[z[c,SC%D>Gz|p' );
define( 'SECURE_AUTH_SALT', 'z++Sx}bb`fcTv9bz^%1=&L$UPeZttole6*:}-v@kZQ4@<J`zOFl!gurQ.30?v8Z:' );
define( 'LOGGED_IN_SALT',   'jOc+X^F;1d|ttL m^Hb,O4{mKu,g-G4Sm|u9YV<N^-@C>wkam@pb;]1]?+I]-wlR' );
define( 'NONCE_SALT',       '2TeO`]a^CmX[@;GtaV2U6Txbuq+?:M66.QLR! #9v>x[D9[U</6sy!^t~IL_(860' );

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


define('WP_MEMORY_LIMIT', '256M');
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
