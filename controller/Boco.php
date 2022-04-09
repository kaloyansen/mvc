<?php namespace controller;
/**
 * @desc BackOffice COntroller Boco extends FrontOffice COntroller class Foco
 * @abstract backoffice methods are reserved to administrators
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.6
 */
class Boco extends \controller\Foco {
    /**
     * @desc admin peux
     * créer un autre admin
     * créer ou effacer un cuisinier
     * créer, modifier et effacer une recette
     * */
    public function __construct($page = false) {

        $access = self::checkAccess();

        if (!$access) {
            self::interdire();
            if (!$page) error_log('expect argument in constructer of '.__CLASS__);
            else self::setPage($page);
            $this->login();
        } else {
            self::permettre();
        }
    }

    public function deconnexion(): void {

        $user = self::fromSession('user');
        $view_class = 'admin/deconnexion';
        if (!$user) $user = 'guest';//something wrong
        $message = $user.' deconnexion';

        $view = new \classe\View($view_class, $message, 'deconnexion', 'clé 5');
        $view->afficher( array('user' => $user,
                               'message' => $this->transMess($message)) );
    }

    public function admin(): void {

    	$view_class = 'admin';
    	$do_insert = true;
    	$load_post = false;

    	if (ONLINE && self::fromPost('new_admin_form_fill')) $load_post = true;
    	else $do_insert = false;
    	$afficher_formulaire = false;

    	$admin = new \model\Membre();
    	if ($load_post) $admin->loadPost();

    	$db = new \model\MembreManager();

    	if ($do_insert) {

    		$db_insert = $db->insert($admin);
    		$db_last = $db->last();
    		$title = 'admin #'.$db_last.' created('.$db_insert.')';
    		//unset($db);
    		//header('location: '.WWW.'?page=admin&id='.$db_last);//

    	} else {

    		$title = 'créer un(e) administrateur';
            $afficher_formulaire = true;
    	}

        $admin_array = $db->selectAll();
    	unset($db);

    	$view = new \classe\View($view_class, $title, $admin->getPseudo(), $admin->getId());
    	$view->afficher( array('message' => $this->transMess($title),
                               'admin_array' => $admin_array,
    			               'afform' => $afficher_formulaire) );
    }

    public function insert(): void {

    	$view_class = 'insert';
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

    	$view = new \classe\View($view_class);
    	$view->manger($ticket);
    	$view->afficher( array('message' => $this->transMess('create new ticket')) );
    }

    public function update(): void {

		$id = self::idLoad();
		$view_class = 'admin/update_form';

		$do_update = true;
		$db = new \model\TicketManager();
		$ticket = $db->select($id);

		if (ONLINE) {
			if (self::fromPost('update_ticket_form_fill')) $ticket->loadPost();
			else $do_update = false;
		} else {
			$ticket->setTitle('new-'.$ticket->getTitle());
		}

		$message = 'update '.self::tikid();
		if ($do_update) {
			$message = self::tikid().' updated('.$db->update($id, $ticket).')';
			unset($db);
			header('location: '.WWW.'?page=objet&id='.$id);
		}

		unset($db);

		$view = new \classe\View($view_class);
		$view->manger($ticket);
		$view->afficher( array('message' => $this->transMess($message),
                               'ticket' => $ticket) );
	}

	public function delete(): void {

		$id = self::idLoad();

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
			$view_class = 'admin/delete_confirmation';
			$message = 'delete '.self::tikid().' confirmation';
			$ticket_array[] = $db->select($id);
		} else {/* sortir
			*/
			$view_class = 'lien';
			if ($roule == 'nodel') {
				$message = self::tikid().' not deleted';
			} elseif ($roule == 'del') {
				$message = self::tikid().' deleted('.$db->delete($id).')';
			} else {
				$message = 'bordel';
			}

			$ticket_array = $db->selectAll();
		}

		unset($db);
		$ticket = $ticket_array[0];

		$view = new \classe\View($view_class);
		$view->manger($ticket);
		$view->afficher( array('user' => self::fromSession('user'),
                               'message' => $this->transMess($message),
                               'ticket_array' => $ticket_array) );
	}

	private function login(): void {

		$view_class = 'login';
		$page = self::getPage();
		if (!$page) $page = 'home';

		$message = 'accès à la zone d\'administration';
		$view = new \classe\View($view_class, $message, 'description', 'clé');
		$view->afficher( array('message' => $this->transMess($message),
                               'action' => WWW.'?page='.$page) );
	}

	public function home(): void {

		$id = self::idLoad();
		$view_class = 'objet';

		$manager = new \model\TicketManager();
		$ticket = $manager->select($id);
		$ticket_array[] = $ticket;
		unset($manager);

		$view = new \classe\View($view_class);
		$view->manger($ticket);
		$view->afficher( array('message' => $this->transMess('zone d\'administration'),
                               'user' => self::fromSession('user'),
                               'ticket_array' => $ticket_array) );
	}

} ?>

