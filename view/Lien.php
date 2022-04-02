<?php namespace view;
/**
 * @desc dinamic part of the web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Lien extends \view\Objet {
	/**
	 */
	public function __construct($controbjet) {

		$ta = $controbjet->ticket_array;
		$rate = $controbjet->rate;
		$total = count($rate);
		$author = $controbjet->author;
        //echo '<div class="box">';
        echo '<h2><?=$controbjet->message;?></h2>';
        //echo '<ul>';
        foreach (array_reverse($ta) as $ticket) {

        	$total --;
        	self::viewTicket($ticket, $author[$total], $rate[$total], 2);
        }

    }
}
