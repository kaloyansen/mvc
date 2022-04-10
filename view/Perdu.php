<?php namespace view;
/**
 * @desc dinamic content for the default page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.2
 */
class Perdu {

	function __construct($controbjet) { self::send($controbjet->message); }
	private static function send($message): void {
        ?><article class="ticket">
            <h3>there is a message for you</h3>
            <h2><?=$message;?></h2>

            <p>the page you are looking for is currently unavailable<br/>try again later</p>
            <p>the system administrator of this resource should check the error log for details</p>
            <p><em>faithfully yours, Kalo</em></p>
          </article><?php
	}
}