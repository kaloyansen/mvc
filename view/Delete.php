<?php namespace view;
/**
 * @desc delete confirmation
 * @namespace view
 * @category view
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class Delete extends \view\Frontend {

	public function __construct($controbjet) {

		parent::__construct($controbjet);

    	$ta = $controbjet->ticket_array;
    	echo '<article>';
    	self::viewMessage($controbjet->message);
    	self::viewForm($ta[0], 'ticket', 'delete_confirmation_form_fill');
    	echo '</article>';

    	self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}

    private static function viewForm($objet, string $dcl, string $name): void {

        echo $objet;?>
      <div class="<?=$dcl;?>">
        <form method="post" action="">
          <p><input id="delete" type="submit" name="<?=$name;?>" value="yes"/></p>
          <p><input id="cancel" type="submit" name="<?=$name;?>" value="no"/></p>
        </form></div><?php
    }
}
