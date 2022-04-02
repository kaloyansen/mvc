<?php namespace model;
/**
 * @desc ticket container
 * @see class attributes in superclass TicketPublic
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.5
 */
class Ticket extends \model\TicketPublic {

    /**
     * @abstract construction à partir d'un enregistrement dans la base de données
     * @desc prenez soin de vous
     */
    public function __construct($objet = false, $id = false) {

    	if ($id) $this->setId($id);
    	if (!$objet) $objet = self::randomBody('abcdef', 6);
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

    private function consume($obj): void {

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


    public function overview(bool $all = true): string {

    	$img = IMG.'/recette.'.$this->getId().'.jpg';
    	$krava = '<div class="ticket" style="background-color: '.$this->color.';">';
        $krava = $krava.$this->title;
        //$krava = $krava.self::photo($this->getId());
        $krava = $krava.self::figure($img, $this->description, 'moyenne');
        //$krava = $krava.$this->description;

        if ($all) {
        	$krava = $krava.'<br />temps: '.self::second2hour($this->temps);
        	$krava = $krava.', difficulté '.self::fouet($this->diff);
        	$krava = $krava.'<br />prix: '.self::euro($this->prix);
            $krava = $krava.' '.$this->personne.' personnes';
            //$krava = $krava.'publié: '.$this->jour;
        }

        return $krava.'</div>';
    }

    /** @see /media/css/style.css for datails
     * @deprecated */
    protected static function photo($id, $taille = 'moyenne'): string {

    	$img = IMG.'/recette.'.$id.'.jpg';
    	return '<img class="'.$taille.'" src="'.$img.'" alt="'.$img.'" />';
    }

    public function __toString(): string {

    	$br = '<br />';
    	$img = IMG.'/recette.'.$this->getId().'.jpg';

    	$krava = '<div class="ticket" style="background-color: '.$this->color.';">';
    	$krava = $krava.self::figure($img, $this->description, 'grand');
    	//0$krava = $krava.$br.$this->description;
    	$krava = $krava.$br.'temps: '.self::second2hour($this->temps);
    	$krava = $krava.', difficulté '.self::fouet($this->diff);
    	$krava = $krava.', prix: '.self::euro($this->prix);
    	$krava = $krava.$br.'produits pour '.$this->personne.' personnes:';
    	$krava = $krava.$br.self::string2list($this->keywords);

    	//$krava = $krava.self::photo($this->getId(), 'grand');
    	$krava = $krava.$br.self::string2list($this->body, '.', false);
    	$krava = $krava.$br.'publiée: '.$this->jour;
    	return $krava.$br.'</div>';
    }

    public function validation(): bool {//hmmmm
        return isset($this->title) &&
        isset($this->body) &&
        isset($this->description) &&
        isset($this->keywords);
    }

    public function loadPost() {

        $postobjet = (object) $_POST;
        $this->consume($postobjet);
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
