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
define( 'DB_NAME', 'newmaterial' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:8889' );

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
define( 'AUTH_KEY',         'B=$#@j%R[cGG.U^|u1j|#-x,=e](x}B=<aDxI%-}igQHHI {5ixlC(FeYB9S FR[' );
define( 'SECURE_AUTH_KEY',  'Ur*tL!HJMW7`~AHlZtVtGX{U(poD1ZezaQFA^Z<_%]5YU@`#m^XVulVpA9*qes(T' );
define( 'LOGGED_IN_KEY',    'a<,|9ev]Vx}l2H(Ot&c<<SvP>!l:n#n;IQ~~f6~ugZT1Ipd`S|KB-yH&NC-&!=A&' );
define( 'NONCE_KEY',        ';?i86U%v4$%Wqtwxd9@L9XY|%r&fi RoHXz?Xooo]/mF2.]Ds@py/#Zi%{LTn??G' );
define( 'AUTH_SALT',        'q;ZB7KH!E+7KT]l]}c%:2-/yW~m-laLoApvzrr],-vvh4E;4O%*&>;^j.^zP$!l0' );
define( 'SECURE_AUTH_SALT', ' q:v]2I*A}!lXV9ylJ:&MUb/]cX2b?QI|!_SAq}ZC{mcR*)]7@ypC$x%!22>1<;:' );
define( 'LOGGED_IN_SALT',   '8,2=VMc=}a~{%5#PdmF5R2/FtdOZMb?/;(!([ZYlG@fN=diE}~xwS V2ocLA5Dhr' );
define( 'NONCE_SALT',       '.doyK1|Y@FOA/~-/LmT_lZ`c>=ogI*vn`QH9ZiZCql@2dS$@xX;.)IFs6?]=%i3/' );

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
$table_prefix = 'us_';

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
