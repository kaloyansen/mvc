<?php namespace view;
/**
 * @desc BackOffice COntroller Boco extends FrontOffice COntroller class Foco
 * @abstract backoffice methods are reserved to administrator
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.5
 */
class Login extends \view\Formulaire {

	function __construct($controbjet) {

		parent::__construct($controbjet);

		echo '<article>';
		self::viewMessage($controbjet->message);
		self::adminForm($controbjet, 'validate');
		echo '</article>';
		echo '<script src="'.MEDIA.'/js/keypad.js"></script>';
	}

} ?>

