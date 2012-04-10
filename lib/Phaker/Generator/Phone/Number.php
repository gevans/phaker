<?php

namespace Phaker\Generator;

/**
 *
 * @package  Phaker
 */
class Phone_Number extends \Phaker {

	public function phone_number()
	{
		return static::numerify(static::fetch('phone_number.formats'));
	}

	public function cell_number()
	{
		$translation = static::translate('faker.cell_phone');

		if ($translation AND is_array($translation))
		{
			return static::numerify($translation['formats'][array_rand($translation['formats'])]);
		}
		else
		{
			return static::numerify(static::fetch('phone_number.formats'));
		}
	}

} // End Phone_Number