<?php /* _config.php */

define('DEBUG_LEVEL', 5);
define('APPNAME', 'mvc 99% php');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);//inutile


/*
 * chemin relative
 */
//$url = $_SERVER['SCRIPT_NAME'];
$url = 'http://'.$_SERVER['HTTP_HOST'];
//$url = $url.$_SERVER['REQUEST_URI'];//to work in a container
$url = $url.$_SERVER['PHP_SELF'];

//define('WWW', dirname($url));
define('WWW', $url);
define('WWW_MODEL', WWW.'/model');
define('WWW_VIEW', WWW.'/view');
define('WWW_CONTROL', WWW.'/controller');
define('WWW_MEDIA', WWW.'/media');


/*
 * chemin absolute
 */
define('LOCO', dirname(__FILE__));
//define('LOCO', '.');
define('MODEL', LOCO.'/model');
define('VIEW', LOCO.'/view');
define('CONTROL', LOCO.'/controller');
define('MEDIA', LOCO.'/media');
define('DOWN', MEDIA.'/download');

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', DOWN.'/error.log');
error_log('start('.php_sapi_name().')');


require('vendor/autoload.php');
// --> composer dump-autoload
//require_once('classe/Control.php');
\classe\Control::terminalRequest();

?>
