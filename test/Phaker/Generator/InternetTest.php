<?php

class Phaker_Generator_Internet extends PHPUnit_Framework_TestCase {

	/**
	 * @var  object
	 */
	protected $generate;

	public function setUp()
	{
		$this->generate = Phaker::factory('internet');
	}

	public function test_email()
	{
		$this->assertRegExp('/^.+@.+\.\w+$/D', $this->generate->email);
	}

	public function test_free_email()
	{
		$this->assertRegExp('/^.+@(gmail|hotmail|yahoo)\.com$/D', $this->generate->free_email);
	}

	public function test_safe_email()
	{
		$this->assertRegExp('/^.+@example.(com|net|org)$/D', $this->generate->safe_email);
	}

	public function test_user_name()
	{
		$this->assertRegExp('/^[a-z]+((_|\.)[a-z]+)?$/D', $this->generate->user_name);
	}

	public function test_user_name_with_arg()
	{
		$this->assertRegExp('/^(clint(_|\.)eastwood|eastwood(_|\.)clint)$/D', $this->generate->user_name('clint eastwood'));
	}

	public function test_domain_name()
	{
		$this->assertRegExp('/^\w+\.\w+$/D', $this->generate->domain_name);
	}

	public function test_domain_word()
	{
		$this->assertRegExp('/^\w+$/D', $this->generate->domain_word);
	}

	public function test_domain_suffix()
	{
		$this->assertRegExp('/^\w+(\.\w+)?$/D', $this->generate->domain_suffix);
	}

	public function test_ip_v4_address()
	{
		$this->assertEquals(4, count(explode('.', $this->generate->ip_v4_address)));

		for ($i=0; $i < 1000; $i++)
		{
			$addr = explode('.', $this->generate->ip_v4_address);

			foreach ($addr as $part)
			{
				$this->assertLessThanOrEqual(255, $part);
			}
		}
	}

	public function test_ip_v6_address()
	{
		$this->assertEquals(8, count(explode(':', $this->generate->ip_v6_address)));

		for ($i=0; $i < 1000; $i++)
		{
			$addr = explode(':', $this->generate->ip_v6_address);

			foreach ($addr as $part)
			{
				$this->assertLessThanOrEqual(65535, hexdec($part));
			}
		}
	}

} // End InternetTest