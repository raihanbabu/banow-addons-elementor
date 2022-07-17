<?php



define( 'WP_CACHE', true ); // Added by WP Rocket



/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * MySQL settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */



// ** MySQL settings - You can get this info from your web host ** //



/** The name of the database for WordPress */



define( 'DB_NAME', 'muso_wp350' );



/** MySQL database username */

define( 'DB_USER', 'muso_wp350' );



/** MySQL database password */

define( 'DB_PASSWORD', 'vU2VBfR5DHju' );



/** MySQL hostname */

define( 'DB_HOST', 'localhost' );



/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );



/** The database collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );



/**#@+

 * Authentication unique keys and salts.

 *

 * Change these to different unique phrases! You can generate these using

 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.

 *

 * You can change these at any point in time to invalidate all existing cookies.

 * This will force all users to have to log in again.

 *

 * @since 2.6.0

 */



define('AUTH_KEY','?t+=n&m#W($bIJqi)3#hUBHWB(i[TT#Y1S4&_buRq4|QBQ&`3Z-Y_bHJK4Tucx<|');

define('SECURE_AUTH_KEY','qVU1(AKGWL4}:WbI|4}T^t2+Tc=,=b3yO0if^VbJ!BL;i(`:fQn[].#,riF]t.[h');

define('LOGGED_IN_KEY','xR/v;@gE@`-S#Z4lCG-&,Wx9p}HhRf|PT<}9Ft9*ZMRX} wk>9D=:@ qgX[xVvUn');

define('NONCE_KEY','0b1Dser@^s8[)YL5~Q-OOPl*Q9+k$re!u({U@VNiU- !JB|3tU](Moh,az%*Px`j');

define('AUTH_SALT','0gUHiW7is,4k^23</kw&w61=L,-B?os:E;jd YL~6o|+DaS+| 4b6ojBpCfW`GWo');

define('SECURE_AUTH_SALT','~h$yFeh1g{ss~jldES<|23>Fx`}cz|L|J5K=6-l6RCj{~D%QY&xGyfoWaM3Sg@J#');

define('LOGGED_IN_SALT','m.cl(*H!R!j[+ty,.,}F[|7Gml{i7F7w|%%-7eOgjA<&{o+Z4zk6-l<0tA.`Xt}?');

define('NONCE_SALT','JRMH}<LTD:129y772XN*J^E%)K_TIs{|dlhZa YbFzH+r=csI+J;?6x4^.3$4!q+');





/**#@-*/



/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */



$table_prefix = 'wp_';



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the documentation.

 *

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */



define( 'WP_DEBUG', true );

define( 'WP_DEBUG_LOG', true );



/* Add any custom values between this line and the "stop editing" line. */



/* Multisite */



define( 'WP_ALLOW_MULTISITE', true );

define( 'MULTISITE', true );

define( 'SUBDOMAIN_INSTALL', false );

define( 'DOMAIN_CURRENT_SITE', 'muso.live' );

define( 'PATH_CURRENT_SITE', '/' );

define( 'SITE_ID_CURRENT_SITE', 1 );

define( 'BLOG_ID_CURRENT_SITE', 1 );



/* That's all, stop editing! Happy publishing. */



/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}



/** Sets up WordPress vars and included files. */



require_once ABSPATH . 'wp-settings.php';