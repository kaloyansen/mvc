<?php namespace controller;
/**
 * @desc Main COntroller class Moco
 * @abstract controller superclass
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.7
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

        if (ONLINE) $iid = self::fromGet('id');
        else $iid = ARGU2;
        if ($iid) return intval($iid);

        $db = new \model\TicketManager();
        $iid = $db->last();
        unset($db);
        return intval($iid);
    }

    private static function readCid(): int {

        if (ONLINE) $iid = self::fromGet('id');
        else $iid = ARGU2;
        if ($iid) return intval($iid);

        $db = new \model\TicketManager();
        $iid = $db->lastAuthor();
        unset($db);
        return intval($iid);
    }

    protected function transMess($message) {

        $ses = self::fromSession('message');
        $_SESSION['message'] = $message;
        error_log('message old('.$ses.') new('.$message.')');

        return $ses ? $message.'(-> '.$ses.' <-)' : $message;
    }

    private static function passe(): ?string {

        if (ONLINE) {
        	//var_dump($_POST);
            $pseudo = self::fromPost('pseudo');
            $password = self::fromPost('password');
        } else {
            $pseudo = ARGU2;
            $password = ARGU3;
        }

        if (!$pseudo || !$password) {
        	error_log(__CLASS__.'::passe('.$pseudo.':'.$password.')');
        	return null;
        }

        $db = new \model\MembreManager();
        $access = $db->checkPassword($pseudo, $password); //var_dump($access);
        unset($db);

        if ($access) {

        	$_SESSION['user'] = $pseudo;
            self::modal($pseudo.' login success', 'bravo', 'continuer');
            return $pseudo;
        }

        return null;
    }

    protected static function modal(string $message, string $title = 'message', string $ok = 'close'): void { ?>

    	<script src="<?=MEDIA;?>/js/jquery-3.6.0.min.js"></script>
    	<script>
          $(window).on('load', function() {
              $('#modalTag').modal('show');
          });
        </script>

    	<div class="modal fade" id="modalTag" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><?=$title;?></h5>
                <button type="button" class="btn-inline btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><?=$message;?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="close" data-bs-dismiss="modal"><?=$ok;?></button>
              </div>
            </div>
          </div>
        </div>
        <?php
    }


} ?>