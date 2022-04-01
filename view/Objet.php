<?php namespace view;
/**
 * @desc a dinamic part of the web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Objet {
	/**
	 */
	public function __construct($controbjet) {

		$ta = $controbjet->ticket_array;
		$rate = $controbjet->rate;
		$total = count($rate);
		$author = $controbjet->author;

		echo '<h2>'.$controbjet->message.'</h2>';
        foreach (array_reverse($ta) as $ticket) {

            $total --;
            self::viewTicket($ticket, $author[$total], $rate[$total], true);
        }
    }

    protected static function linkTicket(\model\Ticket $ticket, $author): void {

    	$id = $ticket->getId();
    	echo '<a class="lien" style="background-color: '.$ticket->getColor().';"';
    	echo 'href="'.WWW.'?page=objet&id='.$id.'">';
    	echo $id.' '.$ticket->getTitle().' '.$ticket->getDescription();
    	echo ' cuisinier: '.$author;
    	echo '</a>';
    }

    protected static function viewTicket(\model\Ticket $ticket, $author, $rate, bool $entier = false): void {

    	echo '<article>';

    	if ($entier) echo $ticket;
    	else self::linkTicket($ticket, $author);

    	$id = $ticket->getId();
    	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    	if ($user) {
    		echo '<a id="modify" class="lien"';
    		echo 'href="'.WWW.'?page=update&id='.$id;
    		echo '">[modify ticket #'.$id.']</a>';
    		echo '<a id="delete" class="lien"';
    		echo 'href="'.WWW.'?page=delete&id='.$id;
    		echo '">[delete ticket #'.$id.']</a>';
    	}

    	echo '<a id="love" class="lien"';
    	echo 'href="'.WWW.'?page=love&id='.$id;
    	if ($ticket->getLove() > 0) echo '">[hate ticket #'.$id.' rate('.$rate[0].')]</a>';
    	else echo '">[love ticket #'.$id.' rate('.$rate[0].')]</a>';
    	echo '<article>';
    }



}

