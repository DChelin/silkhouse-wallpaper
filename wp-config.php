<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache





//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

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

define( 'DB_NAME', "papinico_silkhouse22" );


/** MySQL database username */

define( 'DB_USER', "papinico_silkhouse" );


/** MySQL database password */

define( 'DB_PASSWORD', "F[uiwLlu=Y-G" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );


/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );


/** The Database Collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );





/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         'oiXc!^q0-^_q7n~|a;;ZlOYnE0Jz>}Qe!OQcc e]WC[5iG|TE|2jGb9P$}4o7`zc' );

define( 'SECURE_AUTH_KEY',  'p;GO&ckNYo]Rj/zMJZpq6ogBEbs^:-C;]9YHZRRQT0f7{a Kn3mX-uX4XRDC@t&[' );

define( 'LOGGED_IN_KEY',    'p51A2nh5e%Z1FsRYqG=Ri36t|c4]xP _234<0)y<^O1#OL%$jiP6#/T_=qM%Y]be' );

define( 'NONCE_KEY',        ',(tE!#o9Cr)U_Ax]FHB4<7)3)Xdf.NeI]{?d~PmU+9mqrH<#x=<9M@(U[A$5g_;<' );

define( 'AUTH_SALT',        'kHog/^SCJ jIxm$+<n;$5 1:HIO]Ao3WD{AP^~9Fg4i~H9nAS~Fn_qlDXPj!_)kn' );

define( 'SECURE_AUTH_SALT', '*rk!j4WcV tVvu/BThTMxqOym3`RLBr]sx$#jR)2r-t|~@7qFW<HlGoen[n9ktV$' );

define( 'LOGGED_IN_SALT',   '8Bp-t,Jl|9Q[6y{QbE!Gt?YR`u^/5ePrr2;;C87/!I;h^U~X_HT7-QYl~{~yfxa.' );

define( 'NONCE_SALT',       ':n;3SBl!^oS[JlsRzG__XwA8>}aDA3s3oMd|V:6p@aYBFt%q>[E*!ZU1Enn*:6Fo' );


/**#@-*/


/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'ym_';


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

define( 'WP_DEBUG', false );

define( 'WP_MEMORY_LIMIT', '64M' );

define( 'DUPLICATOR_AUTH_KEY', '9oAljU9PI%Vc=JP(LG2(dH8u Oh^Z?kOIeb Fhyo?]. *!z~aC&)m32~kC&sRL~F' );
define( 'WP_PLUGIN_DIR', '/home/papinico/silkhouse.co.za/wp-content/plugins' );
define( 'WPMU_PLUGIN_DIR', '/home/papinico/silkhouse.co.za/wp-content/mu-plugins' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname(__FILE__) . '/' );

}


/** Sets up WordPress vars and included files. */

require_once( ABSPATH . 'wp-settings.php' );


