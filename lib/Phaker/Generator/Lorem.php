<?php

namespace Phaker\Generator;

/**
 * Lorem Ipsum generator.
 *
 * @package   Phaker
 * @category  Generators
 */
class Lorem extends \Phaker {

	/**
	 *
	 * @return  array
	 */
	public function words($num = 3, $supplemental = FALSE)
	{
		$words = static::translate('faker.lorem.words') +
			($supplemental ? static::translate('faker.lorem.supplemental') : array());
		shuffle($words);
		return array_slice($words, 0, $num);
	}

	/**
	 *
	 * @return  string
	 */
	public function characters($char_count = 255)
	{
		$chars  = \Phaker::NUMBERS.\Phaker::ULETTERS;
		$length = mb_strlen($chars) - 1;
		$string = '';

		for ($i = 1; $i < $char_count; $i++)
		{
			$string .= $chars[mt_rand(0, $length)];
		}

		return strtolower($string);
	}

	/**
	 *
	 * @return  string
	 */
	public function sentence($word_count = 4, $supplemental = FALSE)
	{
		return ucfirst(implode(' ', $this->words($word_count + mt_rand(0, 6), $supplemental))).'.';
	}

	/**
	 *
	 * @return  array
	 */
	public function sentences($sentence_count = 3, $supplemental = FALSE)
	{
		$sentences = array();
		for ($i = 1; $i < $sentence_count; $i++)
		{
			$sentences[] = $this->sentence(3, $supplemental);
		}
		return $sentences;
	}

	/**
	 *
	 * @return  string
	 */
	public function paragraph($sentence_count = 3, $supplemental = FALSE)
	{
		return implode(' ', $this->sentences($sentence_count + mt_rand(0, 3), $supplemental));
	}

	/**
	 *
	 * @return  array
	 */
	public function paragraphs($paragraph_count = 3, $supplemental = FALSE)
	{
		$paragraphs = array();
		for ($i = 1; $i < $paragraph_count; $i++)
		{
			$paragraphs[] = $this->paragraph(3, $supplemental);
		}
		return $paragraphs;
	}

} // End Lorem