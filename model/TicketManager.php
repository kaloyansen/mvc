<?php namespace model;
/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc ticket database interface
 * @version 0.0.2
 */
class TicketManager extends \model\BaseManager {

	private const TABLE = 'ticket';//le nom du tableau dans la base de donnée
	private const SELECT = "SELECT * FROM ticket";
	private const WHERE = " WHERE id=";

    public function count() {

        $query = self::SELECT;
        $result = $this->query($query);
        if (!$result) return $this->error();
        return mysqli_num_rows($result);
    }

    public function last() {

    	$query = "SELECT MAX(id) FROM ".self::TABLE;
        $result = $this->sql($query);
        if (!$result) return $this->error();
        return mysqli_fetch_array($result)[0];
    }

    public function rate(int $id) {

        $query = "SELECT rate FROM ".self::TABLE;
        $query = $query.self::WHERE.$id;
        $result = $this->sql($query);
        if (!$result) return $this->error();

        $rate = mysqli_fetch_array($result)[0] + 1;

        $query = "UPDATE ".self::TABLE." SET rate=".$rate;
        $query = $query.self::WHERE.$id;
        $result = $this->sql($query);
        if (!$result) return $this->error();
        return $result;
    }

    public function selectAll() {

    	$query = self::SELECT;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	$ticket_array = array();
    	while ($mfobj = $result->fetch_object()) {
    		$ticket_array[] = new \model\Ticket($mfobj, $mfobj->id);
    	}
        return empty($ticket_array) ? false : $ticket_array;
    }

    public function select($id = false) {

    	if (!$id) return $this->selectAll();
    	$query = self::SELECT;
    	$query = $query.self::WHERE.$id;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	$mfobj = mysqli_fetch_object($result);
        return new \model\Ticket($mfobj, $id);
    }

    public function insert(\model\Ticket $ticket) {

    	$query = "INSERT INTO ".self::TABLE;
        $query = $query."(title, body, position, status, color, description, keywords)";
        $query = $query." VALUES('".$ticket->getTitle();
        $query = $query."', '".$ticket->getBody();
        $query = $query."', '".$ticket->getPosition();
        $query = $query."', '".$ticket->getStatus();
        $query = $query."', '".$ticket->getColor();
        $query = $query."', '".$ticket->getDescription();
        $query = $query."', '".$ticket->getKeywords()."')";
        $result = $this->sql($query);
        if (!$result) return $this->error();
        return $result;
    }

    public function update($id, \model\Ticket $ticket) {

    	$query = "UPDATE ".self::TABLE." SET title='".$ticket->getTitle();
        $query = $query."', body='".$ticket->getBody();
        $query = $query."', position='".$ticket->getPosition();
        $query = $query."', status='".$ticket->getStatus();
        $query = $query."', description='".$ticket->getDescription();
        $query = $query."', keywords='".$ticket->getKeywords();
        $query = $query."'".self::WHERE.$id;
        $result = $this->sql($query);
        if (!$result) return $this->error();
        return $result;
    }

    public function delete($id) {

    	$query = "DELETE FROM ".self::TABLE.self::WHERE.$id;
        $result = $this->sql($query);
        if (!$result) return $this->error();
        return $result;
    }

}
?>
