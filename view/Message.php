<?php namespace view;
/**
 * @desc dinamic content for the message page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Message {

	function __construct($controbjet) { self::draw($controbjet->message); }
	private static function draw($message): void {
        ?><article class="ticket">

            <h2><?=$message;?></h2>

          </article><?php
	}
}