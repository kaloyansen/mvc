<?php namespace view;
/**
 * @desc dinamic part of the web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Lien {
	/**
	 */
	public function __construct($controbjet) {

		$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
		$ta = $controbjet->ticket_array;
		$rate = $controbjet->rate;
		$total = count($rate);
		$author = $controbjet->author;
        //echo '<div class="box">';
        echo '<h2><?=$controbjet->message;?></h2>';
        //echo '<ul>';
        foreach (array_reverse($ta) as $ticket) {
    	    $total --;
            $id = $ticket->getId();

            echo '<article>';
            //echo '<li>';
            echo '<a class="lien" style="background-color: '.$ticket->getColor().';"';
            echo 'href="'.WWW.'?page=objet&id='.$id.'">';
            echo $id.' '.$ticket->getTitle().' '.$ticket->getDescription().' cuisinier: '.$author[$total];
            echo '</a>';
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
            if ($ticket->getLove() > 0) echo '">[hate ticket #'.$id.' rate('.$rate[$total].')]</a>';
            else echo '">[love ticket #'.$id.' rate('.$rate[$total].')]</a>';
            //echo '</li><br />';
            echo '</article>';
        }
        //echo '</ul>';
        //echo '</div>';
    }
}
