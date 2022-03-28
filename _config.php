<?php
/**
 *
 * @desc _config.php
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 *
 */
define('DEBUG_LEVEL', 5);
define('APPNAME', 'mvc 99% php');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);//inutile

/**
 * le chemin relatif
 */
//$url = $_SERVER['SCRIPT_NAME'];
$url = 'http://'.$_SERVER['HTTP_HOST'];
//define('WWW', $url.$_SERVER['REQUEST_URI'];//to work in a container
define('WWW', $url.$_SERVER['PHP_SELF']);
//define('WWW', dirname($url));

/**
 * le chemin absolut
 */
//define('LOCO', dirname(__FILE__));
define('LOCO', '.');
define('MODEL', LOCO.'/model');
define('VIEW', LOCO.'/view');
define('MEDIA', LOCO.'/media');
define('DOWN', MEDIA.'/download');

/**
 * error log
 */
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', DOWN.'/error.log');
error_log('start('.php_sapi_name().')');


require('vendor/autoload.php');
// --> composer dump-autoload
\classe\Control::terminalRequest();
define('REMOTE', \classe\Control::getUserIpAddr());

?>
