<?php

class PhakerTest extends PHPUnit_Framework_TestCase {

	public function test_numerify()
	{
		for ($i=0; $i < 100; $i++) {
			$this->assertRegExp('/^[1-9]\d{2}$/D', Phaker::numerify('###'));
		}
	}

	public function test_letterify()
	{
		$this->assertRegExp('/^[A-Z]{3}$/D', Phaker::letterify('???'));
	}

	public function test_bothify()
	{
		$this->assertRegExp('/^[A-Z]{2}[1-9][A-Z]$/D', Phaker::bothify('??#?'));
	}

} // End PhakerTest