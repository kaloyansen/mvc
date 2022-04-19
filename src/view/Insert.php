<?php namespace view;
/**
 * @desc backoffice new article view
 * @abstract backoffice methods are reserved to administrator
 * @namespace controller
 * @category controller
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Insert extends \view\Frontend {

    function __construct($controbjet) {

        parent::__construct($controbjet);

        echo '<article>';
        self::viewMessage($controbjet->message);
        self::viewForm($controbjet, 'box', 'new_ticket_form_fill');
        echo '</article>';

        self::viewModal($controbjet->modal, 'de la base de données', 'merci');
	}

	private static function viewForm($controbjet, string $dcl, string $name): void {

		$color = \Colors\RandomColor::one(array('luminosity'=>'light'));?>
      <div class="<?=$dcl;?>">
        <form method="post" style="background-color: <?=$color;?>;" action="">
          <p><input type="hidden" name="<?=$name;?>" value="true" /></p>
          <p><input id="title" type="text" name="title" placeholder="title" /></p>
          <span class="titleErr"></span>
          <p><textarea id="body" name="body" placeholder="body"></textarea></p>
          <span class="bodyErr"></span>
          <p><input id="position" type="text" name="position" placeholder="position" /></p>
          <span class="positionErr"></span>
          <p><input id="status" type="text" name="status" placeholder="status" /></p>
          <span class="statusErr"></span>
          <p><input id="color" type="hidden" name="color" value="<?=$color;?>"></p>
          <span class="colorErr"></span>
          <p><input id="description" type="text" name="description" placeholder="description" /></p>
          <span class="descriptionErr"></span>
          <p><input id="keywords" type="text" name="keywords" placeholder="keywords" /></p>
          <span class="keywordsErr"></span>
	      <p><input id="submit" type="submit" value="create ticket" /></p>
	      <span class="submitErr"></span>
        </form>
      </div>
      <?php
	}
}

?>