<?php namespace classe;
/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @abstract controller method depends on the value of the parameter [page]
 * @version 0.0.3
 */
class Control {
    private const DEFAULTPAGE = 'objet';
    /**
     * @example $objet = new $chemin($argument);
     * @example $resultat = $objet->$method();
     */
    public static function controler(): void {

        $backofficecontroller = 'controller\Boco';
        $frontofficecontroller = 'controller\Foco';
        $chemin = $backofficecontroller;
        $argument = PAGE;
        $method = PAGE;

        switch(PAGE) {

        	//case 'login': break;
        	case 'insert': break;
        	case 'update': break;
            case 'delete': break;
            case 'home': break;
            case 'admin': break;
            case 'deconnexion':
                $argument = 'home';
                break;
            case 'objet':
                $chemin = $frontofficecontroller;
                break;
            case 'lien':
            	$chemin = $frontofficecontroller;
            	break;
            case 'over':
            	$chemin = $frontofficecontroller;
            	break;
            case 'author':
            	$chemin = $frontofficecontroller;
            	break;
            case 'love':
            	$chemin = $frontofficecontroller;
            	$argument = 'objet';
            	break;
            case 'all':
                $chemin = $frontofficecontroller;
                $argument = 'lien';
                break;
            default:
                $chemin = $frontofficecontroller;
                $method = 'perdu';
        }

        $rooter = new \classe\Rooter($chemin, $method, $argument);
        $rooter->control();
    }

    /**
     * automatic loader
     * uses require_once to load a class if the class definition is required
     */
    public static function autoloadClassDefinition() {
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


    /**
     * terminal request simulation
     */
    public static function terminalRequest(): void {

        if (empty($_SERVER['REQUEST_METHOD'])) {//terminall
    	    define('ONLINE', false);
            define('METHOD', false);/* cli à coder
            */
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

    public static function getUserIpAddr(): ?string {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (ONLINE) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '176.176.176.176';
        }

        return $ip;
    }

}

