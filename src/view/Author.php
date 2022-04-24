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

        parent::__construct($controbjet);

        echo '<article class="container">';
        self::viewMessage($controbjet->message);
        $ca = $controbjet->cuisinier_array;

        foreach ($ca as $chef) self::viewAuthor($chef);
        foreach ($ca as $chef) self::viewAuthor($chef);
        foreach ($ca as $chef) self::viewAuthor($chef);
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

}

