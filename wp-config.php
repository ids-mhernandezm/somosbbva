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

// Register GCS stream wrapper

require_once(__DIR__ . '/../vendor/autoload.php');
$storageClient = new Google\Cloud\Storage\StorageClient();
$storageClient->registerStreamWrapper();

// $onGae is true on production.
$onGae = (getenv('GAE_VERSION') !== false);

// Disable pseudo cron behavior
define('DISABLE_WP_CRON', true);

// Determine HTTP or HTTPS, then set WP_SITEURL and WP_HOME
if (isset($_SERVER['HTTP_HOST'])) {
    define('HTTP_HOST', $_SERVER['HTTP_HOST']);
} else {
    define('HTTP_HOST', 'localhost');
}
// Use https on production.
define('WP_HOME', $onGae ? 'https://' . HTTP_HOST : 'http://' . HTTP_HOST);
define('WP_SITEURL', $onGae ? 'https://' . HTTP_HOST : 'http://' . HTTP_HOST);

// Force SSL for admin pages
define('FORCE_SSL_ADMIN', $onGae);

// ** MySQL settings - You can get this info from your web host ** //
if ($onGae) {
    /** Production environment */
    define('DB_HOST', ':/cloudsql/au-bbva-bancomer-paratirrhh:us-central1:tutorial-sql-instance');
    /** The name of the database for WordPress */
    define('DB_NAME', 'tutorialdb');
    /** MySQL database username */
    define('DB_USER', 'tutorial-user');
    /** MySQL database password */
    define('DB_PASSWORD', 'jepEQEKud6p?');
} else {
    /** Local environment */
    define('DB_HOST', '127.0.0.1:3306');
    /** The name of the database for WordPress */
    define('DB_NAME', 'tutorialdb');
    /** MySQL database username */
    define('DB_USER', 'tutorial-user');
    /** MySQL database password */
    define('DB_PASSWORD', 'jepEQEKud6p?');
}

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

define('AUTH_KEY',         'oUgkg9g8JuG8rVMpUAM1ENrCDO7QWj0MjN+VBWNfsdORPaGR5Ux18iMqDj8bS3+1oKbHKPrk0Wr1rOay');
define('SECURE_AUTH_KEY',  'EFrfcASf3wDe7iBEwTQ/jsDDfbj8InpCZI3thmW6vXUJVFf6s0dIMDE16gq4QCWYjHjvXbzZIfdBN0dK');
define('LOGGED_IN_KEY',    'L36YalZL+mkFMmRyD4Rr/C7k+ZMKJih+nWmvHkmgKr6waj/q66LzRzDQP1g1AABodMzkGHYuKq5vdLrH');
define('NONCE_KEY',        'K1PT8BPgQh6PXKr0vnuGi30HVT9WpavzRoVcPz3vnDcHWMK+x9EHdeM//wOGaQ4ZiBuyRr6srt0agvGi');
define('AUTH_SALT',        'RVs2T19jeYEiJo29BrKHSJKmN+DRcGEm0o/+4xE1c2nGT1nNw8MZ7nT2+eknJ14zSr07GZ1AsdibE/+Y');
define('SECURE_AUTH_SALT', 'gcuMbtdtEXHaM5r6/uW5MYaxa1xUnNIo4G3tIy75y0v+gFSZAGIyDYTmT4iSW28RDi4+dIEwjRiBmFpY');
define('LOGGED_IN_SALT',   '7QQnk+/vv1hokcUQFFMBsfiw/j0kQWZEpByr3P9QQzcoIhtfyPTX/For0BiZHQq4H+O/n4oHCK1wkF5A');
define('NONCE_SALT',       '39LNc+vF6n+jr1z73lKgePGvOkdqYGIjlrPVLwTcI060mJXh8N0SG0KlTE/fb7tVN15sFsSi9y1qPcHA');

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
define('WP_DEBUG', !$onGae);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
