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
    private $title;
    private $description;
    private $keywords;

    public function __construct($chemin, $title = 0, $description = 0, $keywords = 0) {

        $this->chemin = $chemin;
        $this->title = 'title par default';
        $this->description = 'description par default';
        $this->keywords = 'clé par default';

        if ($title) $this->title = $title;
        if ($description) $this->description = $description;
        if ($keywords) $this->keywords = $keywords;
    }

    public function manger(\model\Ticket $ticket): void {

    	$this->title = $ticket->getTitle();
    	$this->description = $ticket->getDescription();
    	$this->keywords = $ticket->getKeywords();
    }

    /**
      * @desc téléporte au _gabarit.php
      */
    public function afficher($contrarray = 0) {

    	$controbjet = (object) $contrarray;

      	$dinaclass = '\\view\\'.ucfirst($this->chemin);

        ob_start();
        new $dinaclass($controbjet);
        $content = ob_get_clean();

        $gabarit = new \view\Gabarit($content);
        $gabarit->tourne( (object) array(
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords));
    }
}

