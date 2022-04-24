<?php namespace model;
/**
 * @desc ticket database interface
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.6
 */
class TicketManager extends \model\BaseManager {

	private const TABLE = 'ticket';//le nom du tableau dans la base de donnée
	private const SELECT = "SELECT * FROM ticket";
	private const WHERE = " WHERE id=";

    public function count(): int {

        $query = self::SELECT;
        $result = self::sql($query);
        if (!$result) return $this->error();
        return mysqli_num_rows($result);
    }

    public function authorId(\model\Ticket $ticket): int {

    	$query = "SELECT cuisinier FROM ticket WHERE id=".$ticket->getId();
    	return self::sqlint($query);
    }

    public function maxid(): int {

    	$query = "SELECT MAX(id) FROM ".self::TABLE.' WHERE hide=0';
    	return self::sqlint($query);
    }

    public function authoRate(int $cid): int {

    	$ticket_array = $this->selectByAuthor($cid, 1e8);
    	$rate = 0;
    	foreach ($ticket_array as $ticket) $rate += $this->rate($ticket->getId());
    	return $rate;
    }

    public function selectByAuthor(int $cid, int $maxtick = 1000) {

        $query = self::SELECT;
        $query = $query.' WHERE cuisinier='.$cid;
        $result = self::sql($query);
        if (!$result) return $this->error();

        $ticket_array = array();
        while ($mfobj = $result->fetch_object()) {
            if (0 < $maxtick --) {

            	$id = $mfobj->id;
            	$ticket = new \model\Ticket($mfobj, $id);
            	$ticket->setLove($this->sheLovesMe($id));
            	$ticket_array[] = $ticket;
            }
        }

        return empty($ticket_array) ? false : $ticket_array;
    }

    public function selectAll(int $maxtick = 1000) {

    	$query = self::SELECT;
    	$result = self::sql($query);
    	if (!$result) return $this->error();

    	$ticket_array = array();
    	while ($mfobj = $result->fetch_object()) {
    		if (0 < $maxtick --) {

    			$id = $mfobj->id;
    			$ticket = new \model\Ticket($mfobj, $id);
    			$ticket->setLove($this->sheLovesMe($id));
    			$ticket_array[] = $ticket;
    		}
    	}

    	return empty($ticket_array) ? false : $ticket_array;
    }

    public function select(int $id = 0): \model\Ticket {

    	if (!$id) return $this->selectAll();
    	$query = self::SELECT;
    	$query = $query.self::WHERE.$id;

        $mfobj = self::sqloo($query);
    	/*
    	$result = self::sql($query);
    	if (!$result) return $this->error();
    	$mfobj = mysqli_fetch_object($result);
        */
    	$ticket = new \model\Ticket($mfobj, $id);
    	$ticket->setLove($this->sheLovesMe($id));
    	return $ticket;
    }

    public function insert(\model\Ticket $ticket) {

    	$query = "INSERT INTO ".self::TABLE;
    	$query = $query."(title, description, body, keywords, prix, diff, temps, color, personne)";
    	$query = $query." VALUES";
    	$query = $query.self::INSEB;
    	$query = $query.addslashes($ticket->getTitle()).self::INSEP;
    	$query = $query.addslashes($ticket->getDescription()).self::INSEP;
    	$query = $query.addslashes($ticket->getBody()).self::INSEP;
    	$query = $query.addslashes($ticket->getKeywords()).self::INSEP;
    	$query = $query.$ticket->getPrix().self::INSEP;
    	$query = $query.$ticket->getDiff().self::INSEP;
    	$query = $query.$ticket->getTemps().self::INSEP;
    	$query = $query.$ticket->getColor().self::INSEP;
    	$query = $query.$ticket->getPersonne().self::INSEF;
    	$result = self::sql($query);

    	return $result ? $result : $this->error();
    }

    public function update(int $id, \model\Ticket $ticket) {

    	$query = "UPDATE ".self::TABLE." SET title='".addslashes($ticket->getTitle());
    	$query = $query."', description='".addslashes($ticket->getDescription());
    	$query = $query."', body='".addslashes($ticket->getBody());
    	$query = $query."', keywords='".addslashes($ticket->getKeywords());
    	$query = $query."', prix='".$ticket->getPrix();
    	$query = $query."', diff='".$ticket->getDiff();
    	$query = $query."', temps='".$ticket->getTemps();
    	$query = $query."', personne='".$ticket->getPersonne();
    	$query = $query."'".self::WHERE.$id;
    	$result = self::sql($query);

    	return $result ? $result : $this->error();
    }

    public function hide(int $id): string {

    	$query = 'SELECT hide from ticket';
    	$query = $query.self::WHERE.$id;
        /*
    	$result = self::sql($query);
    	$yes = mysqli_fetch_array($result)[0];
        */
    	$yes = self::sqlint($query);

    	if (intval($yes) > 0) {//show
    		$query = "UPDATE ".self::TABLE." SET hide=0";
    		$query = $query.self::WHERE.$id;
    		$message = 'show #'.$id;
    	} else {//hide
    		$query = "UPDATE ".self::TABLE." SET hide=1";
    		$query = $query.self::WHERE.$id;
    		$message = 'hide #'.$id;
    	}

    	return self::sql($query) ? $message : $this->error();
    }

    public function delete($id) {

    	$query = "DELETE FROM ".self::TABLE.self::WHERE.$id;
    	$result = self::sql($query);
    	return $result ? $result : $this->error();
    }

    /**
     * @desc table cuisinier
     */
    public function authorName(\model\Ticket $ticket): string {

    	$cuisinier = $this->authorId($ticket);
    	$query = "SELECT nom FROM cuisinier WHERE cid=".$cuisinier;
        /*
    	$result = self::sql($query);

    	return mysqli_fetch_array($result)[0];
        */
    	return self::sqlstring($query);
    }

    public function maxcid(): int {

    	$query = "SELECT MAX(cid) FROM cuisinier";
    	return self::sqlint($query);
    }

    public function selectAuthorNoms(int $maxtick = 1000): array {

    	$authors = $this->selectAuthors($maxtick);
    	$names = array();
    	foreach (array_reverse($authors) as $chef) {
    		$names[] = $chef->getNom();
    	}
    	return $names;
    }

    public function selectAuthors(int $maxtick = 1000) {

    	$query = 'SELECT * FROM cuisinier';
    	$result = self::sql($query);
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
    	/*
    	$result = self::sql($query);
    	if (!$result) return $this->error();
    	$mfobj = mysqli_fetch_object($result);*/
    	$mfobj = self::sqloo($query);
    	return new \model\Cuisinier($mfobj);
    }

    public function deleteAuthor($id) {

    	$query = "DELETE FROM cuisinier WHERE cid=".$id;
    	$result = self::sql($query);
    	return $result ? $result : $this->error();
    }

    public function insertAuthor(\model\Cuisinier $cuisinier) {

    	$query = "INSERT INTO cuisinier";
    	$query = $query."(nom, prenom, photo)";
    	$query = $query." VALUES";
    	$query = $query.self::INSEB;
    	$query = $query.$cuisinier->getNom().self::INSEP;
    	$query = $query.$cuisinier->getPrenom().self::INSEP;
    	$query = $query.$cuisinier->getPhoto().self::INSEF;

    	$result = self::sql($query);
    	return $result ? $result : $this->error();
    }

    /**
     * @desc table remote
     */
    public function sheLovesMe(int $id): int {

        $query = "SELECT rid FROM remote";
        $query = $query." WHERE ticket=".$id;
        $query = $query." AND ip='".REMOTE."'";
        return self::sqlint($query);
        /*
        $result = self::sql($query);
        $myobj = mysqli_fetch_object($result);

        return $myobj ? intval($myobj->rid) : 0;
        */
    }

    public function loveMeDo(int $id): string {

        $yes = $this->sheLovesMe($id);
        if ($yes > 0) {
    	    $query = "DELETE FROM remote WHERE rid=".$yes;
    	    $message = 'vous n\'aimez plus #'.$id;
        } else {
    	    $query = "INSERT INTO remote (ticket, ip) VALUES ('".$id."', '".REMOTE."')";
    	    $message = 'vous aimez #'.$id;
        }

        return self::sql($query) ? $message : $this->error();
    }

    public function rate(int $id): int {

        $query = "SELECT COUNT(*) FROM remote WHERE ticket=".$id;
        return self::sqlint($query);
/*
        $result = self::sql($query);

        if (!$result) return 0;
        return mysqli_num_rows($result);

        while ($result->fetch_object()) $rate++;
        return $rate; */
    }

}
?>
