<?php namespace classe;
/**
 * conception et description
 */
class View {
	private $dossier;
    private $fichier;
    private $titre;
    private $description;
    private $keywords;

    public function __construct($dossier, $fichier, $titre = 0, $description = 0, $keywords = 0) {

        $this->dossier = $dossier;
        $this->fichier = $fichier;
        $this->titre = $titre;
        $this->description = $description;
        $this->keywords = $keywords;
    }

    public function manger(\model\site\Ticket $ticket) {

        $this->titre = $ticket->getTitle();
        $this->description = $ticket->getDescription();
        $this->keywords = $ticket->getKeywords();
    }

    public function afficher($controbjet = 0) {/* téléporte
		au _gabarit.php */
		$gabarit = VIEW.'/_gabarit.php';
		$dinamit = VIEW.'/'.$this->dossier.'/'.$this->fichier.'.php';

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

