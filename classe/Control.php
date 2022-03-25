<?php namespace classe;
class Control {/* controller method depends on the <page> value
*/
    private const DEFAULTPAGE = 'objet';

    public static function load($argo) {
    	//self::autoloadClassDefinition();
        //disabled for composer autoload in composer.json
        self::terminalRequest($argo);
        self::switchMethodController();
    }

    public static function switchMethodController() {

    	$admin = 'controller\admin\Admin';
    	$site = 'controller\site\Site';

    	$space = -1;        // mamespace\classname
        $clargument = -1;
        // $objet = new $space($clargument);
        $method = -1; // method to call
        // $resultat = $objet->$method();
    	// $argument = -1;  // $objet->$method($argument);

        switch(PAGE) {/* switch controller
*/
            case 'insert': break;
            case 'update': break;
            case 'delete': break;
            case 'home': break;
            case 'deconnexion':
                $clargument = 'home';
                break;
            case 'objet':
                $space = $site;
                break;
            case 'liste':
                $space = $site;
                break;
            case 'all':
                $space = $site;
                $method = 'liste';
                $clargument = 'objet';
                break;
            default:
                $space = $site;
                $method = 'default';
        }

        if ($space < 0) $space = $admin;
        if ($method < 0) $method = PAGE;
        //if ($argument < 0) $argument = false;
        if ($clargument < 0) $clargument = PAGE;

        $rooter = new \classe\Rooter($space, $method, $clargument);
        $rooter->control();
    }

    public static function autoloadClassDefinition() {/* automatic loader
    uses require_once to load a class if the class definition is required */
        spl_autoload_register(function($class) {
            $path = LOCO.'/';
            $chemin = $path.str_replace('\\', '/', $class);
            $filename = $chemin.'.php';

            if (file_exists($filename)) {
                if (DEBUG_LEVEL > 4) echo "require_once('".$filename."');\n";
                require_once($filename);
            } else {
                echo "error: ".$filename." does not exist\n";
            }
        });
    }

    public static function terminalRequest() {

        if (empty($_SERVER['REQUEST_METHOD'])) {/* terminal request simulation
        */
            define('ONLINE', false);
            define('METHOD', false);

            //$argc = count($argo);
            global $argv;
            $argc = count($argv);

            if ($argc > 1) define('PAGE', $argv[1]);
            else define('PAGE', self::DEFAULTPAGE);
            if ($argc > 2) define('ARGU2', $argv[2]);
            else define('ARGU2', false);
            if ($argc > 3) define('ARGU3', $argv[3]);
            else define('ARGU3', false);
            if ($argc > 4) define('ARGU4', $argv[4]);
            else define('ARGU4', false);
            if ($argc > 5) define('ARGU5', $argv[5]);
            else define('ARGU5', false);
            if ($argc > 6) define('ARGU6', $argv[6]);
            else define('ARGU6', false);
            if ($argc > 7) define('ARGU7', $argv[7]);
            else define('ARGU7', false);
            if ($argc > 8) define('ARGU8', $argv[8]);
            else define('ARGU8', false);
            if ($argc > 9) define('ARGU9', $argv[9]);
            else define('ARGU9', false);
        } else {

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = self::DEFAULTPAGE;
            }

            define('ONLINE', true);
            define('METHOD', $_SERVER['REQUEST_METHOD']);
            define('PAGE', $page);
        }

    }
}

