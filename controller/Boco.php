<?php namespace controller;
/**
 * @desc BackOffice COntroller Boco extends FrontOffice COntroller class Foco
 * @abstract backoffice methods are reserved to administrator
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Boco extends \controller\Foco {

    public function __construct($page = false) {

        $access = self::checkAccess();

        if (!$access) {
            self::interdire();
            if (!$page) error_log('expect argument in constructer of '.__CLASS__);
            self::setPage($page);
            $this->login();
        } else {
            self::permettre();
        }
    }

    public function deconnexion() {

        $user = self::fromSession('user');
        if (!$user) $user = 'guest';//something wrong
        $message = $user.' deconnexion';

        $view = new \classe\View('admin/deconnexion', $message, 'deconnexion', 'clé 5');
        $view->afficher( (object) array('user' => $user,
                                        'message' => $this->transMess($message)) );
    }

	public function insert() {

		$do_insert = true;
		$ticket_load_post = false;

		if (ONLINE && self::fromPost('new_ticket_form_fill')) $ticket_load_post = true;
		else $do_insert = false;

		$ticket = new \model\Ticket();
		if ($ticket_load_post) $ticket->loadPost();

		if ($do_insert) {
			$db = new \model\TicketManager();
			$db_insert = $db->insert($ticket);
			$db_last = $db->last();
			$this->transMess('ticked #'.$db_last.' created('.$db_insert.')');
			unset($db);
			header('location: '.WWW.'?page=objet&id='.$db_last);
		}

		$view = new \classe\View('admin/insert_form');
		$view->manger($ticket);
		$view->afficher( (object) array('message' => $this->transMess('create new ticket')) );
	}

	public function update() {

		self::idLoad();

		$do_update = true;
		$db = new \model\TicketManager();
		$ticket = $db->select(self::id());

		if (ONLINE) {
			if (self::fromPost('update_ticket_form_fill')) $ticket->loadPost();
			else $do_update = false;
		} else {
			$ticket->setTitle('new-'.$ticket->getTitle());
		}

		$message = 'update '.self::tikid();
		if ($do_update) {
			$message = self::tikid().' updated('.$db->update(self::id(), $ticket).')';
			unset($db);
			header('location: '.WWW.'?page=objet&id='.self::id());
		}

		unset($db);

		$view = new \classe\View('admin/update_form');
		$view->manger($ticket);
		$view->afficher( (object) array('message' => $this->transMess($message),
                                        'ticket' => $ticket) );
	}

	public function delete() {

		self::idLoad();

		if (ONLINE) {

			$confirm = self::fromPost('delete_ticket_form_fill');
			if ($confirm == 'no') $roule = 'nodel';
			elseif ($confirm == 'yes') $roule = 'del';
			else $roule = false;
		} else {

			$roule = ARGU2 ? 'del' : false;
		}

		$db = new \model\TicketManager();

		if (!$roule) {/* afficher la confirmation
			*/
			$view_chemin = 'admin/delete_confirmation';
			$message = 'delete '.self::tikid().' confirmation';
			$ticket_array[] = $db->select(self::id());
		} else {/* sortir
			*/
			$view_chemin = 'lien';
			if ($roule == 'nodel') {
				$message = self::tikid().' not deleted';
			} elseif ($roule == 'del') {
				$message = self::tikid().' deleted('.$db->delete(self::id()).')';
			} else {
				$message = 'bordel';
			}

			$ticket_array = $db->selectAll();
		}

		unset($db);
		$ticket = $ticket_array[0];

		$view = new \classe\View($view_chemin);
		$view->manger($ticket);
		$view->afficher( (object) array('user' => self::fromSession('user'),
                                        'message' => $this->transMess($message),
                                        'ticket_array' => $ticket_array) );
	}

	private function login(): void {

		$page = self::getPage();
		if (!$page) $page = 'home';

		$message = 'accès à la zone d\'administration';
		$view = new \classe\View('admin/login_form', $message, 'description', 'clé');
		$view->afficher( (object) array('message' => $this->transMess($message),
                                        'action' => WWW.'?page='.$page));
		//return 0;
	}

	public function home() {

		self::idLoad();

		$manager = new \model\TicketManager();
		$ticket = $manager->select(self::id());
		$ticket_array[] = $ticket;
		unset($manager);

		$view = new \classe\View('objet');
		$view->manger($ticket);
		$view->afficher( (object) array('message' => $this->transMess('zone d\'administration'),
                                        'user' => self::fromSession('user'),
                                        'ticket_array' => $ticket_array));
		//return 0;
	}

} ?>

