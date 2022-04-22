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
	public function __construct($body = false, bool $fromPost = false, int $id = 0) {

		if ($id) $this->setId($id);
		if ($body) $this->consume($body);
		elseif ($fromPost) $this->loadPost();
		else $this->neuf();
	}

	public function getId(): int { return $this->id; }
	public function setId(int $id): void { $this->id = $id; }
	public function getNom(): string { return $this->nom; }
	public function setNom(string $nom): void { $this->nom = $nom; }
	public function getPhoto(): string { return $this->photo; }
	public function setPhoto(string $photo): void { $this->photo = $photo; }
	public function getPrenom(): string { return $this->prenom; }
	public function setPrenom(string $prenom): void { $this->prenom = $prenom; }

	private function neuf(): void {
		$this->setNom('John');
		$this->setPrenom('Lord');
		$this->setPhoto('cuisinier.111.jpg');
	}

    protected function consume($objet): void {

		if (!$objet) error_log('séro object in class: '.__CLASS__.' in void methot: consume');
		if (isset($objet->cid)) $this->id = $objet->cid;
		$this->nom = $objet->nom;
		$this->prenom = $objet->prenom;
		if (isset($objet->photo)) $this->photo = $objet->photo;
	}

	public function __toString(): string {

		$br = '<br />';
		$code = '<div class="chef">';//todo class in css
		//$code = $code.$br.$this->nom.', '.$this->prenom;
		$fichier = IMG.'/cuisinier.'.$this->id.'.jpg';
		//$code = $code.'<img class="petit" src="'.$fichier.'" alt="'.$fichier.' not found" />';
		$code = $code.self::figure($fichier, 'chef '.$this->nom.', '.$this->prenom);
		return $code.$br.'</div>';
	}

}

