<?php

class Phaker_Generator_NameTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var  object
	 */
	protected $generate;

	public function setUp()
	{
		$this->generate = Phaker::factory('name');
	}

	public function test_name()
	{
		$this->assertRegExp('/(\w+\.? ?){2,3}/', $this->generate->name);
	}

	public function test_prefix()
	{
		$this->assertRegExp('/[A-Z][a-z]+\.?/', $this->generate->prefix);
	}

	public function test_suffix()
	{
		$this->assertRegExp('/[A-Z][a-z]*\.?/', $this->generate->suffix);
	}

} // End NameTest