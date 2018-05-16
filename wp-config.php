<?php
/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'cgd_tactiks');

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
define('AUTH_KEY',         'Hi,xa<5Oal}b1Cf82LM#9XlM2kKO^n]MM(a01K##AQ#9/9%* k+!Z2ZF7vN6Ym>H');
define('SECURE_AUTH_KEY',  'X%%*.yQ+uVr$<5P]uxU}*qM)UARNoTQRK5zRVRbpGVEMxqIRp[?(^+l)2Sja]|yN');
define('LOGGED_IN_KEY',    'VyO6`45JRQz+;XCL$~Xm98$Hj,[+-0+hsT68z#S$SsUOoMOzvDIhZWxj> I(k?1R');
define('NONCE_KEY',        '4T0A{(%`)LrLP:33:QyoDm49sB+|L^pVn1U*--Z({u9W}*p?%l~F;JO}3u!|&~g3');
define('AUTH_SALT',        '%zeiTBkULHm/3Z|+w7y,koh#{rPRPW|OiU*_c-mT-gM*1DmH+XWC+;Jn$l|S%+V?');
define('SECURE_AUTH_SALT', 'i.,]- f7 !n>hi6>i]nS^0#6UCxm>BFv2,XT*BPy!VaR;``EoSQBCga|~hCS9!q4');
define('LOGGED_IN_SALT',   '%<|WLi;uCTwmDAag-h^;ZQ6Pch6K0dsd-f383Eg>&k~drOfbeeI^b:?/ xJ%&+re');
define('NONCE_SALT',       'z S)P-p#/~(=R[Fo+Mw`,bM`EZ9J|$kLR[H`-U-UgT1~A kd+FZ *=Ch .4rwKvA');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'den_';

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