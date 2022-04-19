<?php namespace model;
/**
 *
  * @abstract safety database connexion
 * @example $database = new BaseManager(initfile);
 * // suit code user
 * ...
 * @example unset($database); // déconnexion de la base de données
 *
 * @desc initfile is the name of the file to read the identification from
 * @desc initfile is a text file with a basic line format property: value
 * @desc !!! add initfile to .gitignore to keep it secret !!!
 * @example initfile example: model/.db.example
 * @author Kaloyan KRASTEV, kaloyansen@gmail.com
 * @version 0.0.3
 */
class BaseManager {
	private static $conn;
	private static int $iconn;
	private static string $jsonFile = DOWN."/connexion.json";

	const INSEB = "('";
	const INSEP = "', '";
	const INSEF = "')";

	private $server;
	private $username;
	private $password;
	private $database;

	//protected function get() { return self::$conn; }
	protected function sql(string $query) { return mysqli_query(self::$conn, $query); }
	public function __destruct() {
		$this->close();
		error_log('destroying '.__CLASS__."\n");
	}
	public function __construct(?string $infile = null) {
		if (!$infile) $infile = MODEL.'/.db.';
		$this->initFrom($infile);
		self::$iconn = 0;
		$this->open();
	}

	private function close():void { echo "\n"; mysqli_close(self::$conn); }
	private function open() {
		$ok = $this->connexion() == $this->error() ? false : true;
		if (!$ok) $this->reconnexion();//hypotetic
		return $this->export();
	}

	private function export() {

		//file_put_contents(self::$jsonFile, print_r(json_encode(self::object2array(self::$conn)), true));
		return self::$conn;
	}

	private function reconnexion(): void { self::$iconn ++; }
	protected function error() { return mysqli_error(self::$conn); }
	//private function error() { return $this->conn->connect_error; }
	private function initFrom(string $infile): void {

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

	public static function object2array($objet) {//array of properties
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



