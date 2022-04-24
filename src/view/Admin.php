<?php namespace view;
/**
 * @desc new administrator form
 * @abstract create new administrator login
 * @namespace view
 * @category view
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.4
 */
class Admin extends \view\Formulaire {

	function __construct($controbjet) {

		parent::__construct($controbjet);
		echo '<article class="row">';
		self::viewMessage($controbjet->message);
		self::viewAdmin($controbjet->admin_array);

		if ($controbjet->afform) {
			self::adminForm($controbjet, 'admin_form_fill');
			echo '</article>';
			echo '<script src="'.MEDIA.'/js/keypad.js"></script>';
		} else {

            echo '<div class="col">';
            self::viewAdmin(null);
            echo '</div>';
            echo '<div class="col">';
            self::viewAuthor(null);
            echo '</div>';
            echo '<div class="col">';
            self::viewTicket(null);
            echo '</div>';
            echo '</article>';
		}
		self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}

} ?>

