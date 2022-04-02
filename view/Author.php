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
		$ca = $controbjet->cuisinier_array;
		$rate = $controbjet->rate;
		$total = count($rate);
		$author = $controbjet->author;

		//echo '<h2>'.$controbjet->cuisinier.'</h2>';
		?><div class="row">
		<div class="col"><?php
          foreach (array_reverse($ca) as $cuisinier) {
              self::viewAuthor($cuisinier);
          }
          foreach (array_reverse($ca) as $cuisinier) {
          	self::viewAuthor($cuisinier);
          }
          foreach (array_reverse($ca) as $cuisinier) {
          	self::viewAuthor($cuisinier);
          }
          ?></div>
		<div class="col-8"><?php
        //echo 'blblllbp';
		foreach (array_reverse($ta) as $ticket) {

			$total --;
            self::viewTicket($ticket, $author[$total], $rate[$total], 2);
        } ?></div></div><?php
    }

    protected static function viewAuthor(\model\Cuisinier $cuisinier): void {
    	?><div class="row">
            <a class="loco" href="<?=WWW;?>?page=author&id=<?=$cuisinier->getId();?>"><?php
        echo $cuisinier;
          ?></a>
          </div><?php
    }
}

