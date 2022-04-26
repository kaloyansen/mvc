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

		echo '<article class="container-fluid row">';
		self::viewMessage($controbjet->message);

		self::viewAdmin($controbjet->admin_array);

		if ($controbjet->afform) {
			self::adminForm($controbjet, 'admin_form_fill');
			echo '</article>';
			echo '<script src="'.MEDIA.'/js/keypad.js"></script>';
		} else {

			self::newline();
			echo '<div class="d-grid gap-5 d-lg-flex justify-content-md-center" style="height: 222px;">';
			//echo '<div class="d-grid gap-3 d-md-block">';

			self::newline();
			echo '<a style="font-size: 40px;" title="nouvel/le administrateur/euse" id="insert-admin" class="btn btn-outline-danger btn-lg" href="';
			echo WWW.'?page=admin&id=11111">créer un administrateur</a>';
			self::newline();
			echo '<a style="font-size: 40px;" title="nouveau/elle cuisinier/ère" id="insert-author" class="btn btn-outline-warning btn-lg" href="';
			echo WWW.'?page=chef">créer un author</a>';
			self::newline();
			echo '<a  style="font-size: 40px;" title="nouvelle recette" id="insert-ticket" class="btn btn-outline-success btn-lg" href="';
			echo WWW.'?page=insert">créer un article</a>';
			self::newline();
			echo '</div>';
			self::newline();
            echo '</article>';
		}
		self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}

	private static function newline(int $option = 0): void {
		if ($option == -1) echo '<div class="col">';
		echo "\n";
		//echo '<div class="col">';
		if ($option == 1) echo '</div>';
	}

} ?>

