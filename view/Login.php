<?php namespace view;
/**
 * @desc BackOffice COntroller Boco extends FrontOffice COntroller class Foco
 * @abstract backoffice methods are reserved to administrator
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Login extends \view\Objet {

	function __construct($controbjet) { self::loginForm($controbjet); }
	private static function loginForm($controbjet): void { ?>
<article>
  <h2><?=$controbjet->message;?></h2>
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
        <button type="button" class="btn btn-secondary" id="reset">Effacer</button>
        <button type="submit" name="validate" class="btn btn-primary" id="validate">Valider</button>
      </div>
    </form>
  </div>
</article>

<script src="<?=MEDIA ?>/js/keypad.js"></script>
<!----------------------------- jquery ---------------------->
<?php
/* <script src="<?=MEDIA;?>/js/jquery-3.6.0.min.js"></script>
<script src="<?=MEDIA;?>/js/control.js"></script>  */
?>
<?php
	}
} ?>

