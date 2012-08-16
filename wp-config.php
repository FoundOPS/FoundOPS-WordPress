<?php

global $debug, $foundopsLink, $blogLink;

$debug = false;

if ($debug)
{
	$foundopsLink = "http://localhost:31820";
	$blogLink = "http://testops:8080";
}
else
{
	$foundopsLink = "http://app.foundops.com";
	$blogLink = "http://www.foundops.com";
}
# test
# Database Configuration
define('DB_NAME','wp_foundops');
define('DB_USER','foundops');
define('DB_PASSWORD','fZ23TneiLGgdLK7H0FVt');
define('DB_HOST','127.0.0.1');
define('DB_HOST_SLAVE','localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'ENeS_$je9PfYIFQ+EE|]8~~V6hNyjtXS3x1YaamIOt|OWCM|+iqQ,_-$o^YZOr9I');
define('SECURE_AUTH_KEY',  '-q:]baO0e?F#r+cUQZ({7:XKz*@4qTT @YDy@qx%&X->#=#{wg#d]m3 `xPU15Y0');
define('LOGGED_IN_KEY',    'ny}E`,{X(~_)pK7GV!jFC+F_axzrPgZ5X`e}>,p%F,<Wx/&(i0b(*D9PEuU+]|0b');
define('NONCE_KEY',        '~/(|fwkXFAY,npX`|[CbW.3CneFdkb}Z)ds&4eerFLrjZ+v^RqE/A])%}HTlGsa+');
define('AUTH_SALT',        'bB`XSy]M8>tlfzcKR7esXNGU+I}!%K_plunI!,Ag,jV}Sz5O-P/!Pf84I%}E##|V');
define('SECURE_AUTH_SALT', '!S{H1|-HjBm$m;E!3j7DnH`FZPGpv>U|h6&t]6DJ5Z`DY|h][?YAOedz<$z(Rn ^');
define('LOGGED_IN_SALT',   'Y[7C8VP;*1P.j?xr<V*H1T[P6V@gC4i1YWp(InX|t;JnJJS2;adw2ZqYW|NI9B;r');
define('NONCE_SALT',       'j#~SnTWH)`-$#SO1Epc]L9f#QqVPY/d^/_l^chthM?@)f<%f$}(b)%E@X*XD/Zp ');


# Localized Language Stuff

define('PWP_NAME','foundops');

define('FS_METHOD','direct');

define('FS_CHMOD_DIR',0775);

define('FS_CHMOD_FILE',0664);

define('PWP_ROOT_DIR','/nas/wp');

define('WPE_APIKEY','af8f9fa8e9d00c7e2f0bfc1cf02590de6758499e');

define('WPE_FOOTER_HTML',"");

define('WPE_CLUSTER_ID','1238');

define('WPE_CLUSTER_TYPE','pod');

define('WPE_ISP',true);

define('WPE_BPOD',false);

define('WPE_RO_FILESYSTEM',false);

define('WPE_LARGEFS_BUCKET','largefs.wpengine');

define('WPE_CDN_DISABLE_ALLOWED',false);

define('DISALLOW_FILE_EDIT',FALSE);

define('DISALLOW_FILE_MODS',FALSE);

define('DISABLE_WP_CRON',false);

define('WPE_FORCE_SSL_LOGIN',false);

define('FORCE_SSL_LOGIN',false);

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define('WPE_EXTERNAL_URL',false);

define('WP_POST_REVISIONS',FALSE);

define('WP_TURN_OFF_ADMIN_BAR',false);

umask(0002);

$wpe_cdn_uris=array ();

$wpe_no_cdn_uris=array ();

$wpe_content_regexs=array ();

$wpe_all_domains=array (  0 => 'foundops.wpengine.com',  1 => 'www.foundops.com',  2 => 'foundops.com',  3 => 'm.foundops.com',);

$wpe_varnish_servers=array (  0 => 'pod-1238',);

$wpe_ec_servers=array ();

$wpe_largefs=array ();

$wpe_netdna_domains=array (  0 =>   array (    'match' => 'foundops.com',    'zone' => 'foundops',  ),);

$wpe_netdna_push_domains=array ();

$wpe_domain_mappings=array ();

$memcached_servers=array ();

define('WP_CACHE',TRUE);
define('WPLANG','');

# WP Engine ID


define('PWP_DOMAIN_CONFIG', 'www.foundops.com' );

# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
