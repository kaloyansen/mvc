<?php namespace model;
/**
 * @desc cuisinier container
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Cuisinier {

    private int $id;
    private string $nom;
    private string $prenom;
    private string $photo;
	/**
	 */
	public function __construct($objet = false, $id = false) {

		if ($id) $this->setId($id);
		if ($objet) $this->consume($objet);
	}

	public function getId(): int { return $this->id; }
	public function getNom(): string { return $this->nom; }
	public function getPrenom(): string { return $this->prenom; }
	public function setId(int $id): void { $this->id = $id; }
	public function setNom(string $nom): void { $this->nom = $nom; }
	public function setPrenom(string $prenom): void { $this->prenom = $prenom; }

	protected function consume($obj): void {

		$this->id = $obj->cid;
		$this->nom = $obj->nom;
		$this->prenom = $obj->prenom;
		$this->photo = $obj->photo;
	}

	public function __toString(): string {

		$br = '<br />';
		$code = '<div class="ticket">';
		$code = $code.$br.$this->nom.', '.$this->prenom;
		$photo = 'cuisinier.'.$this->id.'.png';
		$code = $code.'<img src="'.IMG.'/'.$photo.'" alt="'.$photo.' not found" />';
		return $code.$br.'</div>';
	}

}

