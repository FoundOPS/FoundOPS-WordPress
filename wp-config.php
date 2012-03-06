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
global $debug, $foundopsLink, $blogLink;

/** The site URL */
define('WP_SITEURL', $blogLink);

$debug = false;

if ($debug)
{
	$foundopsLink = "http://localhost:31820";
	$blogLink = "http://localhost:8888";
}
else
{
	$foundopsLink = "http://app.foundops.com";
	$blogLink = "http://www.foundops.com";
}

/** The site URL */
define('WP_SITEURL', $blogLink);

/** The name of the database for WordPress */
define('DB_NAME', 'bitnami_wordpress');
/** MySQL database username */
define('DB_USER', 'bn_wordpress');
/** MySQL database password */
define('DB_PASSWORD', '20b26d4a71');
/** MySQL hostname */
define('DB_HOST', 'localhost:3306');
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
/* Substitution already done */
define('AUTH_KEY', 'f777e6007af3f53f0b3022b3cde25a76c67ebe6308fc1bff577d2fdd79cc02d6');
define('SECURE_AUTH_KEY', '90e11150e600797f87f104d09f438c8acb4dec59daa5b3ecd88af9b501592018');
define('LOGGED_IN_KEY', '8de9ed12d1aa6334af367673f2d61c1e4c7a9c306a87cdfaddb0487d9f0fd2bf');
define('NONCE_KEY', '7d8100228041a6eb1d7b1cbe1032a9db84f186781e919f2378b0d028b0809112');
define('AUTH_SALT', 'dbd8f1b1c3f3e3a95fa288ce7343cb88ee384e252df45edf34e2595728ffab5a');
define('SECURE_AUTH_SALT', '89eeccc343b1ac03594ecb0b4a5119d244842bf2d1d4a67f31d4f9e50c5f3168');
define('LOGGED_IN_SALT', '60cae228ec970c050fae65bf408f19e61c6af3c62ae2e1c3508ad58bc1b4a569');
define('NONCE_SALT', '485b96a84c12893c15e0c7ce37cb45cdd059031b879a4166cf67c673edaa6759');
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
define('WP_CACHE', true);
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD', 'ftpext');
define('FTP_BASE', '/opt/bitnami/apps/wordpress/htdocs/');
define('FTP_USER', 'bitnami');
define('FTP_PASS', 'wPpyBF2xo2BbP208WLHfgmDJytIQxxZZoePi4N5mHE8rJS96FT');
define('FTP_HOST', '127.0.0.1');
define('FTP_SSL', false);
                    