<?php namespace classe;
/**
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @abstract creates an instance of a controller class and calls the method if allowed
 * @version 0.0.3
 */
class Rooter {

    private string $chemin;
    private string $method;
    private string $argument;

    public function __construct(string $chemin, string $method, string $argument = 0) {

    	$this->chemin = $chemin;
        $this->method = $method;
        $this->argument = $argument;
    }

    public function control() {

        $che = $this->chemin;
        $met = $this->method;
        $arg = $this->argument;

        if (method_exists($che, $met)) {

        	$objet = new $che($arg);
            $resultat = false;
            if ($objet->jePeuxEntrer()) $resultat = $objet->$met();
            if ($resultat) error_log($resultat.' from method '.$met.' in '.__FILE__);
    	} else {
    	    echo 'error 404 cannot find method '.$met.' in class '.$che;
    	}
    }
} ?>