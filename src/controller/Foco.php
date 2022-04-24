<?php namespace controller;
/**
 * @desc frontoffice controller
 * @abstract extends main controller class Moco
 * @namespace controller
 * @category frontoffice
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.1.6
 */
class Foco extends \controller\Moco {

    public function __construct($page = false) {

        parent::__construct($page);
    }

    public function love(): void {

    	$id = self::idLoad();

    	$rate = array();
    	$tickets = array();
    	//$author = array();

    	$mana = new \model\TicketManager();
    	$message = $mana->loveMeDo($id);
    	$ticket = $mana->select($id);
    	$ticket->setLove($mana->sheLovesMe($id));
    	$rate[] = $mana->rate($id);
    	unset($mana);

    	$tickets[] = $ticket;

        $view = new \classe\View(self::getPage());
        $view->manger($ticket);
        $view->afficher( array('modal' => $message,
                               'ticket_array' => $tickets,
                               'rate' => $rate
        ) );
    }

    public function all(): void {

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

        $view = new \classe\View(self::getPage());
        $view->manger($tickets[0]);
        $view->afficher( array('message' => $message,
                               'ticket_array' => $tickets,
                               'rate' => $rate) );
    }

    public function objet(): void {

        $id = self::idLoad();

        $rate = array();
        $ticket_array = array();

        $mana = new \model\TicketManager();

        $ticket = $mana->select($id);
        $ticket->setLove($mana->sheLovesMe($id));
        $rate[] = $mana->rate($id);
        unset($mana);

        $ticket_array[] = $ticket;

        $view = new \classe\View(self::getPage());
        $view->manger($ticket);
        $view->afficher( array('message' => $this->transMess(self::tikid()),
                               'ticket_array' => $ticket_array,
                               'rate' => $rate) );
    }

    public function author(): void {

    	$mana = new \model\TicketManager();
    	$title = "les-magiciens-du-fouet";
    	$cuisinier_array = $mana->selectAuthors();
    	unset($mana);

    	$view = new \classe\View(self::getPage(), $title, $title, $title);
    	$view->afficher( array('cuisinier_array' => $cuisinier_array) );
    }

    public function over(): void {

    	$id = self::cidLoad();
    	$rate = array();

    	$mana = new \model\TicketManager();
    	$cuisinier = $mana->selectAuthor($id);
    	$title = $cuisinier->getNom().', '.$cuisinier->getPrenom();
    	$ticket_array = $mana->selectByAuthor($id);

    	//self::fill($mana, $tickets, $author, $rate);/*
    	$keys = '';

    	if ($ticket_array) foreach ($ticket_array as $ticket) {
    		$id = $ticket->getId();
    		$keys = $ticket->getTitle().$keys.', ';
    		$ticket->setLove($mana->sheLovesMe($id));
    		$rate[] = $mana->rate($id);
    	}
    	unset($mana);

    	$view = new \classe\View(self::getPage(), $title, $title, $keys);
    	$view->afficher( array('ticket_array' => $ticket_array,
                               'rate' => $rate) );
    }
    /**
     * when a page has not been recognized
     */
    public function perdu(): void {

    	$message = $this->transMess(PAGE.' not found');
    	$view = new \classe\View(self::getPage(), $message, $message, $message);
    	$view->afficher( array('message' => $message) );
    }


} ?>

