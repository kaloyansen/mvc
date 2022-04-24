<?php namespace view;
/**
 * @desc the dinamic part of the author web page
 * @abstract dinamic frontoffice frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Chef extends \view\Formulaire {
	/**
	 */
	public function __construct($controbjet) {

		parent::__construct($controbjet);

		echo '<article class="container">';
		self::viewMessage($controbjet->message);

		if ($controbjet->afform) self::authorForm($controbjet->action, 'ticket', 'author_form_fill');
        else echo $controbjet->cuisinier;

		echo '</article>';

		self::viewModal($controbjet->modal);
    }

}

