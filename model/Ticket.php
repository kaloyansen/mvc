<?php namespace model;
/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc ticket container
 * @version 0.0.2
 */
class Ticket {

    private $id;

    private $title;
    private $description;
    private $color;
    private $keywords;
    private $body;
    private $jour;//datetime

    private int $prix;
    private int $diff;
    private int $temps;
    private int $personne;
    private int $hide;
    private int $love;//l'amour n'est pas à la base de données

    public function __construct($objet = false, $id = false) {

        if ($id) $this->setId($id);
        if (!$objet) $objet = self::randomBody('abcdef', 6);
        $this->copy_object($objet);
    }

    private function copy_object($obj) {

    	$this->title = $obj->title;
    	$this->description = $obj->description;
    	$this->color = $obj->color;
    	$this->keywords = $obj->keywords;
    	$this->body = $obj->body;
    	$this->jour = $obj->jour;

    	$this->prix = $obj->prix;
    	$this->diff = $obj->diff;
    	$this->temps = $obj->temps;
    	$this->personne = $obj->personne;
    	$this->hide = $obj->hide;
    }

    public function overview(bool $all = false): string {

        $krava = '<div class="ticket" style="background-color: '.$this->color.';">';
        $krava = $krava.$this->title;
        $krava = $krava.'('.$this->description.') ';

        if ($all) {
            $krava = $krava.'temps: '.$this->temps.' secondes, ';
            $krava = $krava.'prix: '.$this->prix.'€, ';
            $krava = $krava.'pour '.$this->personne.' personnes, ';
            $krava = $krava.'publié: '.$this->jour;
        }

        return $krava.'</div>';
    }

    public function __toString(): string {

    	$krava = '<div class="ticket" style="background-color: '.$this->color.';">';
    	$krava = $krava.'<br />description: '.$this->description;
    	$krava = $krava.'<br />produits: '.$this->keywords;
    	$krava = $krava.'<br />action: '.$this->body;
    	$krava = $krava.'<br />temps: '.$this->temps;
    	$krava = $krava.'<br />prix: '.$this->prix.'€';
    	$krava = $krava.'<br />pour '.$this->personne.' personnes';
    	$krava = $krava.'<br />depui: '.$this->jour;
    	return $krava.'<br /><br /></div>';
    }

    public function validation(): bool {//hmmmm
        return isset($this->title) &&
        isset($this->body) &&
        isset($this->description) &&
        isset($this->keywords);
    }

    public function setId($id) { if (is_int(intval($id))) $this->id = $id; }
    public function setTitle($title) { if (is_string($title)) $this->title = $title; }
    public function setDescription($desc) { if (is_string($desc)) $this->description = $desc; }
    public function setColor($color) { if (is_string($color)) $this->color = $color; }
    public function setKeywords($kw) { if (is_string($kw)) $this->keywords = $kw; }
    public function setBody($body) { if (is_string($body)) $this->body = $body; }
    public function setJour($jour) { if (is_string($jour)) $this->jour = $jour; }
    public function setPrix(int $prix): void { $this->prix = $prix; }
    public function setDiff(int $diff): void { $this->diff = $diff; }
    public function setTemps(int $temps): void { $this->temps = $temps; }
    public function setPersonne(int $per): void { $this->personne = $per; }
    public function setHide(int $hide): void { $this->hide = $hide; }
    public function setLove(int $love): void { $this->love = $love; }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getColor() { return $this->color; }
    public function getKeywords() { return $this->keywords; }
    public function getBody() { return $this->body; }
    public function getJour() { return $this->jour; }
    public function getPrix(): int { return $this->prix; }
    public function getDiff(): int { return $this->diff; }
    public function getTemps(): int { return $this->temps; }
    public function getPersonne(): int { return $this->personne; }
    public function getHide(): int { return $this->hide; }
    public function getLove(): int { return $this->love; }

    public function loadPost() {

        $postobjet = (object) $_POST;
        $this->copy_object($postobjet);
    }

    private static function randomBody($wordset = "abcdef", $wordlen = 6) {

    	$wordlet = str_repeat($wordset, 10);
        return (object) array(
            'title' => 'un ticket généré automatiquement',
        	'description' => 'la méthode s\'appelle randomBody',
        	'color' => \Colors\RandomColor::one(array('luminosity'=>'light')),
        	'keywords' => substr(str_shuffle($wordlet), 0, $wordlen),
        	'body' => 'ce ticket est autogénéré par la méthode randomBody de la classe d\'entité '.__CLASS__,
            'jour' => date('d-m-y h:i:s'),
            'prix' => 1,
            'diff' => 1,
            'temps' => 1000,
            'personne' => 2,
            'hide' => 0
        );
    }

} ?>
