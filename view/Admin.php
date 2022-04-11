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
class Admin extends \view\Frontend {

	function __construct($controbjet) {

		parent::__construct($controbjet);
		echo '<article class="row">';
		self::viewAdmin($controbjet->admin_array);
		echo '<div class="col">';
		//self::viewMessage($controbjet->message);
		//echo '<h3>total '.count($controbjet->admin_array).' administrateurs</h3>';
		self::viewAdmin(null);
		echo '</div>';
		echo '<div class="col">';
		self::viewAuthor(null);
		echo '</div>';
		echo '<div class="col">';
		self::viewTicket(null);
		echo '</div>';

		if ($controbjet->afform) self::viewForm($controbjet);
		self::viewModal($controbjet->modal, 'de la base de données', 'merci');
		echo '</article>';
	}

	private static function viewForm($controbjet): void {

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

