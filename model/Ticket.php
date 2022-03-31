<?php namespace model;

/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @desc ticket container
 * @version 0.0.3
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

    protected function consume($obj): void {

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

    private static function euro(int $eu): string {

    	$code = false;
    	while (0 < $eu --) $code = $code.'€';

    	return $code;
    }

    private static function fouet(int $fou): string {

    	$code = false;
    	while (0 < $fou --) $code = $code.'<img src="'.IMG.'/fouet.png" alt="difficulté" />';

    	return $code;
    }

    private static function second2hour(int $seconds): string {

        $minutes = $seconds / 60;
        $hour_float = $minutes / 60;
        $hour = intval($hour_float);
        $minute = ($hour_float - $hour) * 60;

        $code = false;
        if ($hour > 0) $code = $hour.'h ';
        if ($minute > 0) $code = $code.$minute.'min';

        return $code;
    }

    private static function string2list(string $input, string $delimiter = ',', bool $numbered = true): string {

    	$sep_tag = explode($delimiter, $input);
    	//$sep_tag = preg_split("/\".","."/", $input);
    	$output = '<ul>';
    	if ($numbered) $output = '<ol>';

    	foreach ($sep_tag as $tag) $output = $output.'<li class="collection-item">'.$tag.'</li>';

    	if ($numbered) return $output.'</ol>';
    	return $output.'</ul>';
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

    	$br = '<br />';
    	$krava = '<div class="ticket" style="background-color: '.$this->color.';">';
    	$krava = $krava.$br.$this->description;
    	$krava = $krava.$br.'temps: '.self::second2hour($this->temps);
    	$krava = $krava.', difficulté '.self::fouet($this->diff);
    	$krava = $krava.', prix: '.self::euro($this->prix);
    	$krava = $krava.$br.'produits pour '.$this->personne.' personnes:';
    	$krava = $krava.$br.self::string2list($this->keywords);
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
