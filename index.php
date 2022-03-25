<?php /* index.php */

require_once('_config.php');

//session_name("mvc");
if (!ONLINE) session_id('e5rmorlaogpmorlal5jmorlaht');
//session_start();
error_log('session_start('.session_start().')');
error_log('session_status('.session_status().')');
define('SESTAT', 'empty');
\classe\Control::switchMethodController();

?>
