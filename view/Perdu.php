<?php namespace view;
/**
 * @desc dinamic content for the default page
 * @abstract dinamic frontend
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class Perdu {

	function __construct($controbjet) { ?>
<article>

  <h2><?=$controbjet->message;?></h2>

  <h3>an error occurred</h3>
  <p>the page you are looking for is currently unavailable<br/>try again later</p>
  <p>the system administrator of this resource should check the error log for details</p>
  <p><em>faithfully yours, Kalo</em></p>
</article><?php
	}
}