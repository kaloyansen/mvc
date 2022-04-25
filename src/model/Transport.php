<?php namespace model;
/**
 * @desc object container
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Transport {

    public function loadPost() {

        $postobjet = (object) $_POST;
        $this->consume($postobjet);
    }

	protected static function figure(string $fichier = 'path/to/file.ext', string $caption = 'text_to_display', string $taille = 'petit'): string {

		return '<figure>
          <img src="'.$fichier.'"
               alt="'.$fichier.' not found"
               class="'.$taille.'"
               alt="missing" />
          <figcaption>'.$caption.'</figcaption>
        </figure>';

	}

	protected static function euro(int $eu): string {

		$code = false;
		while (0 < $eu --) $code = $code.'€';//<span class="">€</span>';

		return $code;
		//return '<span class="roco fa">'.$code.'</span>';
	}

	protected static function fouet(int $fou): string {

		$code = false;
		while (0 < $fou --) $code = $code.'<img class="img-fluid" src="'.IMG.'/fouet.png" alt="difficulté" />';

		return $code;
	}

	protected static function second2hour(int $seconds): string {

		$minutes = $seconds / 60;
		$hour_float = $minutes / 60;
		$hour = intval($hour_float);
		$minute = ($hour_float - $hour) * 60;

		$code = false;
		if ($hour > 0) $code = $hour.'h ';
		if ($minute > 0) $code = $code.$minute.'min';

		return $code;
	}

	protected static function string2list(string $input, string $delimiter = ',', bool $numbered = true): string {

		$sep_tag = explode($delimiter, $input);
		//$sep_tag = preg_split("/\".","."/", $input);
		$output = '<ul>';
		if ($numbered) $output = '<ol>';

		foreach ($sep_tag as $tag) $output = $output.'<li class="collection-item">'.$tag.'</li>';

		if ($numbered) return $output.'</ol>';
		return $output.'</ul>';
	}

}

