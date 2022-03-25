<?php namespace controller\site;
class Site extends \controller\Controller {/* user controller
*/
    private $sent;
	public function __construct($page = false) {

		self::permettre();//free access
		$this->setSent($page);
	}

	protected function setSent($sent) { $this->sent = $sent; }
	protected function getSent() { return $this->sent; }

    public function default($viewname = false) {/* appear if page not recognized
    */
        $message = $this->transMess(PAGE.' not found');
        $view = new \classe\View('site', 'default', $message, $message, $message);
        $view->afficher( (object) array('message' => $message) );
    }

	public function liste($viewname = false) {

	    $viewname = $viewname ? $viewname : $this->sent ? $this->sent : 'lien';

	    $manager = new \model\site\TicketManager();
		$message = $this->transMess($manager->count().' free tickets available');
		$ticket_array = $manager->select();
		unset($manager);

		$view = new \classe\View('site', $viewname);
		$view->manger($ticket_array[0]);
		$view->afficher( (object) array('message' => $message,
				                        'ticket_array' => $ticket_array) );
	}

    public function objet($viewname = false) {

    	$viewname = $viewname ? $viewname : $this->sent ? $this->sent : 'lien';

    	self::idLoad();

        $manager = new \model\site\TicketManager();
        $ticket = $manager->select(self::id());
        $ticket_array[] = $ticket;
        unset($manager);

        $view = new \classe\View('site', $viewname);
        $view->manger($ticket);
        $view->afficher( (object) array('message' => $this->transMess(self::tikid()),
                                        'ticket_array' => $ticket_array) );
    }

} ?>
