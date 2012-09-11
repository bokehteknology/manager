<?php

/*
 * This file is part of the BT Manager package.
 *
 * (c) Carlo <carlo@bokehteknology.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bokehtek\Manager\Command;

use Bokehtek\Manager\Command\CommandInterface;
use Bokehtek\Manager\Console;

/**
 * An abstract console command
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
abstract class AbstractCommand implements CommandInterface
{
	/**
	 * @var string
	 */
	public $scriptName;

	/**
	 * @var Console
	 */
	public $console;

	/**
	 * @var string
	 */
	public $interfaceArgument;

	/**
	 * @var array
	 */
	public $params;

	public function __construct()
	{
	}

	/**
	 * Set argument request for the interface
	 *
	 * @param string $argument
	 */
	public function setInterfaceArgument($argument)
	{
		$this->interfaceArgument = $argument;
	}

	/**
	 * Set used console
	 *
	 * @param Console $console
	 */
	public function setConsole(Console $console)
	{
		$this->console = $console;
	}

	/**
	 * Set arguments passed to the script
	 *
	 * @param array $params;
	 */
	public function setParams($params)
	{
		$this->params = $params;
	}

	/**
	 * Set the script filename
	 *
	 * @param string $scriptName;
	 */
	public function setScriptName($scriptName)
	{
		$this->scriptName = $scriptName;
	}

	/**
	 * Check if an argument is set
	 *
	 * @param string $arg
	 */
	public function isArgumentSet($arg)
	{
		foreach($this->params as $key => $value)
		{
			if ($arg == $value)
			{
				return true;
			}
		}

		return false;
	}
}
