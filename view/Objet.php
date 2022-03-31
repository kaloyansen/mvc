<?php namespace view;
/**
 * @desc a dinamic part of the web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class Objet {
	/**
	 */
	public function __construct($controbjet) {

		$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'guest';
		$ta = $controbjet->ticket_array;
		$rate = $controbjet->rate;

		$author = $controbjet->author;

		echo '<h2>'.$controbjet->message.'</h2>';

        foreach (array_reverse($ta) as $ticket) {
            $id = $ticket->getId();
            //echo '<a href="'.WWW.'?page=objet&id='.$id.'">';
            echo '<article>';
            echo 'cuisinier: '.$author[0];
            echo $ticket;
            //echo '</a>';
            if ($user != 'guest') {
                echo '<a id="modify" class="lien"';
                echo 'href="'.WWW.'?page=update&id='.$id;
                echo '">[modify ticket #'.$id.']</a>';
                echo '<a id="delete" class="lien"';
                echo 'href="'.WWW.'?page=delete&id='.$id;
                echo '">[delete ticket #'.$id.']</a>';
            }
            //echo $ticket->getLove();
            echo '<a id="love" class="lien"';
            echo 'href="'.WWW.'?page=love&id='.$id;
            if ($ticket->getLove() > 0) echo '">[hate ticket #'.$id.' rate('.$rate[0].')]</a>';
            else echo '">[love ticket #'.$id.' rate('.$rate[0].')]</a>';
            echo '<article>';
        }
    }
}

