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
define('DB_NAME', 'fashiondatabase');

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
define('AUTH_KEY',         'Sdm+*=/r~3h@VxF;_^#$_kVtf>o>?f1rm!&U*>4m}1+AT%SE(i-+B8V,K>TA#G_`');
define('SECURE_AUTH_KEY',  '(1`w#i<?LYc7c#<vII<%g$Yw|.]#J1WH`mN9e_]3cu$v-Q>|^:euV:~XM)VPOG,r');
define('LOGGED_IN_KEY',    'FD0$C<I6o5{8f,{eeFo$Do5{Pz.^L8c_6X<Jq5 pK_&b|EQ7-TwESgZXKg`.NSs~');
define('NONCE_KEY',        'npS@`pIGVb0_?q2B./J0(0|d^`iR+t+G|+OY8Z;l^J]v)CG|(L;g`lb6XWlE u<C');
define('AUTH_SALT',        '*#L f^[ViR5N)MFsF-f5|pvc/-q6|2W^(`m!KpZKa#t.QR#de1G:5qHN{^>Mnsm#');
define('SECURE_AUTH_SALT', 'ih?Vj_pAAwD=W&lz=WF!pO T|+ozT*FHG5jWJW?+6sXlB =baJbtJ:M]wNJg(~jh');
define('LOGGED_IN_SALT',   '^$em#p0@4*Bp{9&F8k{60@UOnU=<~cO,<OLxdzJ+?+k%/trMEE1 :JZ?XI#bW~Qw');
define('NONCE_SALT',       '^yo!0qY!jxdl&3pNK}+i_HoL%kt&AezD><v.rhPq37;9W0Y@!oF#,0a2X`7/CF n');

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
