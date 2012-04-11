<?php

use Phaker\I18n;
use Phaker\Util;

class Phaker_Generator_LoremTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var  object
	 */
	protected $generate;

	/**
	 * @var  array
	 */
	protected $standard_wordlist;

	/**
	 * @var  array
	 */
	protected $complete_wordlist;

	public function setUp()
	{
		$this->generate = Phaker::factory('lorem');
		$this->standard_wordlist = I18n::get('faker.lorem.words');
		$this->complete_wordlist = Util::array_merge($this->standard_wordlist, I18n::get('faker.lorem.supplemental'));
	}

	public function test_standard_words()
	{
		$words = $this->generate->words(1000);

		foreach ($words as $word)
		{
			$this->assertContains($word, $this->standard_wordlist);
		}
	}

	public function test_supplemental_words()
	{
		$words = $this->generate->words(10000, TRUE);

		foreach ($words as $word)
		{
			$this->assertContains($word, $this->complete_wordlist);
		}
	}

} // End LoremTest