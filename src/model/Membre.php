<?php namespace model;
/**
 * @desc administrator entity class
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Membre extends \model\Transport {/*
    */
    private int $id;
    private int $parent;
    private string $pseudo;
    private string $password;

    public function __construct($body = false, bool $fromPost = false) {

        if ($body) $this->consume($body);
        elseif ($fromPost) $this->loadPost();
        else $this->neuf();
    }

	public function neuf($id = 0) {

		$this->setId($id);
		$this->setParent(1);
		$this->setPseudo('baba');
		$this->setPassword('riba');
	}

	private function consume($body): void {

		$this->id = $body->id;
		$this->parent = $body->parent;
		$this->pseudo = $body->pseudo;
		$this->password = $body->password;
	}

	public function getId(): int { return $this->id; }
	public function getParent(): int { return $this->parent; }
	public function getPseudo(): string { return $this->pseudo; }
	public function getPassword(): string { return $this->password; }

	public function setId(int $id): void { if ($id > 0) $this->id = $id; }
	public function setParent(int $parent): void { $this->parent = $parent; }
	public function setPseudo(string $pseudo): void { $this->pseudo = $pseudo; }
	public function setPassword(string $password): void { $this->password = $password; }

	public function __toString() {

		$krava = '<div><hr>';
		$krava = $krava.'<h4>id: '.$this->id.'</h4><hr>';
		$krava = $krava.'<h5>pseudo: '.$this->pseudo.'</h5>';
		$krava = $krava.'<h6>parent: '.$this->parent.'</h6>';
		return $krava.'<hr></div>';
	}

}

