<?php namespace model;
/**
 * code php by Kaloyan KRASTEV
 * kaloyansen@gmail.com
 *
 *
 * // !!! safety !!! database connexion ***********
 * // code exemple connexion
 * $database = new DBManager(<initfile>);
 * // suit code user
 * ...
 * unset($database); // déconnexion de la base de données
 *
 * // <initfile> is the name of the file to read the identification from
 * // <initfile> is a text file with a basic line format property: value
 * // !!! add <initfile> to .gitignore to keep it secret !!!
 * // <initfile> example: model/.db.example
 */
class BaseManager {
	private static $conn;
	private static $iconn;
	private static $jsonFile = DOWN."/connexion.json";

	private $server;
	private $username;
	private $password;
	private $database;

	public function get() { return self::$conn; }
	public function __destruct() {
		$this->close();
		error_log('destroying '.__CLASS__."\n");
	}
	public function __construct($infile = false) {
		if (!$infile) $infile = MODEL.'/.db.';
		$this->initFrom($infile);
	    $this->open();
	}

	private function close() { echo "\n"; mysqli_close(self::$conn); }
	private function open() {
		$ok = $this->connexion() == $this->error() ? false : true;
		if (!$ok) $this->reconnexion();//hypotetic
		return $this->export();
	}

	private function export() {

		//file_put_contents(self::$jsonFile, print_r(json_encode(DBManager::getPropArray(self::$conn)), true));
		return self::$conn;
	}

	private function reconnexion() { self::$iconn ++; }
	protected function error() { return mysqli_error(self::$conn); }
	//private function error() { return $this->conn->connect_error; }
	private function initFrom($infile) {

		self::$iconn = 0;
		if ($handle = fopen($infile, 'r'))
			while ($data = fgetcsv($handle, 0, ":")) {
				$property = trim($data[0]);
				$this->$property = trim($data[1]);
			}
		else echo "error while read ".$infile;
	}

	private function connexion() {

		self::$conn = mysqli_connect($this->server,
           /* * * * * * * * * * */   $this->username,
          /* actual connexion  */    $this->password,
         /* * * * * * * * * * */     $this->database);
		return $this->error() ? $this->error() : self::$conn;
	}

	public static function getPropArray($objet) {//array of properties
		$reflectionClass = new \ReflectionClass(get_class($objet));
		$array = array();
		foreach ($reflectionClass->getProperties() as $property) {
			$property->setAccessible(true);
			$array[$property->getName()] = $property->getValue($objet);
			$property->setAccessible(false);
		}
		return $array;
	}

}

?>



