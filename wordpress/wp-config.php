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
define('DB_NAME', 'fitgirls');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '`U]Xu-jZ_+^$3rD5ULV-HH=;A<gH1UDCeN#9BPg+ys<`1UD0K-@9.#rNxj^l%s!a');
define('SECURE_AUTH_KEY',  'dO[91=eS4-eG8OU}!v!UFF*|<z?@Bl#ni-M61rpbS8 aF8oE`d ?]q!^}5Em$U%0');
define('LOGGED_IN_KEY',    'x-EI8Cl(q]yHLg|L9|74p6KT:}v((.}xhc+:zR=C>a+MbJ~g+TJkQ`34gIYu%cDS');
define('NONCE_KEY',        ']eKC2RP+b6,+vB7A-J}:4dRT.BQ^_^`k# fgzc/R{;afv6MoB*+s-NF-e9/a+l^c');
define('AUTH_SALT',        '(=|DbcG]|YSlXv-JIuiFR6;WacSB_Wa0q LQ/9Y2]k@T5y:R+y|NDl0:I)3?Net:');
define('SECURE_AUTH_SALT', 'P/;Jp~SR_&9b}<AC&vL1-GwS29_vaITo?t8?iPCrG-l8TQN33+1Nq*CncT|{!-)n');
define('LOGGED_IN_SALT',   'Rb.X=6u~;-mW#||X-CDEg(|==#M+#E:@+I<2RP?Zw+S]k2(.~QmF8{.{R}C#_`<0');
define('NONCE_SALT',       '~Zut&RRgwq3nlvFl$AD2MwLD.}mf`/%A$=+X#A;*&5DEJ%G:@j! - 3k|KGso^~_');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
