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
define('DB_NAME', 'db_wordpress_cagayan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'p@ssw0rd');

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
define('AUTH_KEY',         '6~lVp:R8sP)+gR%ZC]|FsK@3L>=/c$!?2Nf.)8nq6;4Oo%q0Ce5[;U:)XC}#xD_*');
define('SECURE_AUTH_KEY',  'ta@y*w>)BU;gk1)u>[<wvwAogOJnngfzvP4tglqU,e5G`u4,;]2QJGyWNP}v8uQq');
define('LOGGED_IN_KEY',    'f9;c+Fyx]a#20)V)oUs?O8KF{]n<-UaEqvu.mnw*DJ/~<fc|,89|7lca(EroKV?b');
define('NONCE_KEY',        '87/xjl9-_sB!Ez6(QW,,^u)C@+~zW--VW}E]DUPcFI+GX5hzWL4Q+_k?TK?.Iqi3');
define('AUTH_SALT',        'hnP|bTo!bO_<JG D>!WN g*|%/$8f@{qY<R&tVxA3{V6~L 6^bJy2x!$Y&9<*f6W');
define('SECURE_AUTH_SALT', 'aJqTD, `kpBTD*?ovPkxbkZosMTs]j3fKKo/Dc7@Bcm(x;i!@b2%Z3L62Y2$kD;P');
define('LOGGED_IN_SALT',   '(pzKV)=:,4OF7wmRI/K}MvU2}D/]0Nkyw9qP5%=_mU;Ycn~11.nR,NXag,v7vD./');
define('NONCE_SALT',       '8FMQi3pnPHZ^T<m&}0*MGpX.hm/WJ{2,br#AP@^+g$l_zsUX`~)u2|5-j.aGvArd');

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
