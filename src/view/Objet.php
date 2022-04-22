<?php namespace view;
/**
 * @desc a dinamic part of the web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.1.0
 */
class Objet extends \view\Frontend {

	public function __construct($controbjet) {

		\view\Frontend::__construct($controbjet);

		echo '<article class="container">';
		$this->viewTicketArray(1);
        echo "</article>";
        self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}

}