<?php namespace model;
/**
 * @desc ticket database interface
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.4
 */
class TicketManager extends \model\BaseManager {

	private const TABLE = 'ticket';//le nom du tableau dans la base de donnée
	private const SELECT = "SELECT * FROM ticket";
	private const WHERE = " WHERE id=";

    public function count() {

        $query = self::SELECT;
        $result = $this->sql($query);
        if (!$result) return $this->error();
        return mysqli_num_rows($result);
    }

    public function authorId(\model\Ticket $ticket) {

    	$query = "SELECT cuisinier FROM ticket WHERE id=".$ticket->getId();
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	return mysqli_fetch_array($result)[0];
    }

    public function authorName(\model\Ticket $ticket) {

    	$cuisinier = $this->authorId($ticket);
    	$query = "SELECT nom FROM cuisinier WHERE cid=".$cuisinier;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	return mysqli_fetch_array($result)[0];
    }

    public function last() {

    	$query = "SELECT MAX(id) FROM ".self::TABLE;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	return mysqli_fetch_array($result)[0];
    }

    public function lastAuthor() {

    	$query = "SELECT MAX(cid) FROM cuisinier";
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	return mysqli_fetch_array($result)[0];
    }

    public function sheLovesMe(int $id): int {

        $query = "SELECT rid FROM remote";
        $query = $query." WHERE ticket=".$id;
        $query = $query." AND ip='".REMOTE."'";

        $result = $this->sql($query);
        $myobj = mysqli_fetch_object($result);
        $bof = $myobj ? intval($myobj->rid) : 0;
        error_log('sheLovesMe('.$bof.')');
        return $bof;
    }

    public function loveMeDo(int $id) {

        $yes = $this->sheLovesMe($id);
        if ($yes > 0) {
    	    $query = "DELETE FROM remote WHERE rid=".$yes;
    	    $message = 'vous n\'aimez plus #'.$id;
        } else {
    	    $query = "INSERT INTO remote (ticket, ip) VALUES ('".$id."', '".REMOTE."')";
    	    $message = 'vous aimez #'.$id;
        }

        $resultat = $this->sql($query);
        return $resultat ? $message : $this->error();
    }

    public function rate(int $id): int {

        $query = "SELECT * FROM remote WHERE ticket=".$id;
        $result = $this->sql($query);
        $rate = 0;
        if (!$result) return $rate;

        while ($result->fetch_object()) $rate++;
        return $rate;
    }

    public function selectSameAuthor(int $cid, int $maxtick = 1000) {

        $query = self::SELECT;
        $query = $query.' WHERE cuisinier='.$cid;
        $result = $this->sql($query);
        if (!$result) return $this->error();
        $ticket_array = array();
        while ($mfobj = $result->fetch_object()) {
        	if (0 < $maxtick --) $ticket_array[] = new \model\Ticket($mfobj, $mfobj->id);
        }
        return empty($ticket_array) ? false : $ticket_array;
    }

    public function selectAll(int $maxtick = 1000) {

    	$query = self::SELECT;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	$ticket_array = array();
    	while ($mfobj = $result->fetch_object()) {
    		if (0 < $maxtick --) $ticket_array[] = new \model\Ticket($mfobj, $mfobj->id);
    	}
        return empty($ticket_array) ? false : $ticket_array;
    }

    public function select(int $id = 0) {

    	if (!$id) return $this->selectAll();
    	$query = self::SELECT;
    	$query = $query.self::WHERE.$id;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	$mfobj = mysqli_fetch_object($result);
        return new \model\Ticket($mfobj, $id);
    }

    public function selectAuthors(int $maxtick = 1000) {

    	$query = 'SELECT * FROM cuisinier';
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	$carray = array();
    	while ($mfobj = $result->fetch_object()) {
    		if (0 < $maxtick --) $carray[] = new \model\Cuisinier($mfobj);
    	}
    	return empty($carray) ? false : $carray;
    }

    public function selectAuthor(int $id = 0) {

    	if (!$id) { return $this->selectAuthors(); }
        $query = "SELECT * FROM cuisinier WHERE cid=".$id;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	$mfobj = mysqli_fetch_object($result);
    	return new \model\Cuisinier($mfobj);
    }

    public function insert(\model\Ticket $ticket) {

    	$query = "INSERT INTO ".self::TABLE;
    	$query = $query."(title, body, position, status, color, description, keywords)";
    	$query = $query." VALUES";
    	$query = $query.self::INSEB;
    	$query = $query.$ticket->getTitle().self::INSEP;
    	$query = $query.$ticket->getBody().self::INSEP;
    	$query = $query.$ticket->getPosition().self::INSEP;
    	$query = $query.$ticket->getStatus().self::INSEP;
    	$query = $query.$ticket->getColor().self::INSEP;
    	$query = $query.$ticket->getDescription().self::INSEP;
    	$query = $query.$ticket->getKeywords().self::INSEF;
    	$result = $this->sql($query);
    	if (!$result) return $this->error();
    	return $result;
    }

    public function insertAuthor(\model\Cuisinier $cuisinier) {

    	$query = "INSERT INTO cuisinier";
    	$query = $query."(nom, prenom, photo)";
    	$query = $query." VALUES";
    	$query = $query.self::INSEB;
    	$query = $query.$cuisinier->getNom().self::INSEP;
    	$query = $query.$cuisinier->getPrenom().self::INSEP;
    	$query = $query.$cuisinier->getPhoto().self::INSEF;

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

    public function deleteAuthor($id) {

        $query = "DELETE FROM cuisinier WHERE cid=".$id;
        $result = $this->sql($query);
        if (!$result) return $this->error();
        return $result;
    }

}
?>
