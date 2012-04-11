<?php

use Phaker\Base as Phaker;

class PhakerTest extends PHPUnit_Framework_TestCase {

	public function provider_class_names()
	{
		return array(
			array('Phaker\\Generator\\Address', 'address'),
			array('Phaker\\Generator\\Phone_Number', 'phone_number'),
		);
	}

	/**
	 * @dataProvider  provider_class_names
	 */
	public function test_class_name_for_generator($expected, $generator)
	{
		$this->assertEquals($expected, Phaker::class_name_for_generator($generator));
	}

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