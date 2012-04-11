<?php

namespace Phaker;

use Symfony\Component\Yaml\Yaml;

/**
 * Internationalization class adapted from the Kohana framework.
 *
 * @author     Kohana Team
 * @copyright  (c) 2007-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 * @package    Phaker
 * @category   Helpers
 */
class I18n {

	public static $lang = 'en-us';

	protected static $_init = FALSE;

	protected static $_locale_dir;

	protected static $_cache = array();

	public static function init()
	{
		if (self::$_init)
		{
			// I18n is already initialized
			return;
		}

		// I18n is now initialized
		self::$_init = TRUE;

		// Set locale directory
		self::$_locale_dir = realpath(__DIR__.'/../../locales').DIRECTORY_SEPARATOR;
	}

	public static function get($string, $lang = NULL)
	{
		if ( ! self::$_init)
		{
			I18n::init();
		}

		if ( ! $lang)
		{
			// Use the global target language
			$lang = self::$lang;
		}

		// Load the translation table for this language
		$table = I18n::load($lang);

		// Return the translated string if it exists
		return Util::array_path($table, $string);
	}

	public static function load($lang)
	{
		if ( ! self::$_init)
		{
			I18n::init();
		}

		if (isset(self::$_cache[$lang]))
		{
			return self::$_cache[$lang];
		}

		// New translation table
		$table = array();

		// Split the language: language, region, locale, etc.
		$parts = explode('-', $lang);

		do
		{
			// Create a path for this set of parts
			$file = self::$_locale_dir.implode('-', $parts).'.yml';

			if (file_exists($file))
			{
				// Load and parse YAML-formatted file
				$yaml  = Yaml::parse($file);
				// Recursively merge language with table
				$table = Util::array_merge($table, $yaml[implode('-', $parts)]);
			}

			// Remove the last part
			array_pop($parts);
		}
		while ($parts);

		// Cache the translation table locally
		return self::$_cache[$lang] = $table;
	}

} // End I18n