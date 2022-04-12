<?php namespace test;
/**
 * @desc Ticket teste unitaire
 * @abstract test Ticket
 * @author Kaloyan KRASTEV
 * @link kaloyansen@gmail.com
 * @version 0.0.1
 */
class TicketTest extends \PHPUnit\Framework\TestCase {
    /**
      * @dataProvider inputForTest
      */
	public function testnProp($expected) {

		$ticket = new \model\Ticket();
		$this->assertSame($expected, $ticket->nProp());
	}

	public function inputForTest() { return [[11], [12], [13], [14], [15], [16], [17], [18], [19], [20]]; }
	//public function inputForTest() { return [[0, 0], [20, 2], [100, 100]]; }
}