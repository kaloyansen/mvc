<?php namespace classe;
/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc view class
 * @abstract a class to create and display a frontend
 * @version 0.0.2
 */
class View {
    private $chemin;
    private $titre;
    private $description;
    private $keywords;

    public function __construct($chemin, $titre = 0, $description = 0, $keywords = 0) {

        $this->chemin = $chemin;
        $this->titre = 'titre par default';
        $this->description = 'description par default';
        $this->keywords = 'clé par default';

        if ($titre) $this->titre = $titre;
        if ($description) $this->description = $description;
        if ($keywords) $this->keywords = $keywords;
    }

    public function manger(\model\Ticket $ticket): void {

        $this->titre = $ticket->getTitle();
        $this->description = $ticket->getDescription();
        $this->keywords = $ticket->getKeywords();
    }

    /**
     * @desc téléporte au _gabarit.php
     */
    public function afficher($controbjet = 0) {
        $gabarit = VIEW.'/_gabarit.php';
        $dinamit = VIEW.'/'.$this->chemin.'.php';

        $view_titre = $this->titre;
        $view_description = $this->description;
        $view_keywords = $this->keywords;

        ob_start();
        include($dinamit);
        $content = ob_get_clean();
        include($gabarit);
        return $view_titre.$view_description.$view_keywords.$content;
    }
}

