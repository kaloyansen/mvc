<?php namespace view;
/**
 * @desc the dinamic part of the author web page
 * @abstract dinamic frontoffice frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.9
 */
class Author extends \view\Frontend {

    public function __construct($controbjet) {

        parent::__construct($controbjet);

        echo '<article class="container">';
        self::viewMessage($controbjet->message);
        $ca = $controbjet->cuisinier_array;
        $rate = $controbjet->rate;
        $nart = $controbjet->nart;

        $total = count($rate);
        foreach ($ca as $chef) { $total --; self::viewAuthor($chef, $rate[$total], $nart[$total]); }
        $total = count($rate);
        foreach ($ca as $chef) { $total --; self::viewAuthor($chef, $rate[$total], $nart[$total]); }
        $total = count($rate);
        foreach ($ca as $chef) { $total --; self::viewAuthor($chef, $rate[$total], $nart[$total]); }

        echo '</article>';
		self::viewModal($controbjet->modal, 'de la base de données', 'merci');
    }

}

