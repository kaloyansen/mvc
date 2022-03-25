<?php namespace controller;
/**
 *
 * @author Kaloyan KRASTEV
 *
 */
class Controller {

    private static $permisDAppelerMethode;
    private static $private_id;
    private static $private_tikid;

    public function __construct() { self::permettre(); }
    public function jePeuxEntrer() { return self::$permisDAppelerMethode; }

    protected static function permettre() { self::$permisDAppelerMethode = true; }
    protected static function interdire() { self::$permisDAppelerMethode = false; }
    protected static function id() { return self::$private_id; }
    protected static function tikid() { return self::$private_tikid; }

    protected static function echoo($happy) { echo '(-'.$happy.'-)'; }
    protected static function fromPost($par) { return isset($_POST[$par]) ?
                                                      $_POST[$par] : false; }
    protected static function fromGet($par) { return isset($_GET[$par]) ?
                                                     $_GET[$par] : false; }
    protected static function fromSession($par) { return isset($_SESSION[$par]) ?
                                                         $_SESSION[$par] : false; }
    protected static function checkAccess() {

    	$user = self::fromSession('user');
    	if ($user) return $user;
    	return self::passe();
    }

    protected static function idLoad() {

    	self::$private_id = self::readid();
    	self::$private_tikid = 'ticket #'.self::$private_id;
    }

    protected function transMess($message) {

        $ses = self::fromSession('message');
        $_SESSION['message'] = $message;
        error_log('message old('.$ses.') new('.$message.')');

        return $ses ? $message.'(-> '.$ses.' <-)' : $message;
    }

    private static function readid() {

        if (ONLINE) {
            $inputid = self::fromGet('id');
        } else {
            $inputid = ARGU2;
        }

        if (!$inputid || $inputid == 0) {
            $db = new \model\site\TicketManager();
            $inputid = $db->last();
            unset($db);
        }

        return $inputid;
    }

    private static function passe() {

        $pseudo = false;
        $password = false;

        if (ONLINE) {
            $pseudo = self::fromPost('pseudo');
            $password = self::fromPost('password');
        } else {
            $pseudo = ARGU2;
            $password = ARGU3;
        }

        if (!$pseudo || !$password) return false;

        $db = new \model\admin\MembreManager();
        $access = $db->select($pseudo, $password);
        unset($db);

        if ($access) {
        	$_SESSION['user'] = $pseudo;
        	error_log('user('.$pseudo.') login');
        	return $pseudo;
        }

        return false;
    }

}

?>