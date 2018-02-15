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

    // Required for batcache use
    define('WP_CACHE', true);

    // ** MySQL settings - You can get this info from your web host ** //
    /** The name of the database for WordPress */
    

    if (isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
        /** Live environment Cloud SQL login and SITE_URL info */
        /** Note that from App Engine, the password is not required, so leave it blank here */
        define('DB_HOST', ':/cloudsql/au-bbva-bancomer-paratirrhh:us-central1:somosbbva');
        define('DB_NAME', 'wordpress');
        define('DB_USER', 'admin');
        define('DB_PASSWORD', 'admin');
    } else {
        /** Local environment MySQL login info */
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'somosbbva');
        define('DB_USER', 'admin');
        define('DB_PASSWORD', 'admin');
    }

    // Determine HTTP or HTTPS, then set WP_SITEURL and WP_HOME
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
    {
        $protocol_to_use = 'https://';
    } else {
        $protocol_to_use = 'http://';
    }
    define( 'WP_SITEURL', $protocol_to_use . $_SERVER['HTTP_HOST']);
    define( 'WP_HOME', $protocol_to_use . $_SERVER['HTTP_HOST']);

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
    define('AUTH_KEY',         'Oh;+)I`6237RhF<EfBU|.2lSoE,$Fd-SZUrWQG/4].D_>0u=iXQenw(&Q6EYOo$J');
    define('SECURE_AUTH_KEY',  '(1Y.xZSPKSKl?FM6:){KFN-?@&?l=cPXm=OwWLo|&V#6oEh?F#SfXU1*r$t1RG8%');
    define('LOGGED_IN_KEY',    'J{L*O^Y<TQ&NEKq:tMaRp|bromU)lJ.06ya7*guwGiLO3:Az-8}s Xtq)f;4zB>1');
    define('NONCE_KEY',        'oJ/ +6`v?#zE&Wc#c>sA7Elbc8mQn{Qy#-::8kgH^xfTApm$&/m[3(j7XDHo~ fa');
    define('AUTH_SALT',        '*hQg+D%34U^gXzHLfK[HyDn}!p~zO%?)^}Lm]~Tai,Md:_st@P}sVc/Cv=+YWdXd');
    define('SECURE_AUTH_SALT', '(WrE[kJ%~R7H*p!fpw~@ZO1HWEF5B4R~}r^G@B_hM`TJ%[Ox)5U|11w.iLf5%6J@');
    define('LOGGED_IN_SALT',   '6N #hjT{c 4gbB+|Q/[[K0bbbj|TjOARE&<pfUu%DxRSA0ItgpmqURkpur-o7^!C');
    define('NONCE_SALT',       '%J<I_Oy4[a~?pU-UQJWONrE-q)=_BJz~</Cy3s`sp5-wDc4fT0 Gu&p%&|Q>6F&@');

    /**#@-*/

    /**
     * WordPress Database Table prefix.
     *
     * You can have multiple installations in one database if you give each a unique
     * prefix. Only numbers, letters, and underscores please!
     */
    $table_prefix  = 'wp6_';

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
    
    /**
     * Disable default wp-cron in favor of a real cron job
     */
    define('DISABLE_WP_CRON', true);
    
    // configures batcache
    $batcache = [
      'seconds'=>0,
      'max_age'=>30*60, // 30 minutes
      'debug'=>false
    ];
    
    #define('WP_ALLOW_MULTISITE', true);

    /*if(isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) { 
        define('MULTISITE', true); 
        define('SUBDOMAIN_INSTALL', false); 
        define('DOMAIN_CURRENT_SITE', 'your-project-id.appspot.com'); 
        define('PATH_CURRENT_SITE', '/'); 
        define('SITE_ID_CURRENT_SITE', 1); 
        define('BLOG_ID_CURRENT_SITE', 1); 
    } else { 
        define('MULTISITE', true); 
        define('SUBDOMAIN_INSTALL', false);
        define('DOMAIN_CURRENT_SITE', 'localhost');
        define('PATH_CURRENT_SITE', '/');
        define('SITE_ID_CURRENT_SITE', 1);
        define('BLOG_ID_CURRENT_SITE', 1); 
    }*/
    /* That's all, stop editing! Happy blogging. */

    /** Absolute path to the WordPress directory. */
    if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/wordpress/');

    /** Sets up WordPress vars and included files. */
    require_once(ABSPATH . 'wp-settings.php');


