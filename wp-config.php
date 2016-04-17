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
define('DB_NAME', 'wordpress_data');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'J]!Qi+/7bjk2PBEx#B{zmMV~b3C:!m MF??#iqYziC#Oc9=IsK8K|zA/(q5fLS9~');
define('SECURE_AUTH_KEY',  '(<O41+$O~#.%5e`r_7DXaeKn_XrSWkeP,X]EH 1|~0d7^)3bmwS*rn-+*y=+:QIy');
define('LOGGED_IN_KEY',    '@ORE^7fq{5EL:+Zlj/P&{NQ!ih]-Fs_-Pyfp6Qm-.)lO+^V_P*BrKjA?fCCi/M=L');
define('NONCE_KEY',        '0VjRVFGWUke@nBJejJ|]1o`4Xi]+$#sV(e+)a6+/if2:8l:c`<,JTG<_EPMoP._N');
define('AUTH_SALT',        '(Ryx:UZ!n2%|F1%d]!.Lpq`o8||_`:8M9K+<S_9wFH.xi+AByD49Y]-9p1<IYRGq');
define('SECURE_AUTH_SALT', 'FP?^rlGQHovpf9b%Ea[6f-A5{JvtzbN_DrZ)n4qh&WoA=V14Y45Bq9s0t@?Hs&aa');
define('LOGGED_IN_SALT',   'hL`/CM[,QH5;sofL_!vQSf0VbVo;*CQdb9 2QtV,W4 6=?UxKQ|O9kN<+ZRKI=2p');
define('NONCE_SALT',       'm) k+TNRX]anrm@h[`2@X:,A!tnM=q;8w/zI&xRD{^.pLsNk_u~oJl_vfjy~7PNW');

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
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/wordpress/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
