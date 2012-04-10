<?php

class NameTest extends PHPUnit_Framework_TestCase {

	public function test_name()
	{
		$this->assertRegExp('/(\w+\.? ?){2,3}/', Phaker::factory('name')->name);
	}

	public function test_prefix()
	{

	}

	public function test_suffix()
	{

	}

} // End NameTest