<?php namespace view;
/**
 * @desc a dinamic overview of articles
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Over extends \view\Objet {
	/**
	 */
	public function __construct($controbjet) {

		$ta = $controbjet->ticket_array;
		$rate = $controbjet->rate;
		$total = count($rate);

		?><article class="container-fluid"><?php
		foreach (array_reverse($ta) as $ticket) {

			$total --;
            self::viewTicket($ticket, $rate[$total], 2);
        }

        ?></article><?php
    }

}

