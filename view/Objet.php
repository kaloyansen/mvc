<?php namespace view;
/**
 * @desc a dinamic part of the web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.6
 */
class Objet {
	/**
	 */
	public function __construct($controbjet) {

		$ta = $controbjet->ticket_array;
		$rate = $controbjet->rate;
		$total = count($rate);
		//$author = $controbjet->author;

		echo '<article class="container">';
		foreach (array_reverse($ta) as $ticket) {

        	//echo '<h2>'.$ticket->getTitle().'</h2>';
        	$total --;
            self::viewTicket($ticket, $rate[$total], 1);
        }
        echo '</article>';
	}

    protected static function viewTicket(\model\Ticket $ticket, $rate, int $option = 0): void {

        $lcl = '"loco"';
        $dcl = '"jaba"';
        if ($option == 1) $dcl = '"fill"';

        echo '<div class='.$dcl.'>';

        if ($option == 0) self::ticketLink($ticket, $lcl);
    	elseif ($option == 1) echo $ticket;
    	elseif ($option == 2) self::ticketOverview($ticket, $lcl);
    	else error_log('todo');

    	$id = $ticket->getId();
    	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    	$href = 'href="'.WWW.'?page=';

    	if ($user) {

    		echo '<a id="modify" class='.$lcl;
    		echo $href.'update&id='.$id;
    		echo '">[modify #'.$id.']</a>';
    		echo '<a id="delete" class='.$lcl;
    		echo $href.'delete&id='.$id;
    		echo '">[delete #'.$id.']</a>';
    	}

    	self::etoile($ticket, '"lien"', $rate);
    	echo '</div>';
    }

    private static function etoile(\model\Ticket $ticket, string $link_class, int $rate) {

        $id = $ticket->getId();
        $href = 'href="'.WWW.'?page=';
        $checked = false;
        $title = 'je l\'aime';
        if ($ticket->getLove() > 0) {
        	$checked = 'checked';
        	$title = $title.' plus';
        }

        echo '<a title="'.$title.'" class='.$link_class;
    	echo $href.'love&id='.$id.'">';
    	echo '<span role="button" title="'.$title.'" class="fa fa-star '.$checked.'">'.$rate.'</span>';
    	echo '</a>';
    }

    private static function ticketLink(\model\Ticket $ticket, string $lcl): void {

    	$id = $ticket->getId();

    	echo '<a class='.$lcl.' style="background-color: '.$ticket->getColor().';"';
    	echo 'href="'.WWW.'?page=objet&id='.$id.'">';
    	echo $id.' '.$ticket->getTitle().' '.$ticket->getDescription();
    	echo '</a>';
    }

    private static function ticketOverview(\model\Ticket $ticket, string $lcl): void {

    	$id = $ticket->getId();

    	echo '<a class='.$lcl.' style="background-color: '.$ticket->getColor().';"';
    	echo 'href="'.WWW.'?page=objet&id='.$id.'">';
    	echo $ticket->overview();
    	echo '</a>';
    }

}

