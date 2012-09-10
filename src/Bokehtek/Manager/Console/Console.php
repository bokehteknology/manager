<?php

/*
 * This file is part of the BT Manager package.
 *
 * (c) Carlo <carlo@bokehteknology.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bokehtek\Manager\Console;

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
			'<color black>'		=> '0;30',
			'<color red>'		=> '0;31',
			'<color green>'		=> '0;32',
			'<color yellow>'	=> '0;33',
			'<color blue>'		=> '0;34',
			'<color purple>'	=> '0;35',
			'<color cyan>'		=> '0;36',
			'<color white>'		=> '0;37',

			/**
			 * Bold
			 */
			'<color black b>'	=> '1;30',
			'<color red b>'		=> '1;31',
			'<color green b>'	=> '1;32',
			'<color yellow b>'	=> '1;33',
			'<color blue b'		=> '1;34',
			'<color purple b>'	=> '1;35',
			'<color cyan b>'	=> '1;36',
			'<color white b>'	=> '1;37',

			/**
			 * Underline
			 */
			'<color black u>'	=> '1;30',
			'<color red u>'		=> '1;31',
			'<color green u>'	=> '1;32',
			'<color yellow u>'	=> '1;33',
			'<color blue u>'	=> '1;34',
			'<color purple u>'	=> '1;35',
			'<color cyan u>'	=> '1;36',
			'<color white u>'	=> '1;37',
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
		@exec($cmd, $output, $return)

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
		$message = str_replace(array_keys($this->colors), '\033[' . array_values($this->colors) . 'm', $message);
		$message = str_replace('</color>', '\033[' . $this->colors['<white>'] . 'm', $message);

		return $message;
	}

	/**
	 * Reset colors to white
	 *
	 * @param bool $newline		Append a new line to end
	 */
	public function resetColor($newline = true)
	{
		$this->write('\033[' . $this->colors['<white>'] . 'm', $newline);
	}
}
