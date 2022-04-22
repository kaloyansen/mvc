<?php namespace view;
/**
 * @desc a dinamic overview of articles
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.5
 */
class Over extends \view\Frontend {

    public function __construct($controbjet) {

        parent::__construct($controbjet);

        echo '<article class="container-fluid">';
        $this->viewTicketArray(2);
        $this->viewTicketArray(2);
        $this->viewTicketArray(2);
        $this->viewTicketArray(2);
        echo '</article>';

        self::viewModal($controbjet->modal);
    }
}

