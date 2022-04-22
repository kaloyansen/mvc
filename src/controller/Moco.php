<?php namespace controller;
/**
 * @desc Main COntroller class Moco
 * @abstract controller superclass
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.8
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
    protected static function getPage(string $page_par_default = 'objet'): string { return self::$page ? self::$page : $page_par_default; }
    protected static function echoo(string $happy): void { echo '(-'.$happy.'-)'; }
    protected static function fromPost(string $par) { return isset($_POST[$par]) ? $_POST[$par] : false; }
    protected static function fromGet(string $par) { return isset($_GET[$par]) ? $_GET[$par] : false; }
    protected static function fromSession(string $par) { return isset($_SESSION[$par]) ? $_SESSION[$par] : false; }
    protected static function user() { return self::fromSession('user'); }
    protected static function checkAccess(): ?string {

        $user = self::fromSession('user');
        if ($user) return $user;
        return self::passe();
    }

    protected static function idLoad(): int {

        self::$private_id = self::readId();
        self::$private_tikid = 'ticket #'.self::$private_id;
        return self::id();
    }

    protected static function cidLoad(): int {

        self::$private_id = self::readCid();
        self::$private_tikid = 'cuisinier #'.self::$private_id;
        return self::id();
    }

    private static function readId(): int {

        if (ONLINE) $diez = self::fromGet('id');
        else $diez = ARGU2;
        if ($diez) return intval($diez);

        $mana = new \model\TicketManager();
        $diez = $mana->maxid();
        unset($mana);
        return $diez;
    }

    private static function readCid(): int {

        if (ONLINE) $cid = self::fromGet('id');
        else $cid = ARGU2;
        if ($cid) return intval($cid);

        $mana = new \model\TicketManager();
        $cid = $mana->maxcid();
        unset($mana);
        return $cid;
    }

    protected function transMess($message) {

        $ses = self::fromSession('message');
        $_SESSION['message'] = $message;
        error_log('message old('.$ses.') new('.$message.')');

        return $ses ? $message.'(-> '.$ses.' <-)' : $message;
    }

    private static function passe(): ?string {

        if (ONLINE) {

            $pseudo = self::fromPost('pseudo');
            $password = self::fromPost('password');
        } else {
            $pseudo = ARGU2;
            $password = ARGU3;
        }

        if (!$pseudo || !$password) {

        	return null;
        } else {

            $mana = new \model\MembreManager();
            $access = $mana->checkPassword($pseudo, $password);
            unset($mana);
            if ($access) {

                $_SESSION['user'] = $pseudo;
                \view\Frontend::viewModal($pseudo.' login success', 'bravo', 'continuer');
                return $pseudo;
            } else {

            	return null;
            }
        }
    }

} ?>