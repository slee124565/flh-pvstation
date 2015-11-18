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
define('DB_NAME', 'pvstation');

/** MySQL database username */
define('DB_USER', 'pvstation');

/** MySQL database password */
define('DB_PASSWORD', 'raspberry');

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
define('AUTH_KEY',         'Mxx0#$DOfqqh-a^t)In9T#uWuI?W0#5Fx~%7L0I792,HAhu]R0Yt:L!NXQDM4|4e');
define('SECURE_AUTH_KEY',  '}57&n&z2-^m,[qR6Lm`E(:5;Z31Du<j[fx_,;kFZGDKKkZ_g21|ud;i)_Q?Y:[#h');
define('LOGGED_IN_KEY',    '7%~eJ21DF(vnEWS<dg0HcmTKJLaP6{1UVEyLH+$~36-T{:vC9Rp#r8E?V1)Pl0__');
define('NONCE_KEY',        '-.@{?:E$ aI}-q&fLKXGBhj?/gX|fTFKmHYs9_k),PA0G(DCm,r^}FP>k<pOr|/g');
define('AUTH_SALT',        'SmTl,<c(+h>_?VJP8H0kl-C0KKxnEv6#O/Nt@UU1|gU,U1bYX^|G!}x+#~vh|4#O');
define('SECURE_AUTH_SALT', '5P<|+3qFKz;M-rVV>{)+|.sw< s@oQxD|zM~2h7l<RXWuIr+wV2W(0!GBE,J)I`G');
define('LOGGED_IN_SALT',   '|H<V{+K+p|etv|A:FV/FnZWIdiupi qBf+2i)~,7tQ;}!XXM_^|%;>!(O;-mIgY)');
define('NONCE_SALT',       '6b)~>}[$ARw,2[}gpq19FCsZk:jjH0*m-tVyCaF*S1_g}IW$FG]eL-=*/;B?&nK;');

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
