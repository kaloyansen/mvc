<?php namespace model;
/**
 * @desc cuisinier container
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Cuisinier extends \model\Transport {

    private int $id;
    private string $nom;
    private string $prenom;
    private string $photo;
	/**
	 */
	public function __construct($objet = false, int $id = 0) {

		if ($id) $this->setId($id);
		$this->consume($objet);
	}

	public function getId(): int { return $this->id; }
	public function getNom(): string { return $this->nom; }
	public function getPrenom(): string { return $this->prenom; }
	public function setId(int $id): void { $this->id = $id; }
	public function setNom(string $nom): void { $this->nom = $nom; }
	public function setPrenom(string $prenom): void { $this->prenom = $prenom; }

	protected function consume($objet): void {

		if (!$objet) error_log('séro object in class: '.__CLASS__.' in void methot: consume');
		$this->id = $objet->cid;
		$this->nom = $objet->nom;
		$this->prenom = $objet->prenom;
		if ($objet->photo) $this->photo = $objet->photo;
	}

	public function __toString(): string {

		$br = '<br />';
		$code = '<div class="chef">';//todo class in css
		//$code = $code.$br.$this->nom.', '.$this->prenom;
		$fichier = IMG.'/cuisinier.'.$this->id.'.png';
		//$code = $code.'<img class="petit" src="'.$fichier.'" alt="'.$fichier.' not found" />';
		$code = $code.self::figure($fichier, 'chef '.$this->nom.', '.$this->prenom);
		return $code.$br.'</div>';
	}

}

