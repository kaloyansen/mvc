<?php namespace view;
/**
 * @desc dinamic content for the message page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.3
 */
class Message extends \view\Frontend {

	function __construct($controbjet) {

		parent::__construct($controbjet);
		self::viewMessage($controbjet->message);
	}
}