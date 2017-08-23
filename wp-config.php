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
define('DB_NAME', 'florentine');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'SperaenDeo1');

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
define('AUTH_KEY',         '%;j_i2lc)ce/>7}5BW2W]%q06y~bBNJoMeK]Y)CdK#XP*[nTzg}mp9([jdqg;Q~Z');
define('SECURE_AUTH_KEY',  'w|P?jSl+9SrHT_9wRQ&v8}pQT9OX8<-s!C8IlQo@K8NX1K )e[I+F_E&+IP05=U/');
define('LOGGED_IN_KEY',    'dQ;uh~=#njMx2$&SNAdN6bAEQj/wtvxZ|.kOEs/i`wzP{4/ 8mOjWD$1J?Xqs*Ec');
define('NONCE_KEY',        'FZm)bGd^:4`D<vpW])==+nFX@59I@--_+>n=X]AQoJ~Q9u+Y;d[Gkx[y*%0KI+MR');
define('AUTH_SALT',        '4>M1XzXE4*eBPEjjsxK3rx|z2nao$R=$U6%R1 Mo8@OAl_Rd%8R38:VY~3T+dEuC');
define('SECURE_AUTH_SALT', '0KYKbQjq$.nH}IB@.]nc_[%3T!Gw9M&$]Zi]:6>Qfnf{#b@EZ+=MmnoCuy9:#g-(');
define('LOGGED_IN_SALT',   ';^2lIj^J>z&/0r3.Y{8uC2@sDmaF~&tomVt:{f=8;8cVfvI9/?LU}sqQ(]vHe((<');
define('NONCE_SALT',       '&M8?>TZB*{Q{Cw-DSC6IKMSImVF&*--_F5iU@t/~d;QFPE[U[%FN~{JoTkv(f Ud');

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
