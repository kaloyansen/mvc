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
class Login extends \view\Frontend {

	function __construct($controbjet) {

		parent::__construct($controbjet);

		echo '<article>';
		self::viewMessage($controbjet->message);
		self::viewAdminForm($controbjet, 'validate');
		echo '</article>';
		echo '<script src="'.MEDIA.'/js/keypad.js"></script>';
	}

	protected static function viewAdminForm($controbjet, string $name = 'validate'): void { ?>

  <div class="row" id="result"></div>
  <div class="row" id="connection">

    <form class="col-8 p-auto m-auto"
          id="logform"
          action="<?=$controbjet->action;?>"
          method="post">
          <!-- enctype="application/x-www-form-urlencoded" -->
        <label for="pseudo">identifiant</label>
        <input type="email"
               class="form-control"
               id="pseudo"
               name="pseudo"
               maxlength="255"
               value=""
               placeholder="identifiant" required />
        <span class="pseudoErr"></span>

        <label for="password">mot de passe</label>
        <input type="password"
               class="form-control"
               id="password"
               name="password"
               maxlength="6"
               value=""
               placeholder="mot de passe"
               readonly = "readonly"
               required />
        <span class="passwordErr"></span>

      <div id="pad" class="form-group mx-auto my-4"></div>
      <div class="mt-3 text-center">
        <button type="button" class="btn btn-outline-secondary" id="reset">recharger</button>
        <button type="submit" name="<?=$name;?>" value="1" class="btn btn-outline-primary btn-lg" id="validate">valider</button>
      </div>
    </form>
  </div><?php

	}
} ?>

