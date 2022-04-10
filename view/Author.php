<?php namespace view;
/**
 * @desc the dinamic part of the author web page
 * @abstract dinamic frontoffice frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.5
 */
class Author extends \view\Frontend {
	/**
	 */
	public function __construct($controbjet) {

		parent::__construct($controbjet);
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
		$ca = $controbjet->cuisinier_array;
		echo '<article class="container">';
		foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
		foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
		foreach (array_reverse($ca) as $chef) self::viewAuthor($chef);
		if ($user) self::viewAuthor(null);
        echo '</article>';
    }

}

