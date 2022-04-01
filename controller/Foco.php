<?php namespace controller;
/**
 * @desc FrontOffice COntroller Foco
 * @abstract extends main controller class Moco
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.1.1
 */
class Foco extends \controller\Moco {

    public function __construct($page = false) {

        self::permettre();//free access to frontoffice
        if ($page) self::setPage($page);
        else self::setPage('lien');
    }

    public function love(): void {

    	$id = self::idLoad();
    	$rate = array();
    	$tickets = array();
    	$author = array();

    	$mana = new \model\TicketManager();
    	$message = $mana->loveMeDo($id);
    	$ticket = $mana->select($id);
    	$ticket->setLove($mana->sheLovesMe($id));
    	$author[] = $mana->author($ticket);
    	$rate[] = $mana->rate($id);
    	unset($mana);

    	$tickets[] = $ticket;

        $view = new \classe\View(self::getPage());
        $view->manger($ticket);
        $view->afficher( (object) array('message' => $message,
                                        'ticket_array' => $tickets,
                                        'rate' => $rate,
                                        'author' => $author
        ) );
    }

    public function liste(): void {

    	$rate = array();
    	$author = array();

    	$mana = new \model\TicketManager();
        $message = $this->transMess($mana->count().' free tickets available');
        $tickets = $mana->selectAll(4);
        foreach ($tickets as $ticket) {
        	$id = $ticket->getId();
        	$ticket->setLove($mana->sheLovesMe($id));
        	$author[] = $mana->author($ticket);
        	$rate[] = $mana->rate($id);
        }
        unset($mana);

        $view = new \classe\View(self::getPage());
        $view->manger($tickets[0]);
        $view->afficher( (object) array('message' => $message,
                                        'ticket_array' => $tickets,
                                        'rate' => $rate,
                                        'author' => $author
        ) );
	}

    public function objet(): void {

        $id = self::idLoad();
        $rate = array();
        $tickets = array();
        $author = array();

        $mana = new \model\TicketManager();
        $ticket = $mana->select($id);
        $ticket->setLove($mana->sheLovesMe($id));
        $tickets[] = $ticket;
        $rate[] = $mana->rate($id);
        $author[] = $mana->author($ticket);
        unset($mana);

        $view = new \classe\View(self::getPage());
        $view->manger($ticket);
        $view->afficher( (object) array('message' => $this->transMess(self::tikid()),
                                        'ticket_array' => $tickets,
                                        'rate' => $rate,
                                        'author' => $author
        ) );
    }

    private static function fill(\model\TicketManager $tman, $tickarr, $author, $rate): void {

    	foreach ($tickarr as $ticket) {
    		$id = $ticket->getId();
    		$ticket->setLove($tman->sheLovesMe($id));
    		$author[] = $tman->author($ticket);
    		$rate[] = $tman->rate($id);
    	}
    }

    public function author(): void {

    	$id = self::cidLoad();
    	$rate = array();
    	$tickets = array();
    	$author = array();

    	$mana = new \model\TicketManager();
    	$cuisinier = $mana->selectAuthor($id);
    	$tickets = $mana->selectSameAuthor($id);

    	self::fill($mana, $tickets, $author, $rate);/*
    	foreach ($tickets as $ticket) {
    		$id = $ticket->getId();
    		$ticket->setLove($mana->sheLovesMe($id));
    		$author[] = $mana->author($ticket);
    		$rate[] = $mana->rate($id);
    	}*/
    	unset($mana);

    	$view = new \classe\View('author');
    	$view->manger($tickets[0]);
    	$view->afficher( (object) array('cuisinier' => $cuisinier,
                                        'ticket_array' => $tickets,
    	                                'rate' => $rate,
    	                                'author' => $author
    	) );
    }

    /**
     * when a page has not been recognized
     */
    public function perdu(): void {

    	$message = $this->transMess(PAGE.' not found');
    	$view = new \classe\View('perdu', $message, $message, $message);
    	$view->afficher( (object) array('message' => $message) );
    }


} ?>

