<?php namespace view;
/**
 * @desc a dinamic web page model
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Frontend {
	/**
	 */
	private $controbj;

	public function __construct($controbjet) {

        $this->setObjet($controbjet);
	}

    protected function setObjet($contre): void { $this->controbj = $contre; }
    protected function getObjet() { return $this->controbj; }
    protected function viewTicketArray(int $option = 0): void {

    	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

    	$controbjet = $this->getObjet();
        $ta = $controbjet->ticket_array;
        $rate = $controbjet->rate;
        $total = count($rate);
        foreach (array_reverse($ta) as $ticket) {

            $total --;
            self::viewTicket($ticket, $rate[$total], $option);
        }
        //if ($user) self::viewTicket(null);

    }

	protected static function viewTicket(?\model\Ticket $ticket, $rate = 0, int $option = 0): void {

        $lcl = '"loco"';
        $dcl = '"jaba"';
        $href = ' href="'.WWW.'?page=';
        if ($option == 1) $dcl = '"fill"';

        if (!$ticket) {
        	echo '<div class="ticket">';
        	echo '<a title="nouvelle recette" id="insert" class="lien"';
        	echo $href.'insert">créer un article</a>';
            echo '</div>';
            return;
        }

        echo '<div class='.$dcl.'>';

        if ($option == 0) self::ticketLink($ticket, $lcl);
    	elseif ($option == 1) echo $ticket;
    	elseif ($option == 2) self::ticketOverview($ticket, $lcl);
    	else error_log('todo');

    	$id = $ticket->getId();
    	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

    	self::etoile($ticket, '"lien"', $rate);

    	if ($user) {

    		echo '<a title="update" id="update" class='.$lcl;
    		echo $href.'update&id='.$id;
    		echo '">modify</a>';
    		echo '<a title="delete" id="delete" class='.$lcl;
    		echo $href.'delete&id='.$id;
    		echo '">delete</a>';
    		self::hide($ticket, $lcl);
    		echo ' #'.$id;
    	}

    	echo '</div>';
	}

    private static function hide(\model\Ticket $ticket, string $link_class) {

        $id = $ticket->getId();
        $title = 'hide';
        if ($ticket->getHide() > 0) $title = 'show';

        echo '<a title="'.$title.'" class='.$link_class;
        echo ' href="'.WWW.'?page=hide&id='.$id.'">'.$title.'</a>';
	}

    private static function etoile(\model\Ticket $ticket, string $link_class, int $rate) {

        $id = $ticket->getId();
        $checked = false;
        $title = 'je l\'aime';
        if ($ticket->getLove() > 0) {
        	$checked = 'checked';
        	$title = $title.' plus';
        }

        echo '<a title="'.$title.'" class='.$link_class.' href="'.WWW.'?page=love&id='.$id.'">';
    	echo '<span role="button" title="'.$title.'" class="fa fa-star '.$checked.'">'.$rate.'</span></a>';
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

    protected static function alert(string $message, int $lifetime = 5): void {
    	?><script>
    	const WIN = window.open('', 'message', 'toolbar=yes,scrollbars=yes,resizable=yes,top=66,left=66,width=222,height=333');

    	setTimeout(function() {
        	WIN.document.write('<?=$message;?>');
        	WIN.focus();
        }, <?=$lifetime * 250;?>);

    	setTimeout(function() {
            WIN.close();
        }, <?=$lifetime * 1000;?>);

        </script><?php
    }

    protected static function viewAuthor(?\model\Cuisinier $cuisinier): void {

    	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
    	$id = false;
    	$lcl = '"loco"';
    	$dcl = '"jaba"';

    	if ($cuisinier) {

    		$id = $cuisinier->getId();
    		$href = ' href="'.WWW.'?page=over&id='.$id.'"';
    		$title = 'voir articles';
    		$aid = 'select-'.$id;
    	} else {

    		$cuisinier = 'créer un author';
    		$title = $cuisinier;
    		$href = ' href="'.WWW.'?page=author&id=11111"';
    		$dcl = '"ticket"';
    		$lcl = '"lien"';
    		$aid = 'insert';
    	} ?>
    	<div class=<?=$dcl;?>>
          <a id="<?=$aid;?>" title="<?=$title;?>" class=<?=$lcl;?> <?=$href;?>><?=$cuisinier;?></a><?php
    	if ($user && $id) {
    		$href = ' href="'.WWW.'?page=delchef&id=';
    		echo '<a title="delete #'.$id.'" id="delete" class='.$lcl.$href.$id.'">[delete cuisinier #'.$id.']</a>';
    	} ?>

        </div><?php
    }

    protected static function viewMessage($message): void {

    	if ($message) echo '<h2>'.$message.'</h2>';
    }

    protected static function viewAdmin($adminarray): void {

        if ($adminarray) {
            foreach (array_reverse($adminarray) as $admin) echo '<h3>'.$admin->getId().'. '.$admin->getPseudo().' created by '.$admin->getParent().'</h3>';
        } else {
            echo '<div class="ticket">';
            echo '<a title="nouvel admin" id="insert" class="lien" href="'.WWW.'?page=admin&id=11111">créer un administrateur</a>';
            echo '</div>';
        }
    }

    protected static function viewModal($message, string $title = 'message', string $ok = 'close'): void {

        if (!$message) return; ?>

    	<script src="<?=MEDIA;?>/js/jquery-3.6.0.min.js"></script>
    	<script>
          $(window).on('load', function() {
              $('#modalTag').modal('show');
          });
        </script>

    	<div class="modal fade" id="modalTag" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><?=$title;?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><?=$message;?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="close" data-bs-dismiss="modal"><?=$ok;?></button>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
}

