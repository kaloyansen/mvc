<?php namespace view;
/**
 * @desc les formulaires
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Formulaire extends \view\Frontend {

    public function __construct($controbjet) {

        parent::__construct($controbjet);
    }

    protected static function conForm(string $dcl, string $name): void {

    	?><div class="<?=$dcl;?>">
        <form method="post" action="">
          <p><input id="delete" class="btn btn-outline-primary" type="submit" name="<?=$name;?>" value="yes"/></p>
          <p><input id="cancel" class="btn btn-outline-primary" type="submit" name="<?=$name;?>" value="no"/></p>
        </form></div><?php
    }

    protected static function authorForm(string $action, string $dcl, string $name): void {

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

    protected static function oldAuthorForm(string $dcl, string $name): void {


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
  </div><?php
    }

    protected static function adminForm($controbjet, string $name = 'validate'): void { ?>

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


    protected static function ticketForm(\model\Ticket $ticket, $authors, string $dcl, string $name): void {

		//$color = \Colors\RandomColor::one(array('luminosity'=>'light'));
        $color = $ticket->getColor(); ?>
  <div class="<?=$dcl;?>" style="background-color: <?=$color;?>>;">

    <form method="post" action="">

      <label for="title" class="form-label">titre:</label>
      <p><input class="form-control" id="title" type="text" name="title" value="<?=$ticket->getTitle();?>" /></p>
      <label for="description" class="form-label">description:</label>
      <p><textarea class="form-control" id="description" name="description"><?=$ticket->getDescription() ?></textarea></p>
      <label for="body" class="form-label">étapes:</label>
      <p><textarea class="form-control" id="body" name="body"><?=$ticket->getBody() ?></textarea></p>
      <label for="keywords" class="form-label">produits:</label>
      <p><textarea class="form-control" id="keywords" name="keywords"><?=$ticket->getKeywords() ?></textarea></p>
      <label for="prix" class="form-label">prix:</label>
      <p><?php echo self::array2option(array('1/4' => 1, '2/4' => 2, '3/4' => 3, '4/4' => 4), 'prix', $ticket->getPrix()); ?></p>
      <label for="diff" class="form-label">difficulté:</label>
      <p><?php echo self::array2option(array('1/4' => 1, '2/4' => 2, '3/4' => 3, '4/4' => 4), 'diff', $ticket->getDiff()); ?></p>
      <label for="temps" class="form-label">temps (seconds):</label>
      <p><input class="form-control" id="temps" type="text" name="temps" value="<?=$ticket->getTemps();?>" /></p>
      <label for="personne" class="form-label">personne:</label>
      <p><input class="form-control" id="personne" type="text" name="personne" value="<?=$ticket->getPersonne();?>" /></p>
      <label for="photo" class="form-label">photo:</label>
      <p><input class="form-control" name="photo" type="file" id="photo" value="<?=$ticket->getPrix();?>"></p>
      <label for="cuisinier" class="form-label">cuisinier:</label>
      <p><?php echo self::author2option($authors, 'cuisinier', $ticket->getCuisinier());?></p>

      <p><input id="update" class="btn btn-outline-primary" type="submit" name="<?=$name;?>" value="save"/></p>
      <p><input id="cancel" class="btn btn-outline-secondary" type="submit" name="<?=$name;?>" value="cancel"/></p>
    </form>
  </div>
  <?php
    }

    protected static function array2option($arrr, string $name, string $value): string {

    	$code = '<select class="form-select" id="'.$name.'" name="'.$name.'" aria-label="'.$name.'">';
    	foreach($arrr as $nom => $val) {

    		if ($val == $value) $code = $code.'<option selected>'.$nom.'</option>';
    		else $code = $code.'<option value="'.$val.'">'.$nom.'</option>';
    	}

    	return $code.'</select>';
    }

    protected static function author2option($arrauth, string $name, string $value): string {

        $code = '<select class="form-select" id="'.$name.'" name="'.$name.'">';
        foreach (array_reverse($arrauth) as $chef) {

            $nom = $chef->getNom().', '.$chef->getPrenom();
        	if ($chef->getId() == $value) $code = $code.'<option selected>'.$nom.'</option>';
            else $code = $code.'<option value="'.$chef->getId().'">'.$nom.'</option>';
        }

        return $code.'</select>';
    }




} ?>