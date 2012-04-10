<?php

use Phaker\I18n;

/**
 *
 */
class Phaker {

	// Current version
	const VERSION = '0.1.0';

	const NUMBERS  = '0123456789';
	const ULETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	const LETTERS  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	/**
	 *
	 *     echo Phaker::factory('name')->first_name;
	 *
	 * @param  [type] $generator [description]
	 * @return [type]
	 */
	public static function factory($class)
	{
		$generator = 'Phaker\\Generator\\'.$class;
		return new $generator;
	}

	/**
	 *
	 *     echo Phaker::name()->first_name;
	 *
	 * @param  [type] $generator [description]
	 * @param  [type] $args      [description]
	 * @return [type]
	 */
	public static function __callStatic($class, $args)
	{
		$generator = 'Phaker\\Generator\\'.$class;
		return new $generator;
	}

	public static function rand($min = 0, $max = 1)
	{
		return ($min + lcg_value() * (abs($max - $min)));
	}

	public static function numerify($number_string)
	{
		return preg_replace_callback(
			'/#/',
			create_function('$matches', 'return mt_rand(0, 9);'),
			preg_replace('/#/', mt_rand(1, 9), $number_string, 1));
	}

	public static function letterify($letter_string)
	{
		return preg_replace_callback(
			'/\?/',
			create_function('$matches', 'return substr(Phaker::ULETTERS, mt_rand(0, mb_strlen(Phaker::ULETTERS) - 1), 1);'),
			$letter_string);
	}

	public static function bothify($string)
	{
		return static::letterify(static::numerify($string));
	}

	/**
	 * Helper for the common approach of grabbing a translation
	 * with an array of values and selecting one of them.
	 *
	 * @param   string  $key  Translation key
	 * @return  string  Translated string
	 */
	public static function fetch($key)
	{
		$fetched = static::translate('faker.'.$key);

		if (is_array($fetched))
		{
			$fetched = $fetched[array_rand($fetched)];
		}

		// Detect regular expressions
		if (preg_match('/^\//D', $fetched) AND preg_match('/\/$/D'))
		{
			return static::regexify($fetched);
		}
		else
		{
			return $fetched;
		}
	}

	/**
	 * Load formatted string from the locale, "parsing" them
	 * into method calls that can be used to generate a
	 * formatted translation: e.g., "#{first_name} #{last_name}".
	 *
	 * @param   string  $key  Translation key
	 * @return  string  Parsed translation
	 */
	public static function parse($key)
	{
		// Class name of generator *without* namespaces
		$caller = strtolower(substr(get_called_class(), 17));
		$text   = '';

		if ($count = preg_match_all('/#\{(?P<kls>[A-Za-z]+\.)?(?P<meth>[^\}]+)\}(?P<etc>[^#]+)?/', static::fetch($key), $matches))
		{
			for ($i = 0; $i < $count; $i++)
			{
				$kls  = substr($matches['kls'][$i], 0, -1);
				$meth = $matches['meth'][$i];
				$etc  = $matches['etc'][$i];

				// If the token had a class Prefix (e.g., Name.first_name)
				// grab the constant, otherwise use self
				$cls = empty($kls) ? static::factory($caller) : static::factory($kls);

				// If the class had the method, call it, otherwise
				// fetch the translation (i.e. faker.name.first_name)
				if (method_exists($cls, $meth))
				{
					$text .= $cls->$meth();
				}
				else
				{
					$text .= static::fetch(((empty($kls)) ? $caller : $kls).'.'.strtolower($meth));
				}

				// And tack on spaces, commas, etc. left over in the string
				$text .= $etc;
			}
		}

		return $text;
	}

	/**
	 * Retrieves translations from the I18 class.
	 *
	 * @param   string  $string  Translation key
	 * @param   string  $lang    Language
	 * @return  string  Translated string
	 */
	public static function translate($string, $lang = NULL)
	{
		$translated = I18n::get($string, $lang);
		// Fallback to en if the translation was missing
		return ($translated === NULL) ? I18n::get($string, 'en') : $translated;
	}

	protected $_flexible_key;

	protected $_aliases = array();

	public function __get($key)
	{
		if (method_exists($this, $key))
		{
			return $this->$key();
		}
		elseif (array_key_exists($key, $this->_aliases))
		{
			return $this->{$this->_aliases[$key]}();
		}
		elseif ($this->_flexible_key AND $translation = static::translate($this->_flexible_key.'.'.$key))
		{
			return $translation;
		}
		else
		{
			// throw shit and flip tables
		}
	}

} // End Phaker