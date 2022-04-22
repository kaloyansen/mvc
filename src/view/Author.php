<?php namespace view;
/**
 * @desc the dinamic part of the author web page
 * @abstract dinamic frontoffice frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.8
 */
class Author extends \view\Frontend {

    public function __construct($controbjet) {

        \view\Frontend::__construct($controbjet);

        echo '<article class="container">';
        self::viewMessage($controbjet->message);
        $ca = $controbjet->cuisinier_array;

        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
        foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);

		echo '</article>';
		self::viewModal($controbjet->modal, 'de la base de données', 'merci');
    }

    protected static function viewAuthorForm(string $dcl, string $name): void {


    ?><div class="<?=$dcl;?>">

    <form method="post" action="">

      <label for="nom" class="form-label">nom:</label>
      <p><input id="nom" class="form-control" type="text" name="nom" /></p>
      <label for="prenom" class="form-label">prénom:</label>
      <p><input id="prenom" class="form-control" type="text" name="prenom" /></p>
      <label for="photo" class="form-label">photo:</label>
      <p><input id="photo" class="form-control" type="text" name="photo" /></p>

      <p><input id="update" type="submit" name="<?=$name;?>" value="save"/></p>
      <p><input id="cancel" type="submit" name="<?=$name;?>" value="cancel"/></p>
    </form>
  </div>
  <?php
    }






}

