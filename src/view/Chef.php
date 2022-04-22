<?php namespace view;
/**
 * @desc the dinamic part of the author web page
 * @abstract dinamic frontoffice frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Chef extends \view\Frontend {
	/**
	 */
	public function __construct($controbjet) {

		\view\Frontend::__construct($controbjet);

		echo '<article class="container">';
		self::viewMessage($controbjet->message);

		if ($controbjet->afform) self::viewAuthorForm($controbjet->action, 'ticket', 'author_form_fill');
        else echo $controbjet->cuisinier;

		echo '</article>';

		self::viewModal($controbjet->modal);
    }

    protected static function viewAuthorForm(string $action, string $dcl, string $name): void {

    ?><div class="<?=$dcl;?>">
      <form method="post" action="<?=$action;?>">

        <label for="nom" class="form-label">nom:</label>
        <p><input id="nom" class="form-control" type="text" name="nom" required/></p>

        <label for="prenom" class="form-label">prénom:</label>
        <p><input id="prenom" class="form-control" type="text" name="prenom" required/></p>

        <label for="photo" class="form-label">photo:</label>
        <p><input id="photo" class="form-control" type="text" name="photo" /></p>

        <p><input id="update" class="btn btn-outline-primary" type="submit" name="<?=$name;?>" value="save"/></p>
        <p><input id="cancel" class="btn btn-outline-secondary" type="submit" name="<?=$name;?>" value="cancel"/></p>

      </form>
    </div><?php
    }



}

