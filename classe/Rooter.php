<?php namespace classe;
/**
 * creates a new instance of the controller class
 * and call the method with the argument all of them specified as arguments
 */
class Rooter {
	private $space;
    private $method;

    public function __construct($space, $method, $clargument = false) {
    	$this->space = $space;
    	$this->method = $method;
    	$this->clargument = $clargument;
    }

    public function control() {

        $sp = $this->space;
        $met = $this->method;
        $clarg = $this->clargument;

        if (method_exists($sp, $met)) {/*
        */
        	$objet = new $sp($clarg);
            $resultat = false;
            if ($objet->jePeuxEntrer()) { $resultat = $objet->$met(); }
            if ($resultat) error_log($resultat.' from method '.$met.' in '.__FILE__);
    	} else {
    	    echo 'error 404 no '.$met.' in '.$sp;
    	}
    }
} ?>