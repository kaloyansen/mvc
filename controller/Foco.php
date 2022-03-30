<?php namespace controller;
/**
 * @desc FrontOffice COntroller Foco
 * @abstract extends main controller class Moco
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.7
 */
class Foco extends \controller\Moco {

    public function __construct($page = false) {

        self::permettre();//free access to frontoffice
        if ($page) self::setPage($page);
        else self::setPage('lien');
    }

    public function love(): void {

    	$id = self::idLoad();

    	$manager = new \model\TicketManager();
    	$message = $manager->loveMeDo($id);
    	$ticket = $manager->select($id);
    	$ticket->setLove($manager->sheLovesMe($id));
    	unset($manager);

    	$ticket_array[] = $ticket;

        $view = new \classe\View(self::getPage());
        $view->manger($ticket);
        $view->afficher( (object) array('message' => $message,
                                        'ticket_array' => $ticket_array) );
    }

    public function liste(): void {

    	$manager = new \model\TicketManager();
        $message = $this->transMess($manager->count().' free tickets available');
        $ticket_array = $manager->select();
        foreach ($ticket_array as $ticket) $ticket->setLove($manager->sheLovesMe($ticket->getId()));
        unset($manager);

        $view = new \classe\View(self::getPage());
        $view->manger($ticket_array[0]);
        $view->afficher( (object) array('message' => $message,
                                        'ticket_array' => $ticket_array) );
	}

    public function objet(): void {

        $id = self::idLoad();

        $manager = new \model\TicketManager();
        $ticket = $manager->select($id);
        $ticket->setLove($manager->sheLovesMe($id));
        $ticket_array[] = $ticket;
        unset($manager);

        $view = new \classe\View(self::getPage());
        $view->manger($ticket);
        $view->afficher( (object) array('message' => $this->transMess(self::tikid()),
                                        'ticket_array' => $ticket_array) );
    }

    /**
     * when a page has not been recognized
     */
    public function default(): void {

    	$message = $this->transMess(PAGE.' not found');
    	$view = new \classe\View('default', $message, $message, $message);
    	$view->afficher( (object) array('message' => $message) );
    }


} ?>

