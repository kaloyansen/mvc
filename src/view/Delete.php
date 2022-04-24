<?php namespace view;
/**
 * @desc delete confirmation
 * @namespace view
 * @category view
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class Delete extends \view\Formulaire {

	public function __construct($controbjet) {

		parent::__construct($controbjet);

    	echo '<article>';
    	self::viewMessage($controbjet->message);
    	echo $controbjet->objet;
    	if ($controbjet->afform) self::conForm('ticket', 'confirmation_form_fill');
    	echo '</article>';

    	self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}

}
