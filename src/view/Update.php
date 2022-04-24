<?php namespace view;
/**
 * @desc update/insert article
 * @namespace view
 * @category view
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Update extends \view\Formulaire {

    public function __construct($controbjet) {

        parent::__construct($controbjet);

        echo '<article>';
        self::viewMessage($controbjet->message);
        if ($controbjet->afform) self::ticketForm($controbjet->ticket, $controbjet->authors, 'ticket', 'update_ticket_form_fill');
        else self::viewTicket($controbjet->ticket, $controbjet->rate, 1);
        echo '</article>';

        self::viewModal($controbjet->modal, 'de la base de données', 'merci');
    }

} ?>



