<?php namespace model;
/**
 * @desc ticket container
 * @see class attributes in superclass TicketPublic
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.8
 */
class Ticket extends \model\TicketPublic {

    /**
     * @abstract construction à partir d'un enregistrement dans la base de données
     * @desc prenez soin de vous
     */
    public function __construct($objet = false, $id = false) {

    	//if ($id) $this->setId($id);
    	$this->consume($objet);
    }

    /**
     * creative distraction
     */
    function __destruct() {
    	error_log('folder: '.__DIR__);
    	error_log('file: '.__FILE__);
    	error_log('class: '.__CLASS__);
    	error_log(' destruction');
    }

    public function nProp(): int {

    	$proparr = \model\BaseManager::object2array($this);
    	return count($proparr);
    }

    /**
     * @abstract convert a table row to an object
     * @desc row fetchet as an object
     */
    protected function consume($obj): void {

    	if (!$obj) $obj = self::randomBody('abcdef', 6);

    	if (isset($obj->id)) $this->id = $obj->id;
    	//$this->love = $obj->love;

    	$this->title = $obj->title;
    	$this->description = $obj->description;
    	if (isset($obj->color)) $this->color = $obj->color;
    	$this->keywords = $obj->keywords;
    	$this->body = $obj->body;
    	$this->photo = $obj->photo;
    	if (isset($obj->jour)) $this->jour = $obj->jour;

    	$this->prix = intval($obj->prix);
    	$this->diff = intval($obj->diff);
    	$this->temps = $obj->temps;
    	$this->personne = $obj->personne;
    	if (isset($obj->hide)) $this->hide = $obj->hide;
    	$this->cuisinier = intval($obj->cuisinier);
    }

    public function overview(bool $all = true): string {

    	$img = IMG.'/recette.'.$this->getId().'.jpg';
    	$krava = '<div class="ticket" style="background-color: '.$this->color.';">';
        $krava = $krava.$this->getTitle();
        $krava = $krava.self::figure($img, $this->description, 'moyenne');

        if ($all) {
        	$krava = $krava.'<br />temps: '.self::second2hour($this->temps);
        	$krava = $krava.'<br />difficulté '.self::fouet($this->diff);
        	$krava = $krava.'<br />prix: '.self::euro($this->prix);
            $krava = $krava.'<br />'.$this->personne.' personnes';
            $krava = $krava.'<br />publié: '.$this->jour;
            $krava = $krava.'<br />#'.$this->id;
        }

        return $krava.'</div>';
    }

    public function __toString() {

    	$br = '<br />';
    	$img = IMG.'/recette.'.$this->getId().'.jpg';

    	$krava = '<div class="ticket" style="background-color: '.$this->color.';">';
    	$krava = $krava.self::figure($img, $this->getDescription(), 'grand');
    	$krava = $krava.$br.'temps: '.self::second2hour($this->getTemps());
    	$krava = $krava.', difficulté '.self::fouet($this->getDiff());
    	$krava = $krava.', prix: '.self::euro($this->getPrix());
    	$krava = $krava.$br.'produits pour '.$this->getPersonne().' personnes:';
    	$krava = $krava.$br.self::string2list($this->getKeywords(), ',', false);
    	$krava = $krava.$br.self::string2list($this->getBody(), '.');
    	$krava = $krava.$br.'#'.$this->getId().' publiée: '.$this->getJour();
    	return $krava.$br.'</div>';
    }

    /* deprecated
    public function validation(): bool {//hmmmm
        return isset($this->title) &&
        isset($this->body) &&
        isset($this->description) &&
        isset($this->keywords);
    }*/

    private static function randomBody($wordset = "abcdef", $wordlen = 6) {

    	//$wordlet = str_repeat($wordset, 10);
        return (object) array(
        	'id' => 123456,
            'title' => 'le titre',
        	'description' => 'une déscription',
        	'color' => \Colors\RandomColor::one(array('luminosity'=>'light')),
        	'keywords' => 'diviser les produit avec virgule',
        	'body' => 'diviser les étapes avec point',
        	'photo' => 'pathtophoto.jpg',
        	'jour' => date('d-m-y h:i:s'),
            'prix' => 2,
            'diff' => 2,
            'temps' => 3600,
            'personne' => 2,
            'hide' => 0,
        	'cuisinier' => 1,
        	'love' => 0
        );
    }

} ?>
