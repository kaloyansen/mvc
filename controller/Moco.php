<?php namespace controller;
/**
 * @desc Main COntroller class Moco
 * @abstract controller superclass
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.6
 */
class Moco {

    private static bool $permisDAppelerMethode;
    private static int $private_id;
    private static $private_tikid;
    private static string $page;

    public function __construct() { self::permettre(); }

    public function jePeuxEntrer(): bool { return self::$permisDAppelerMethode; }
    protected static function permettre(): void { self::$permisDAppelerMethode = true; }
    protected static function interdire(): void { self::$permisDAppelerMethode = false; }

    protected static function id(): int { return self::$private_id; }
    protected static function tikid() { return self::$private_tikid; }
    protected static function setPage(string $page): void { self::$page = $page; }
    protected static function getPage(): string { return self::$page; }
    protected static function echoo(string $happy): void { echo '(-'.$happy.'-)'; }
    protected static function fromPost(string $par) { return isset($_POST[$par]) ? $_POST[$par] : false; }
    protected static function fromGet(string $par) { return isset($_GET[$par]) ? $_GET[$par] : false; }
    protected static function fromSession(string $par) { return isset($_SESSION[$par]) ? $_SESSION[$par] : false; }
    protected static function checkAccess(): ?string {

    	$user = self::fromSession('user');
    	if ($user) return $user;
    	return self::passe();
    }

    protected static function idLoad(): int {

    	self::$private_id = self::readid();
    	self::$private_tikid = 'ticket #'.self::$private_id;
    	return self::id();
    }

    protected static function cidLoad(): int {

    	self::$private_id = self::readcid();
    	self::$private_tikid = 'cuisinier #'.self::$private_id;
    	return self::id();
    }

    protected function transMess($message) {

        $ses = self::fromSession('message');
        $_SESSION['message'] = $message;
        error_log('message old('.$ses.') new('.$message.')');

        return $ses ? $message.'(-> '.$ses.' <-)' : $message;
    }

    private static function readid(): int {

    	if (ONLINE) $iid = self::fromGet('id');
    	else $iid = ARGU2;
    	if ($iid) return intval($iid); //{ || $inputid == 0) {

    	$db = new \model\TicketManager();
    	$iid = $db->last();
    	unset($db);
    	return intval($iid);
    }

    private static function readcid(): int {

    	if (ONLINE) $iid = self::fromGet('id');
    	else $iid = ARGU2;
    	if ($iid) return intval($iid);

    	$db = new \model\TicketManager();
    	$iid = $db->lastAuthor();
    	unset($db);
    	return intval($iid);
    }

    private static function passe(): ?string {

        $pseudo = false;
        $password = false;

        if (ONLINE) {
            $pseudo = self::fromPost('pseudo');
            $password = self::fromPost('password');
        } else {
            $pseudo = ARGU2;
            $password = ARGU3;
        }

        if (!$pseudo || !$password) return null;
        $db = new \model\MembreManager();
        $access = $db->select($pseudo, $password);
        unset($db);

        if ($access) {
        	$_SESSION['user'] = $pseudo;
        	error_log('user('.$pseudo.') login');
        	return $pseudo;
        }

        return null;
    }

}

?>