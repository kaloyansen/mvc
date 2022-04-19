<?php namespace view;
/**
 * @desc dinamic part of the web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Lien extends \view\Frontend {
	/**
	 */
	public function __construct($controbjet) {

		parent::__construct($controbjet);

		echo '<article class="container">';
		$this->viewTicketArray(2);

        echo '</article>';
        self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}
}
