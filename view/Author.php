<?php namespace view;
/**
 * @desc a dinamic part of the author web page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Author extends \view\Objet {
	/**
	 */
	public function __construct($controbjet) {

		$ca = $controbjet->cuisinier_array;

		?><article class="container"><?php
		foreach (array_reverse($ca) as $chef) {
			self::viewAuthor($chef);
		}
		foreach (array_reverse($ca) as $chef) {
			self::viewAuthor($chef);
		}
		foreach (array_reverse($ca) as $chef) {
			self::viewAuthor($chef);
		}

        ?></article><?php
    }

    protected static function viewAuthor(\model\Cuisinier $cuisinier): void {
    	?><div class="jaba">
            <a class="loco" href="<?=WWW;?>?page=over&id=<?=$cuisinier->getId();?>"><?php
        echo $cuisinier;
          ?></a>
          </div><?php
    }
}

