<?php namespace model;
/**
 * @desc administartor database interface
 * @abstract
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.5
 */
class MembreManager extends \model\BaseManager {

	private $tab = 'membre';

	public function checkPassword($pseudo, $password) {

		$query = "SELECT * FROM ".$this->tab;
		$query = $query." WHERE pseudo='".$pseudo."'";
		$query = $query." AND password='".$password."'";

		$result = self::sql($query);
		$admin_array = self::sql2membreArray($result);
		//$arra = array();
		//while ($mfobj = $result->fetch_object()) $arra[] = new \model\Membre($mfobj);

		$car = count($admin_array);

		if ($car < 1) return null;
		else return $admin_array[0];
	}

	protected static function sql2membreArray($result, int $maxtick = 1000): array {

		$admin_array = array();
		while ($mfobj = $result->fetch_object()) {
            if (0 < $maxtick --) $admin_array[] = new \model\Membre($mfobj);
        }
        return $admin_array;
	}

	public function selectByPseudo($pseudo) {

		$query = "SELECT * FROM ".$this->tab;
		$query = $query." WHERE pseudo='".$pseudo."'";

		$result = self::sql($query);

		$admin_array = self::sql2membreArray($result);
		//$admin_array = array();
		//while ($mfobj = $result->fetch_object()) $admin_array[] = new \model\Membre($mfobj);

		return empty($admin_array) ? null : $admin_array[0];
	}

	public function selectAll(int $maxtick = 1000) {

		$query = "SELECT * FROM ".$this->tab;
		$result = self::sql($query);
		if (!$result) return $this->error();

		$admin_array = self::sql2membreArray($result);
		/*
		$admin_array = array();
		while ($mfobj = $result->fetch_object()) {
			if (0 < $maxtick --) $admin_array[] = new \model\Membre($mfobj);
		}
		*/
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

		$result = self::sql($query);
		return $result ? $result : $this->error();
	}

    public function maxid(): int {

		$query = "SELECT MAX(id) FROM ".$this->tab;
        /*
		$result = self::sql($query);
		if (!$result) return $this->error();
		return mysqli_fetch_array($result)[0];
        */
		return self::sqlint($query);
	}

	public function delete($id) {

		$query = "DELETE FROM ".$this->tab." WHERE id=".$id;
		$result = self::sql($query);
		return $result ? $result : $this->error();
	}

}

