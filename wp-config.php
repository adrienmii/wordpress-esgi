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
define('DB_NAME', 'wordpress-esgi');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8001');

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
define('AUTH_KEY',         'YgXw:a&$5yP7.|[(Kp2P$xp82;+{vYMR`KF<C}Z:<}W)27D{^&bfB(nVCk~,_B{U');
define('SECURE_AUTH_KEY',  'q.QfG4X+_uuW(qwu(8vrMpCn_rwHaUTBX&K&jndU.$r)S6lt#HeN]e| W-RJE(mE');
define('LOGGED_IN_KEY',    '>GZDVLbFzbGZ54r*ZL])5MNP`<#%=~n(0EG0D:dOTWk]9ieGs:L-B-H]a$}(mi>J');
define('NONCE_KEY',        'eL=o3aX8_7p$o7lVM<;6JVc0r_7p~u* u>g3L>c82d[ic59 a*wG@qx6Rlwt6(}q');
define('AUTH_SALT',        ')_<Ejn)nBwfZ(kgF7ri(}w1JxP>DwoFqb5Xa4He^?Mvx<%ogEk<aB?~.^paN)}OC');
define('SECURE_AUTH_SALT', 'B6J6Qrdd#,~`^Jknh{|w@%Q{#m^1(4+e1bc,/<DE$oz8F2pQ~}i<{fRiKi>C,LpI');
define('LOGGED_IN_SALT',   'Y^+Bznt:hxv:epiS6huFTQ!Gw3{o.VDbK<yDb<)[^A3yuZt8N&Am$?/d#%C3ytbQ');
define('NONCE_SALT',       '5Qjv;h%7QJVRwZtYM&/]%E%|e99/d{[t.&[jM/DRr6Z!q$>a[)d}%gE1~DGf;V)u');

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
