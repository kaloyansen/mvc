<?php namespace view;
/**
 * @desc new administrator form
 * @abstract create new administrator login
 * @namespace view
 * @category view
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class Admin extends \view\Objet {

	function __construct($controbjet) {

		echo '<article>';
		echo '<h2>'.$controbjet->message.'</h2>';
		echo '<h3>total '.count($controbjet->admin_array).' administrateurs</h3>';
		self::viewAdmin($controbjet->admin_array);
		if ($controbjet->afform) self::formulaire($controbjet);
		if ($controbjet->message) self::modal($controbjet->message, 'de la base de données', 'merci');
		echo '</article>';
	}

	protected static function viewAdmin($adminarray): void {

		foreach (array_reverse($adminarray) as $admin) echo '<h3>'.$admin->getId().'. '.$admin->getPseudo().' created by '.$admin->getParent().'</h3>';
		echo '<a id="create" class="loco" href="'.WWW.'?page=admin&id=10000">create a new administrator</a>';
	}

	private static function formulaire($controbjet): void {

	    ?>
  <div class="row" id="result"></div>
  <div class="row" id="connection">

    <form class="col-8 p-auto m-auto"
          id="logform"
          action="<?=$controbjet->action;?>"
          method="post"
          enctype="application/x-www-form-urlencoded">

      <input type="hidden" name="new_admin_form_fill" value="true" />

      <div class="form-group">
        <label for="pseudo">identifiant</label>
        <input type="email"
               class="form-control"
               id="pseudo"
               name="pseudo"
               maxlength="255"
               value=""
               placeholder="identifiant" required />
        <span class="pseudoErr"></span>
      </div>
      <div class="form-group">
        <label for="password">mot de passe</label>
        <input type="password"
               class="form-control"
               id="password"
               name="password"
               maxlength="6"
               value=""
               placeholder="mot de passe" disabled required />
        <span class="passwordErr"></span>
      </div>
      <div id="pad" class="form-group mx-auto my-4"></div>
      <div class="mt-3 text-center">
        <button type="button" class="btn btn-secondary" id="reset">Effacer</button>
        <button type="submit" class="btn btn-primary" id="create">Valider</button>
      </div>
    </form>
  </div>

<script src="<?=MEDIA ?>/js/keypad.js"></script>
<?php
	}

} ?>

