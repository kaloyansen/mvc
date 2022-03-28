<?php namespace model;
/**
 *
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc ticket container
 *
 */

class Ticket {

    private $id;
    private $title;
    private $body;
    private $position;
    private $status;
    private $color;
    private $description;
    private $keywords;
    private int $love;

    public function __construct($objet = false, $id = false) {

        if ($id) $this->setId($id);
        if (!$objet) { $objet = self::randomBody('abcdef', 6);	}
        $this->copy_object($objet);
    }

    private function copy_object($obj) {

    	$this->body = $obj->body;
    	$this->color = $obj->color;
    	$this->title = $obj->title;
    	$this->status = $obj->status;
    	$this->keywords = $obj->keywords;
    	$this->position = $obj->position;
       	$this->description = $obj->description;
    }

    public function __toString() {

    	$krava = '<div class="ticket" style="background-color: '.$this->color.';">';
    	$krava = $krava.'<br />body: '.$this->body;
    	$krava = $krava.'<br />position: '.$this->position;
    	$krava = $krava.'<br />status: '.$this->status;
    	$krava = $krava.'<br />color: '.$this->color;
    	$krava = $krava.'<br />description: '.$this->description;
    	$krava = $krava.'<br />keywords: '.$this->keywords;
    	return $krava.'<br /><br /></div>';
    }

    public function validation() { return isset($this->title) &&
                                          isset($this->body) &&
                                          isset($this->position) &&
                                          isset($this->status) &&
                                          isset($this->description) &&
                                          isset($this->keywords) &&
                                          isset($this->color); }
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getBody() { return $this->body; }
    public function getPosition() { return $this->position; }
    public function getStatus() { return $this->status; }
    public function getColor() { return $this->color; }
    public function getDescription() { return $this->description; }
    public function getKeywords() { return $this->keywords; }
    public function getLove(): int { return $this->love; }
    public function setId($id) { if (is_int(intval($id))) $this->id = $id; }
    public function setTitle($title) { if (is_string($title)) $this->title = $title; }
    public function setBody($body) { if (is_string($body)) $this->body = $body; }
    public function setPosition($position) { if (is_string($position)) $this->position = $position; }
    public function setStatus($status) { if (is_string($status)) $this->status = $status; }
    public function setColor($color) { if (is_string($color)) $this->color = $color; }
    public function setDescription($desc) { if (is_string($desc)) $this->description = $desc; }
    public function setKeywords($keys) { if (is_string($keys)) $this->keywords = $keys; }
    public function setLove(int $love): void { if (is_int($love)) $this->love = $love; }

    public function loadpost() {

        $postobjet = (object) $_POST;
        $this->copy_object($postobjet);
    }

    private static function randomBody($wordset = "abcdef", $wordlen = 6) {

    	$wordlet = str_repeat($wordset, 10);
        return (object) array(
            'body' => 'autogénéré par une méthode de la classe d\'entité',
            //'color' => substr(str_shuffle($wordlet), 0, $wordlen),
            'color' => \Colors\RandomColor::one(array('luminosity'=>'light')),
            'title' => substr(str_shuffle($wordlet), 0, $wordlen),
            'status' => substr(str_shuffle($wordlet), 0, $wordlen),
            'position' => substr(str_shuffle($wordlet), 0, $wordlen),
            'keywords' => substr(str_shuffle($wordlet), 0, $wordlen),
            'description' => substr(str_shuffle($wordlet), 0, $wordlen)
        );
    }

}

?>
