<?php namespace view;
/**
 * @desc update article
 * @namespace view
 * @category view
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Update extends \view\Frontend {

    public function __construct($controbjet) {

        parent::__construct($controbjet);

        echo '<article>';
        self::viewMessage($controbjet->message);
        if ($controbjet->afform) {

        	self::viewForm($controbjet->ticket, $controbjet->authors, 'ticket', 'update_ticket_form_fill');
        } else self::viewTicket($controbjet->ticket, $controbjet->rate, 1);
        echo '</article>';

        self::viewModal($controbjet->modal, 'de la base de données', 'merci');
    }

	private static function viewForm(\model\Ticket $ticket, $authors, string $dcl, string $name): void {

		//$color = \Colors\RandomColor::one(array('luminosity'=>'light'));
		$color = $ticket->getColor(); ?>
  <div class="<?=$dcl;?>" style="background-color: <?=$color;?>>;">

    <form method="post" action="">

      <label for="title" class="form-label">titre:</label>
      <p><input class="form-control" id="title" type="text" name="title" value="<?=$ticket->getTitle();?>" /></p>
      <label for="description" class="form-label">description:</label>
      <p><textarea class="form-control" id="description" name="description"><?=$ticket->getDescription() ?></textarea></p>
      <label for="body" class="form-label">étapes:</label>
      <p><textarea class="form-control" id="body" name="body"><?=$ticket->getBody() ?></textarea></p>
      <label for="keywords" class="form-label">produits:</label>
      <p><textarea class="form-control" id="keywords" name="keywords"><?=$ticket->getKeywords() ?></textarea></p>
      <label for="prix" class="form-label">prix:</label>
      <p><?php echo self::array2option(array('1/4' => 1, '2/4' => 2, '3/4' => 3, '4/4' => 4), 'prix', $ticket->getPrix()); ?></p>
      <label for="diff" class="form-label">difficulté:</label>
      <p><?php echo self::array2option(array('1/4' => 1, '2/4' => 2, '3/4' => 3, '4/4' => 4), 'diff', $ticket->getDiff()); ?></p>
      <label for="temps" class="form-label">temps (seconds):</label>
      <p><input class="form-control" id="temps" type="text" name="temps" value="<?=$ticket->getTemps();?>" /></p>
      <label for="personne" class="form-label">personne:</label>
      <p><input class="form-control" id="personne" type="text" name="personne" value="<?=$ticket->getPersonne();?>" /></p>
      <label for="photo" class="form-label">photo:</label>
      <p><input class="form-control" name="photo" type="file" id="photo" value="<?=$ticket->getPrix();?>"></p>
      <label for="cuisinier" class="form-label">cuisinier:</label>
      <p><?php echo self::author2option($authors, 'cuisinier', $ticket->getCuisinier());?></p>

      <p><input id="update" type="submit" name="<?=$name;?>" value="save"/></p>
      <p><input id="cancel" type="submit" name="<?=$name;?>" value="cancel"/></p>
    </form>
  </div>
  <?php
    }

    protected static function array2option($arrr, string $name, string $value): string {

    	$code = '<select class="form-select" id="'.$name.'" name="'.$name.'" aria-label="'.$name.'">';
    	foreach($arrr as $nom => $val) {

    		if ($val == $value) $code = $code.'<option selected>'.$nom.'</option>';
    		else $code = $code.'<option value="'.$val.'">'.$nom.'</option>';
    	}

    	return $code.'</select>';
    }

    protected static function author2option($arrauth, string $name, string $value): string {

        $code = '<select class="form-select" id="'.$name.'" name="'.$name.'">';
        foreach (array_reverse($arrauth) as $chef) {

            $nom = $chef->getNom().', '.$chef->getPrenom();
        	if ($chef->getId() == $value) $code = $code.'<option selected>'.$nom.'</option>';
            else $code = $code.'<option value="'.$chef->getId().'">'.$nom.'</option>';
        }

        return $code.'</select>';
    }

} ?>



