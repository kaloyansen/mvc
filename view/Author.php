<?php namespace view;
/**
 * @desc a dinamic part of the author web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class Author extends \view\Objet {
	/**
	 */
	public function __construct($controbjet) {

		$ta = $controbjet->ticket_array;
		$rate = $controbjet->rate;
		$total = count($rate);
		$author = $controbjet->author;

		//echo '<h2>'.$controbjet->message.'</h2>';

		//echo 'cuisinier: '.$author[0];
		echo $controbjet->cuisiner;

		foreach (array_reverse($ta) as $ticket) {

			$total --;
            self::viewTicket($ticket, $author[$total], $rate[$total]);
        }
    }

}

