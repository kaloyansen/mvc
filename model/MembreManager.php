<?php namespace model;
/**
 * @desc administartor database intrface
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class MembreManager extends \model\BaseManager {

	private $tab = 'membre';//le nom du tableau dans la base de donnée

    public function select($pseudo, $password) {

        $query = "SELECT * FROM ".$this->tab;
        $query = $query." WHERE pseudo='".$pseudo."'";
        $query = $query." AND password='".$password."'";

        $result = $this->sql($query);

        //$objet = mysqli_fetch_object($result);
        //return $objet ? new \model\Membre($objet) : null;
        $admin_array = array();
        while ($mfobj = $result->fetch_object()) $admin_array[] = new \model\Membre($mfobj);

        return empty($admin_array) ? null : $admin_array[0];
    }

	public function selectAll(int $maxtick = 1000) {

		$query = "SELECT * FROM ".$this->tab;
		$result = $this->sql($query);
		if (!$result) return $this->error();

		$admin_array = array();
		while ($mfobj = $result->fetch_object()) {
			if (0 < $maxtick --) $admin_array[] = new \model\Membre($mfobj);
		}
		return empty($admin_array) ? false : $admin_array;
	}

	public function insert(\model\Membre $membre) {

		$query = "INSERT INTO ".$this->tab;
		$query = $query."(pseudo, password, parent)";
		$query = $query." VALUES";
		$query = $query.self::INSEB;
		$query = $query.$membre->getPseudo().self::INSEP;
		$query = $query.$membre->getPassword().self::INSEP;
		$query = $query.$membre->getParent().self::INSEF;

		$result = $this->sql($query);
		if (!$result) return $this->error();
		return $result;
	}

    public function last() {

		$query = "SELECT MAX(id) FROM ".$this->tab;
		$result = $this->sql($query);
		if (!$result) return $this->error();
		return mysqli_fetch_array($result)[0];
	}

	public function delete($id) {

		$query = "DELETE FROM ".$this->tab." WHERE id=".$id;
		$result = $this->sql($query);
		if (!$result) return $this->error();
		return $result;
	}

}

