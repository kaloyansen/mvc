<?php namespace classe;
/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc view class
 * @abstract a class to create and display a web page
 * @version 0.0.3
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

        $dinaclass = '\\view\\'.ucfirst($this->chemin);

        ob_start();
        new $dinaclass($controbjet);
        $content = ob_get_clean();

        $gabarit = new \view\Gabarit($content);
        $gabarit->tourne( (object) array(
            'titre' => $this->titre,
            'description' => $this->description,
            'keywords' => $this->keywords));
    }
}

