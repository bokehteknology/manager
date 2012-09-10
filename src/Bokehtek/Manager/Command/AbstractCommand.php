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
	 * @var Console
	 */
	public $console;

	/**
	 * @var array
	 */
	public $argv;

	public function __construct()
	{
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
	 * @param array $argv;
	 */
	public function setArgv($argv)
	{
		$this->argv = $argv;
	}
}
