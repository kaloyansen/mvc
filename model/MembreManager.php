<?php namespace model;
/**
 * @author Kaloyan KRASTEV
 * @desc membre database intrface
 * @version 0.0.1
 */
class MembreManager extends \model\BaseManager {

	private $tab = 'membre';//le nom du tableau dans la base de donnée

	public function select($pseudo, $password) {

		$query = "SELECT * FROM ".$this->tab;
		$query = $query." WHERE pseudo='".$pseudo."'";
		$query = $query." AND password='".$password."'";

		$result = $this->sql($query);
		$objet = mysqli_fetch_object($result);

		return $objet ? new \model\Membre($objet) : null;
	}

	public function insert($pseudo, $password) {

		$query = "INSERT INTO ".$this->tab." (`id`, `pseudo`, `password`, `parent`) VALUES ";
        $query = $query."(NULL, '".$pseudo."', '".$password."', '".$_SESSION['user']."')";

        return $this->sql($query);

	}
}

