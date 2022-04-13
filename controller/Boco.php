<?php namespace controller;
/**
 * @desc BackOffice COntroller Boco extends FrontOffice COntroller class Foco
 * @abstract backoffice methods are reserved to administrators
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.9
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
            if (!$page) error_log('argument expexted in '.__CLASS__.' constructor');
            else self::setPage($page);
            $this->login();
        } else {
            self::permettre();
        }
    }

    public function deconnexion(): void {

    	$view_class = 'message';

    	$user = self::fromSession('user');
        if (!$user) $user = 'guest';//something wrong
        $message = $user.' deconnexion';

        $_SESSION = array();
        session_destroy();

        $view = new \classe\View($view_class, $message, 'deconnexion', 'clé 5');
        $view->afficher( array('message' => $this->transMess($message)) );
    }

    public function admin(): void {

        $view_class = 'admin';
        $id = self::idLoad();
        $do_insert = false;
        $afficher_formulaire = false;

        if (ONLINE && self::fromPost('new_admin_form_fill')) $do_insert = true;
        elseif ($id == 11111) $afficher_formulaire = true;
        else $afficher_formulaire = false;

        $db = new \model\MembreManager();

        if ($do_insert) {

            $old_admin = $db->selectByPseudo(self::user());
            $new_admin = new \model\Membre(false, true);
            $new_admin->setParent($old_admin->getId());
            $db_insert = $db->insert($new_admin);
            //$db_last = $db->last();
            $message = false;
            $modal = 'admin #'.$db->last().' created('.$db_insert.')';
        } else {

            $message = 'zone admin';
            $modal = false;
        }

        $admin_array = $db->selectAll();
        unset($db);

        $title = $modal ? $modal : $message;
        $view = new \classe\View($view_class, $title, $title, $title);
        $view->afficher( array('message' => $message,
                               'modal' => $modal,
                               'admin_array' => $admin_array,
                               'afform' => $afficher_formulaire) );
    }

    public function insert(): void {

    	$view_class = 'insert';
    	$do_insert = false;
    	$afform = false;
    	$modal = false;
    	$message = false;
    	$ticket = new \model\Ticket();
    	$rate = 0;
    	$authors = array();

    	if (ONLINE) {
    		if (self::fromPost('new_ticket_form_fill') == 'save') {
    			$ticket->loadPost();
    			$mana = new \model\TicketManager();
    			$db_insert = $mana->insert($ticket);
    			$db_last = $mana->last();
    			unset($mana);
    			$modal = 'ticked #'.$db_last.' created('.$db_insert.')';
    		} elseif (self::fromPost('new_ticket_form_fill') == 'cancel') {
    			$message = 'create cancelled';
    		} else {
                $afform = true;
                $mana = new \model\TicketManager();
                $authors = $mana->selectAuthors();
                unset($mana);
    		}
    	}

    	$view = new \classe\View($view_class);
    	$view->manger($ticket);
    	$view->afficher( array('message' => $this->transMess($message),
    			'ticket' => $ticket,
    			'rate' => $rate,
    			'modal' => $modal,
    			'authors' => $authors,
    			'afform' => $afform) );

    	/*
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
    	$view->afficher( array('message' => $this->transMess('create new ticket')) );*/
    }

    public function update(): void {

    	$id = self::idLoad();
    	$view_class = 'update';

		$mana = new \model\TicketManager();
		$ticket = $mana->select($id);
		$rate = $mana->rate($id);
		$authors = $mana->selectAuthors();

		$afform = false;
		$modal = false;
		$message = false;

		if (ONLINE) {
			if (self::fromPost('update_ticket_form_fill') == 'save') {
				$ticket->loadPost();
				$modal = self::tikid().' updated('.$mana->update($id, $ticket).')';
			} elseif (self::fromPost('update_ticket_form_fill') == 'cancel') {
				$message = 'update '.self::tikid().' cancelled';
			} else {
				$afform = true;
			}
		}
			/*
			 unset($db);
			\view\Frontend::viewModal($message, 'de la base de données', 'continuer');
			header('location: '.WWW.'?page=objet&id='.$id); */

		unset($mana);

		$view = new \classe\View($view_class);
		$view->manger($ticket);
		$view->afficher( array('message' => $this->transMess($message),
				'ticket' => $ticket,
				'rate' => $rate,
				'modal' => $modal,
				'authors' => $authors,
				'afform' => $afform) );
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
			$view_class = 'delete';
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

