<?php namespace model\admin;
class Membre {/*
	*/
	private $id;
	private $pseudo;
	private $password;

	public function __construct($body = false) {

		if ($body) {
			$this->take($body);
		} else {
			$this->neuf();
		}
	}

	public function neuf($id = 0) {
		$this->setId($id);
		$this->setPseudo('baba');
		$this->setPassword('riba');
	}

	public function take($body) {
		$this->setId($body->id);
		$this->setPseudo($body->pseudo);
		$this->setPassword($body->password);
	}

	public function getId() { return $this->id; }
	public function getPseudo() { return $this->pseudo; }
	public function getPassword() { return $this->password; }
	public function setId($id) { if ($id > 0) $this->id = $id; }
	public function setPseudo($pseudo) { if (is_string($pseudo)) $this->pseudo = $pseudo; }
	public function setPassword($pw) { if (is_string($pw)) $this->password = $pw; }

	public function __toString() {

		$krava = '<div><hr>';
		$krava = $krava.'<h4>id: '.$this->id.'</h4><hr>';
		$krava = $krava.'<h5>pseudo: '.$this->pseudo.'</h5>';
		$krava = $krava.'<h6>password: '.$this->password.'</h6>';
		return $krava.'<hr></div>';
	}

}

