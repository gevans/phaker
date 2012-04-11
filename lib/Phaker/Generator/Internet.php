<?php

namespace Phaker\Generator;

/**
 * Internet generator.
 *
 * @package   Phaker
 * @category  Generators
 */
class Internet extends \Phaker {

	protected static $_ip_v6_space = array();

	/**
	 * Generate a generic email address. Optionally, pass a name for the user.
	 *
	 * @param   string  $name  User name
	 * @return  string
	 */
	public function email($name = NULL)
	{
		return implode('@', array($this->user_name($name), $this->domain_name));
	}

	/**
	 * Generate a free (Hotmail, Gmail, Yahoo, etc.) email address. Optionally,
	 * pass a name for the user.
	 *
	 * @param   string  $name  User name
	 * @return  string
	 */
	public function free_email($name = NULL)
	{
		return implode('@', array($this->user_name($name), static::fetch('internet.free_email')));
	}

	/**
	 * Generate a safe email address ending with example.tld, with a TLD of
	 * org, com, or net only.
	 *
	 * @param   string  $name  User name
	 * @return  string
	 */
	public function safe_email($name = NULL)
	{
		$tlds = array('org', 'com', 'net');
		return implode('@', array($this->user_name($name), 'example.'.$tlds[array_rand($tlds)]));
	}

	/**
	 * Generate a lowercase user name from a full or partial name.
	 *
	 *     echo $internet->user_name('Dr. Seuss'); // => "dr.seuss"
	 *
	 * @param   string  $name  User name
	 * @return  string
	 */
	public function user_name($name = NULL)
	{
		$delim = array('.', '_');

		if ($name)
		{
			$names = preg_split('/[^\w]+/', $name, NULL, PREG_SPLIT_NO_EMPTY);
			shuffle($names);
			return implode($delim[array_rand($delim)], $names);
		}

		if (mt_rand(0, 1))
		{
			$name = preg_replace('/\W/', '', \Phaker::name()->first_name);
		}
		else
		{
			$names = preg_replace('/\W/', '', array(\Phaker::name()->first_name, \Phaker::name()->last_name));
			$name  = implode($delim[array_rand($delim)], $names);
		}

		return static::fix_umlauts(strtolower($name));
	}

	/**
	 * @return  string
	 */
	public function domain_name()
	{
		return implode('.', array(static::fix_umlauts($this->domain_word), $this->domain_suffix));
	}

	/**
	 * @return  string
	 */
	public function domain_word()
	{
		list($word) = explode(' ', static::company()->name);
		return strtolower(preg_replace('/\W/', '', $word));
	}

	/**
	 * @return  string
	 */
	public function domain_suffix()
	{
		return static::fetch('internet.domain_suffix');
	}

	/**
	 * @return  string
	 */
	public function ip_v4_address()
	{
		return mt_rand(2, 254).'.'.mt_rand(2, 254).'.'.mt_rand(2, 254).'.'.mt_rand(2, 254);
	}

	/**
	 * @return  string
	 */
	public function ip_v6_address()
	{
		if ( ! static::$_ip_v6_space)
		{
			static::$_ip_v6_space = range(0, 65535);
		}

		$container = array();

		for ($i=0; $i < 7; $i++) {
			$container[] = static::$_ip_v6_space[array_rand(static::$_ip_v6_space)];
		}

		foreach ($container as $k => $v)
		{
			$container[$k] = base_convert($v, 10, 16);
		}

		return implode(':', $container);
	}

	/**
	 * @return  string
	 */
	public function url()
	{
		return 'http://'.$this->domain_name.'/'.$this->user_name;
	}

	/**
	 * Convert umlauts and other characters for safe use in URLs,
	 * email addresses, user names, etc.
	 *
	 * @return  string
	 */
	public static function fix_umlauts($string)
	{
		return str_ireplace(array('ä', 'ö', 'ü', 'ß'), array('ae', 'oe', 'ue', 'ss'), $string);
	}

} // End Internet