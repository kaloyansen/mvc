<?php namespace view\admin;
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
    	self::viewMessage($controbjet->message);
    	self::viewForm($ta[0]);
    	self::viewModal($controbjet->modal, 'de la base de données', 'merci');
    }

    private static function viewForm($objet): void { ?>

    <article>
      <?=$objet;?>
      <div class="box">
        <form method="post" action="">
          <p><input id="delete" type="submit" name="delete_ticket_form_fill" value="yes"/></p>
          <p><input id="cancel" type="submit" name="delete_ticket_form_fill" value="no"/></p>
        </form></div></article><?php
    }
}
