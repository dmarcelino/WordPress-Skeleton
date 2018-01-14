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

if ( file_exists( dirname( __FILE__ ) . '/wp-config.ini' ) ) {
	$config_array = parse_ini_file(dirname( __FILE__ ) . '/wp-config.ini');
} else {
	header("HTTP/1.0 500 Internal Server Error");
	http_response_code(500);
}

define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp');
define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME']);
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $config_array['db_name']);

/** MySQL database username */
define('DB_USER', $config_array['db_user']);

/** MySQL database password */
define('DB_PASSWORD', $config_array['db_password']);

/** MySQL hostname */
define('DB_HOST', $config_array['db_host'] ?: 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', $config_array['db_charset'] ?: 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', $config_array['db_collate'] ?: '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         $config_array['auth_key']);
define('SECURE_AUTH_KEY',  $config_array['secure_auth_key']);
define('LOGGED_IN_KEY',    $config_array['logged_in_key']);
define('NONCE_KEY',        $config_array['nonce_key']);
define('AUTH_SALT',        $config_array['auth_salt']);
define('SECURE_AUTH_SALT', $config_array['secure_auth_salt']);
define('LOGGED_IN_SALT',   $config_array['logged_in_salt']);
define('NONCE_SALT',       $config_array['nonce_salt']);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpasm_';

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
define('WP_DEBUG', $config_array['wp_debug'] ?: false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
