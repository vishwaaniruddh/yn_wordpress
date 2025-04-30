<?php
define( 'WP_CACHE', true );

// 

define('WP_MEMORY_LIMIT', '256M');

define('DISALLOW_FILE_EDIT', true);


define( 'DB_NAME', 'u464193275_ib3Xh' );

/** Database username */
define( 'DB_USER', 'u464193275_FCSOL' );

/** Database password */
define( 'DB_PASSWORD', 'caMrYFsAmF' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '(G:w4Y!FcBQWaB3$NuoutN.auUi>r}%X4/{(RL1,1L(^85vv@Ge0$Qb:Y^K,TANx' );
define( 'SECURE_AUTH_KEY',   'Ui)8l@rrC<^$q&vLMs~n-[lRZ:{_c,LTpdiEt@${L*r6 KrsoO2M.G%MhZY=D<lX' );
define( 'LOGGED_IN_KEY',     '|wvsvWKfl_dhuy8+l!7DYG.2U`1^je#ZKd+oI*7g<L%]fPb#jKk=t-J}hhIjay&F' );
define( 'NONCE_KEY',         'EsKX]5|;[3b1~o7q9y&y3h@]JxzFIy8EZ?8 h0e?d8b|?_>C/e!I>;-JEv%2a$S~' );
define( 'AUTH_SALT',         '2O$qWz/UVe$NFO0RZDH#?SO$D:S/rz{~]66cT$QNJX:;H0sY/#Ea[tv=UyTuKT|^' );
define( 'SECURE_AUTH_SALT',  'G.Q&f=S;del11>Q?K|S_N!9C9l:oc(!G8l0^o7I@op&j,JHINa^wx>Q%TY#K:R+J' );
define( 'LOGGED_IN_SALT',    'Jf`! ;R@1U>]T1b,h@FJ}RJ.dRRV(5do|Mp=`_g!or/ z8[$jaI)Sq=Z3WA yV,#' );
define( 'NONCE_SALT',        'r Mp;w_L2MFh?EW*NS`5sb@8T;L_or55N&Tr@2$-~ahR<$!Vt6~2?as07*je%vK&' );
define( 'WP_CACHE_KEY_SALT', '[;-/sL$i;y+Z2@KG3/u,)^-RYhs%++M28I5?6U7B%N| %$l{Ae5!!CE}r/Et;{.~' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpxyz_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
// define( 'WP_AUTO_UPDATE_CORE', false );
// define( 'WP_DEBUG_LOG', false );
// define( 'WP_DEBUG_DISPLAY', false );

// define('WP_DEBUG', false);
// define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
// @ini_set('display_errors', 0);


define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
