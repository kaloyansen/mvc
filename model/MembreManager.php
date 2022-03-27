<?php namespace model;

class MembreManager extends \model\BaseManager {/* interface
	database */
	private $tab = 'membre';//le nom du tableau dans la base de donnée
	public function select($pseudo, $password) {

		$query = "SELECT * FROM ".$this->tab;
		$query = $query." WHERE pseudo='".$pseudo."'";
		$query = $query." AND password='".$password."'";

		//$result = mysqli_query($this->get(), $query);
		$result = self::query($query);
		$objet = mysqli_fetch_object($result);

		return $objet ? new \model\Membre($objet) : false;
	}

	public function insert($pseudo, $password) {

        $query = "INSERT INTO ".$this->tab." (`id`, `pseudo`, `password`) VALUES ";
        $query = $query."(NULL, '".$pseudo."', '".$password."')";

        return self::query($query);

	}
}

