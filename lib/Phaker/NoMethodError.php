<?php

namespace Phaker;

class NoMethodError extends \Exception {

	/**
	 * Creates a new exception for missing methods.
	 *
	 * @param  string          $method  Method name
	 * @param  string          $class   Class name
	 * @param  integer|string  $code    The exception code
	 */
	public function __construct($method, $class, $code = 0)
	{
		// Set the exception message
		$message = 'Undefined method `'.$method.'\' for '.$class;

		// Pass the message and integer code to the parent
		parent::__construct($message, (int) $code);

		// Save the unmodified code
		// @link http://bugs.php.net/39615
		$this->code = $code;
	}

} // End NoMethodError