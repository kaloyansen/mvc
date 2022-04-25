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
/*
            echo '<div class="col">';
            self::viewAdmin(null);
            echo '</div>';

            echo '<div class="col">';
            self::viewAuthor(null);
            echo '</div>';

            echo '<div class="col">';
            self::viewTicket(null);
            echo '</div>';
  */

			echo '<div class="col"></div>';
			echo '<div class="col">';
            echo '<a title="nouvel/le administrateur/euse" id="insert-admin" class="btn btn-outline-danger btn-lg" href="';
            echo WWW.'?page=admin&id=11111">créer un administrateur</a>';
            echo '</div>';

            echo '<div class="col">';
            echo '<a title="nouveau/elle cuisinier/ère" id="insert-author" class="btn btn-outline-warning btn-lg" href="';
            echo WWW.'?page=chef">créer un author</a>';
            echo '</div>';

            echo '<div class="col">';
            echo '<a title="nouvelle recette" id="insert-ticket" class="btn btn-outline-success btn-lg" href="';
            echo WWW.'?page=insert">créer un article</a>';
            echo '</div>';

            echo '<div class="col"></div>';
            echo '</article>';
		}
		self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}

} ?>

