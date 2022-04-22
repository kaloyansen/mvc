<?php namespace controller;
/**
 * @desc FrontOffice COntroller Foco
 * @abstract extends main controller class Moco
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.1.5
 */
class Foco extends \controller\Moco {

    public function __construct($page = false) {

        self::permettre();//free access to frontoffice
        if ($page) self::setPage($page);
        else self::setPage('lien');
    }

    public function love(): void {

    	$id = self::idLoad();
    	$view_class = self::getPage();

    	$rate = array();
    	$tickets = array();
    	//$author = array();

    	$mana = new \model\TicketManager();
    	$message = $mana->loveMeDo($id);
    	$ticket = $mana->select($id);
    	$ticket->setLove($mana->sheLovesMe($id));
    	//$author[] = $mana->authorName($ticket);
    	$rate[] = $mana->rate($id);
    	unset($mana);

    	$tickets[] = $ticket;

        $view = new \classe\View($view_class);
        $view->manger($ticket);
        $view->afficher( array('modal' => $message,
                               'ticket_array' => $tickets,
                               'rate' => $rate
        ) );
    }

    public function all(): void {

    	$view_class = self::getPage();

    	$rate = array();

    	$mana = new \model\TicketManager();
        $message = $this->transMess($mana->count().' free tickets available');
        $tickets = $mana->selectAll();
        foreach ($tickets as $ticket) {
        	$id = $ticket->getId();
        	$ticket->setLove($mana->sheLovesMe($id));
        	//$author[] = $mana->authorName($ticket);
        	$rate[] = $mana->rate($id);
        }
        unset($mana);

        $view = new \classe\View($view_class);
        $view->manger($tickets[0]);
        $view->afficher( array('message' => $message,
                               'ticket_array' => $tickets,
                               'rate' => $rate) );
    }

    public function objet(): void {

        $id = self::idLoad();
        $view_class = self::getPage();

        $rate = array();
        $ticket_array = array();

        $mana = new \model\TicketManager();

        $ticket = $mana->select($id);
        $ticket->setLove($mana->sheLovesMe($id));
        $rate[] = $mana->rate($id);
        //$author[] = $mana->authorName($ticket);
        unset($mana);

        \view\Frontend::viewModal($ticket);
        $ticket_array[] = $ticket;

        $view = new \classe\View($view_class);
        $view->manger($ticket);
        $view->afficher( array('message' => $this->transMess(self::tikid()),
                               'ticket_array' => $ticket_array,
                               'rate' => $rate) );
    }

    public function author(): void {

    	$view_class = 'author';

    	$mana = new \model\TicketManager();
    	$title = "les-magiciens-du-fouet";
    	$cuisinier_array = $mana->selectAuthors();
    	unset($mana);

    	$view = new \classe\View($view_class, $title, $title, $title);
    	$view->afficher( array('cuisinier_array' => $cuisinier_array) );
    }

    public function over(): void {

    	$id = self::cidLoad();
    	$view_class = 'over';

    	$rate = array();

    	$mana = new \model\TicketManager();
    	$cuisinier = $mana->selectAuthor($id);
    	$title = $cuisinier->getNom().', '.$cuisinier->getPrenom();
    	$ticket_array = $mana->selectSameAuthor($id);

    	//self::fill($mana, $tickets, $author, $rate);/*
    	$keys = '';
    	foreach ($ticket_array as $ticket) {
    		$id = $ticket->getId();
    		$keys = $ticket->getTitle().$keys.', ';
    		$ticket->setLove($mana->sheLovesMe($id));
    		$rate[] = $mana->rate($id);
    	}
    	unset($mana);

    	$view = new \classe\View($view_class, $title, $title, $keys);
    	$view->afficher( array('ticket_array' => $ticket_array,
                               'rate' => $rate) );
    }
    /**
     * when a page has not been recognized
     */
    public function perdu(): void {

        $view_class = 'perdu';
    	$message = $this->transMess(PAGE.' not found');
    	$view = new \classe\View($view_class, $message, $message, $message);
    	$view->afficher( array('message' => $message) );
    }


} ?>

