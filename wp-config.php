<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ayekan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Z5]=w*DTkp1<+{ETA+SUXkf(@?J|o@R8w^vLuLq@[wVo+{-7A;I.#?*&J;*h|a)}');
define('SECURE_AUTH_KEY',  '0;}xYm_$I5_vLVn.QqzUk#kPw 1nNpkDa<`wm}d&hAW@:+?PNpQ8rT]^w2-y:?wA');
define('LOGGED_IN_KEY',    'HM>}-m:la}J=>t[Q]-i2Me;QJ@zng(P,%AoswWjQ _JM{:L|2R|%]Q%rN.WZ>3en');
define('NONCE_KEY',        '*7r?1tNbZ|FDf+2=xA[{Ji*-~`%$,*38NJ8|PMAZ=0xQdVt11y-HI,`-.-pKR^p_');
define('AUTH_SALT',        'UdTb64A;2q($Jo9/!+dc7DTO7zI6[rrK6UVu@f-@k(N;oU.c5Fc(gAf+`.zTt6J5');
define('SECURE_AUTH_SALT', '{$9]MT)K*ik|BU`eQWJ?pr4=+[&2kCD!R~PcC-#_vCL-wx_ckCq&[4py+$r[4I|%');
define('LOGGED_IN_SALT',   'WoAtcsMI7.#9:d`Q-LT.,BPX8Ey%9GGN,a]|US{Q0+&!Y[+L7>=W8Mp+,&5XJfnz');
define('NONCE_SALT',       '`yaRceQup`?$|Sg9(3OGaij`t1G*W.OZBz[K~wmul2>s/+s2n<%+V[Ka#14e)@30');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
