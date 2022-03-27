<?php namespace controller;
/**
 *
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc frontoffice controller class
 * @version 0.0.4
 *
 */
class Foco extends \controller\Moco {

    public function __construct($page = false) {

        self::permettre();//free access to frontoffice
        self::setPage($page);
    }

/**
 * page not recognized
 */
    public function default($viewname = false) {
        $message = $this->transMess(PAGE.' not found');
        $view = new \classe\View('default', $message, $message, $message);
        $view->afficher( (object) array('message' => $message) );
    }

    public function liste($viewname = false) {

        $viewname = $viewname ? $viewname : self::getPage() ? self::getPage() : 'lien';

        $manager = new \model\TicketManager();
        $message = $this->transMess($manager->count().' free tickets available');
        $ticket_array = $manager->select();
        unset($manager);

        $view = new \classe\View($viewname);
        $view->manger($ticket_array[0]);
        $view->afficher( (object) array('message' => $message,
                                        'ticket_array' => $ticket_array) );
	}

    public function objet($viewname = false) {

        $viewname = $viewname ? $viewname : self::getPage() ? self::getPage() : 'lien';

        self::idLoad();

        $manager = new \model\TicketManager();
        $ticket = $manager->select(self::id());
        $ticket_array[] = $ticket;
        unset($manager);

        $view = new \classe\View($viewname);
        $view->manger($ticket);
        $view->afficher( (object) array('message' => $this->transMess(self::tikid()),
                                        'ticket_array' => $ticket_array) );
    }

} ?>

