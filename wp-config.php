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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'prueba_tecnica' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '.EZuT2@an%v11!l6AjKw)qTm3+Vr$Jm0DMZT=9b5Qw$5O]>=kVL&+pRq1k<?hvtq' );
define( 'SECURE_AUTH_KEY',  '9%v:RE%(>Q64fYV5Vq.^M6jR?Xn.?QMVWxaB|_@lbd`407fH8hON_})Q2E,$D~NX' );
define( 'LOGGED_IN_KEY',    'ck`=spl<+Z+L:KT*#DHn>a<l`=m@`a.pf`G]A~;CsKF3=izAK-z8b*]1xM58WngX' );
define( 'NONCE_KEY',        'g@#vWBKFxZ&eJC#S`%tN[PXU=2Ca-[:+]wdPKU6{nhiv{<an=tx$Ul!4vH?-G6fX' );
define( 'AUTH_SALT',        '=fSpqUaX^`Tb:CZsxD]naUx~YYd~EuIz3!G*Ohl3 =wj}sF2(Y]VIXgp9BHo{5?P' );
define( 'SECURE_AUTH_SALT', 'LFt>Jdh?ktS]!xN-0?-()&wyR8JhF`!6g#I,L@H!_#<$Xl3.j?O2<&|Z1q85Bh2<' );
define( 'LOGGED_IN_SALT',   '7qJ@LDV!fwu-k }?<#Y;8q:]8vZi;^b@D%QY0;-yOdZgx/s}23<4C73qlpCL?8~c' );
define( 'NONCE_SALT',       '[Z#Q!;#rga;.(}6ZA:^lfB?JE@ih=TC)Xz<*rxot`u}Qtg&&^Mu+4el>D4WR!2-o' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
