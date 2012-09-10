<?php

/*
 * This file is part of the BT Manager package.
 *
 * (c) Carlo <carlo@bokehteknology.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bokehtek\Manager;

/**
 * Console Input/Output helper
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class Console
{
	/**
	 * Colors replacement for bash
	 * Only regular
	 *
	 * @var array
	 */
	public $colors = array();

	public function __construct()
	{
		$this->colors = array(
			/**
			 * Regular
			 */
			'<color black>'		=> "\033[30m",
			'<color red>'		=> "\033[31m",
			'<color green>'		=> "\033[32m",
			'<color yellow>'	=> "\033[33m",
			'<color blue>'		=> "\033[34m",
			'<color purple>'	=> "\033[35m",
			'<color cyan>'		=> "\033[36m",
			'<color white>'		=> "\033[37m",

			/**
			 * Bold
			 */
			'<color black b>'	=> "\033[1;30m",
			'<color red b>'		=> "\033[1;31m",
			'<color green b>'	=> "\033[1;32m",
			'<color yellow b>'	=> "\033[1;33m",
			'<color blue b'		=> "\033[1;34m",
			'<color purple b>'	=> "\033[1;35m",
			'<color cyan b>'	=> "\033[1;36m",
			'<color white b>'	=> "\033[1;37m",

			/**
			 * Underline
			 */
			'<color black u>'	=> "\033[1;30m",
			'<color red u>'		=> "\033[1;31m",
			'<color green u>'	=> "\033[1;32m",
			'<color yellow u>'	=> "\033[1;33m",
			'<color blue u>'	=> "\033[1;34m",
			'<color purple u>'	=> "\033[1;35m",
			'<color cyan u>'	=> "\033[1;36m",
			'<color white u>'	=> "\033[1;37m",
		);
	}

	/**
	 * Get user input
	 *
	 * @return string			User input
	 */
	public function get()
	{
		return fgets(STDIN);
	}

	/**
	 * Ask a question to user
	 *
	 * @param string $question	Question to ask
	 * @return string			User response
	 */
	public function ask($question)
	{
		$this->write($question . ': ', false);

		$response = $this->get();

		$this->write("\n", false);

		return $response;
	}

	/**
	 * Write to console
	 *
	 * @param string $message	Message to write
	 * @param bool $newline		Append a new line to end
	 * @return bool
	 */
	public function write($message, $newline = true)
	{
		$message = $this->parseColor($message);

		return fwrite(STDOUT, $message . ($newline ? "\n" : ''));
	}

	/**
	 * Check if is interactive
	 *
	 * @return bool
	 */
	public function isInteractive()
	{
		return function_exists('posix_isatty') && posix_isatty(STDOUT);
	}

	/**
	 * Execute a command
	 *
	 * @param string $cmd		Command to execute
	 * @return array			Array with 2 elements: an array with output lines as element and a boolean with the executed command status
	 */
	public function exec($cmd)
	{
		@exec($cmd, $output, $return);

		return array($output, (bool) $return);
	}

	/**
	 * Color parser
	 *
	 * @param string $message	Message to parse
	 * @return string			Message with parsed colors
	 */
	public function parseColor($message)
	{
		$message = str_replace(array_keys($this->colors), array_values($this->colors), $message);
		$message = str_replace('</color>', $this->colors['<color white>'], $message);

		return $message;
	}

	/**
	 * Reset colors to white
	 *
	 * @param bool $newline		Append a new line to end
	 */
	public function resetColor($newline = true)
	{
		$this->write($this->colors['<color white>'], $newline);
	}
}
