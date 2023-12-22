<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'biddemo' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '+$u6ix)(tbr N#TY01fAu/[X.ND2f!`Dci+k1T;Uc^%qe4O6xQ=VWK{K&QAF/n/r' );
define( 'SECURE_AUTH_KEY',  '4MU.~PFmELw:<8<cby&4? $Tj?WvRwI)0)#A%-h]|)psscg5(LuD#J[:^I6fT[Ou' );
define( 'LOGGED_IN_KEY',    'bmJqG|s<BG,*V7,ua!W,oFh_5qB-?@tyez3%:siHR!HmPKzL}=^so2|DxZC>7sB_' );
define( 'NONCE_KEY',        'kl3w6~*]^22=I&WSD4>#2zv3:Hz%3*_w#Hte ,odH*;|GG,nB73h;oH1A#V1^Wv.' );
define( 'AUTH_SALT',        'QG3}dl=[S:8C^>Ip]&79o4$WXn0 `/4Ecp/hC|*e*oaS#0|[8!r;9^3TEk+9 OXa' );
define( 'SECURE_AUTH_SALT', '>h7kGm6QRm0mYGUJSl6F0jyJ,i&Y#xv!E!C5%N20]ZOTF td)+8bcN_/}Z+aqC))' );
define( 'LOGGED_IN_SALT',   '(ECTT_ag,DuQ?SMEd=PMj8v.jiXJO~lnbZcf3VcD59~fp?;T#Ig!p,{^HCc MEK/' );
define( 'NONCE_SALT',       'OQ@[I=My{}hW*1jhDm=d(t|_[lkltSuQc%v&eil)]PGH}DOkHv<Po^An4jnm[^d8' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
