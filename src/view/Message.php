<?php namespace view;
/**
 * @desc dinamic content for the message page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.4
 */
class Message extends \view\Frontend {

	function __construct($controbjet) {

		parent::__construct($controbjet);
		echo '<article class="container">';
		self::viewMessage($controbjet->message);
		echo "</article>";
	}
}