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
    define('DB_NAME', 'somosbbva_wp');
    /** MySQL database username */
    define('DB_USER', 'admin');
    /** MySQL database password */
    define('DB_PASSWORD', 'admin');
} else {
    /** Local environment */
    define('DB_HOST', '127.0.0.1');
    /** The name of the database for WordPress */
    define('DB_NAME', 'somosbbva_wp');
    /** MySQL database username */
    define('DB_USER', 'admin');
    /** MySQL database password */
    define('DB_PASSWORD', 'admin');
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

define('AUTH_KEY',         '2wN5j3Z7qXVSW3sy6Ab6hyt8BARG9LFgSQJoMna8qjtaZvceOCWjEhMJ8XAR3uSCUV7AqNNVxxwIN00A');
define('SECURE_AUTH_KEY',  'Zruyowe7as26t/bknPQKs1eGbsn3u1JZ4d+7cF9ZR8SKtqO8q7KG3sQgD0StShlw4Yn8/ErsZG/SQCyx');
define('LOGGED_IN_KEY',    'mc2YCAaLjOfTUIUc/ZopgUermHgXEjgNmwdkEvzhdPRHO4Ss8h2UooFXPBXJATqDEiJkMYfz7r/9ZecL');
define('NONCE_KEY',        'OlAU7IluX4nm90DYCMVE8ZoPQQyw+qQF9IMn+Y2fyyKCeN/lfdCceHOXPwohsQztsnEpRweL50Sb1k44');
define('AUTH_SALT',        'HCI7DpVrJYTlG9zJdGL3qFyOADwnEYkv1S8Uk1OleSspD6Sh7ezcRRhAEQQzQaFaZ5rjhdIJfOj0ifjQ');
define('SECURE_AUTH_SALT', '1KUr/VZ4t7HqF6UAEYExf/P90RMDUqjK+mNdcEsX04XuRR9CIqCpjwTiUotZBMzu4G9PyRo4qygDVpAr');
define('LOGGED_IN_SALT',   '3oN2EUB+GAFOEOyExs9DWpeSbBEo71WXZ9Dvix3jP29jp/z8FaNR12hczeP38kTng0hYG+yWfa6Oa/Jf');
define('NONCE_SALT',       'GJ2qJ8iPU29/3u7OjXetMIJ+i1gNFcqLmSftwupBpoh0oG2dWfqtwOR5wF4izeGZ/C1ESzQ0rvWcWzVA');

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
