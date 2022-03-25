<?php namespace model\admin;

class MembreManager extends \model\DBManager {/* interface
	database */
	private $tab = 'membre';//le nom du tableau dans la base de donnée
	public function select($pseudo, $password) {

		$query = "SELECT * FROM ".$this->tab;
		$query = $query." WHERE pseudo='".$pseudo."'";
		$query = $query." AND password='".$password."'";

		$result = mysqli_query($this->get(), $query);
		$objet = mysqli_fetch_object($result);

		return $objet ? new \model\admin\Membre($objet) : false;
	}
}

