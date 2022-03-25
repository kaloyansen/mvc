<?php namespace model\site;

/********************************/
/* code php by Kaloyan KRASTEV */
/* kaloyansen@gmail.com       */
/*****************************/
class TicketManager extends \model\DBManager {/* database
                                                 interface */
    private const TABLE = 'ticket';//le nom du tableau dans la base de donnée
	private const SELECT = "SELECT * FROM ticket";
	//public function getTable() { return self::TABLE; }
    public function count() {

        $query = self::SELECT;
        $result = mysqli_query($this->get(), $query);
        if (!$result) return $this->error();
        return mysqli_num_rows($result);
    }

    public function last() {

    	$query = "SELECT MAX(id) FROM ".self::TABLE;
        $result = mysqli_query($this->get(), $query);
        if (!$result) return $this->error();
        return mysqli_fetch_array($result)[0];
    }

    public function selectAll() {

    	$query = self::SELECT;
    	$result = mysqli_query($this->get(), $query);
    	if (!$result) return $this->error();
    	$ticket_array = array();
    	while ($mfobj = $result->fetch_object()) {
    		$ticket_array[] = new \model\site\Ticket($mfobj, $mfobj->id);
    	}
        return empty($ticket_array) ? false : $ticket_array;
    }

    public function select($id = false) {
    	if (!$id) return $this->selectAll();
    	$query = self::SELECT;
    	$query = $query." WHERE id=".$id;
    	$result = mysqli_query($this->get(), $query);
    	if (!$result) return $this->error();
    	$mfobj = mysqli_fetch_object($result);
        return new \model\site\Ticket($mfobj, $id);
    }

    public function insert(\model\site\Ticket $ticket) {

    	$query = "INSERT INTO ".self::TABLE;
        $query = $query."(title, body, position, status, color, description, keywords)";
        $query = $query." VALUES('".$ticket->getTitle();
        $query = $query."', '".$ticket->getBody();
        $query = $query."', '".$ticket->getPosition();
        $query = $query."', '".$ticket->getStatus();
        $query = $query."', '".$ticket->getColor();
        $query = $query."', '".$ticket->getDescription();
        $query = $query."', '".$ticket->getKeywords()."')";
        $result = mysqli_query($this->get(), $query);
        if (!$result) return $this->error();
        return $result;
    }

    public function update($id, \model\site\Ticket $ticket) {

    	$query = "UPDATE ".self::TABLE." SET title='".$ticket->getTitle();
        $query = $query."', body='".$ticket->getBody();
        $query = $query."', position='".$ticket->getPosition();
        $query = $query."', status='".$ticket->getStatus();
        $query = $query."', description='".$ticket->getDescription();
        $query = $query."', keywords='".$ticket->getKeywords();
        $query = $query."' WHERE id=".$id;
        $result = mysqli_query($this->get(), $query);
        if (!$result) return $this->error();
        return $result;
    }

    public function delete($id) {

    	$query = "DELETE FROM ".self::TABLE." WHERE id=".$id;
        $result = mysqli_query($this->get(), $query);
        if (!$result) return $this->error();
        return $result;
    }

}
?>
