<?php
define('WP_CACHE', true);

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'suraahfa_ecom' );

/** Database username */
define( 'DB_USER', 'suraahfa_admin' );

/** Database password */
define( 'DB_PASSWORD', 'suraahfa_root' );

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
define( 'AUTH_KEY',         '?.>T6v.N{C|.$2c>)P.*r@/(Z[hB%>4jk;a0|(1RByiZI(+7|V]3+}I13qo?`1 f' );
define( 'SECURE_AUTH_KEY',  'mD-C;%f.S$0Lq*CI&v9;.c*E]D&H74tR||9M}J@EDixfrbBb,M=5 Jfn@.@>#R8:' );
define( 'LOGGED_IN_KEY',    'MWwqXf>:sayogWk2@F!{(2FUq4^4roVW!V9]wC<G$O/tTQ{*3hD596]q+NK1@%0S' );
define( 'NONCE_KEY',        '^P>w=mZ]0}9Y4 3|h{2>7z@RisEB|Z(_hN%]0P|]0(BJA Vpc>E 9$0U}Y)Z<E^6' );
define( 'AUTH_SALT',        '%v3ka3K+3+J1-HN]ERC?=D!E-(0bU_UADNrMi5 ]M{{f;X( (6`m.s5B1 3cr]2H' );
define( 'SECURE_AUTH_SALT', 'B+U.pX%4^|d#LvShj^As)Q3;4$o<af~l>jKDVJnY75P>nj2Fq]4`|tT^ig2Yk3oN' );
define( 'LOGGED_IN_SALT',   'xYCh~wFuXiXxT<d^L?ZK3On0yln{V8Y0)tZ%[[Ytk((YP9rK9SnPsj|-:#L0bpd~' );
define( 'NONCE_SALT',       'jF9uFxFn *Q2A,5jTpX*Sb!9BsI?6@MnIoF8`[fy+tEPiFo]MAn[O%ms~gdjI=!!' );

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
