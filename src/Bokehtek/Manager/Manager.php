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

use Bokehtek\Manager\Console;

use Bokehtek\Manager\Command\DefaultCommand;
use Bokehtek\Manager\Command\ListCommand;

/**
 * Bokeh Manager Class
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class Manager
{
	const VERSION = '1.0.0-dev';

	/**
	 * @var Bokehtek\Manager\Console
	 */
	public $console;

	/**
	 * @var Bokehtek\Manager\Command\AbstractCommand
	 */
	public $command;

	/**
	 * Manager constructor
	 *
	 * @param array $argv	Agrument passed to the script
	 */
	public function __construct($argv)
	{
		$this->console = new Console();

		if (!$this->console->isInteractive())
		{
			exit;
		}

		$argv[1] = isset($argv[1]) ? $argv[1] : 'help';

		switch($argv[1])
		{
			case 'bp':
				$this->command = new BpCommand();
			break;

			case 'help':
			case 'list':
				$this->command = new ListCommand();
			break;

			default:
				$this->command = new DefaultCommand();
				$this->command->cmd = $argv[1];
			break;
		}

		array_unshift($argv, $argv[0], $argv[1]);

		$this->command->setConsole($this->console);
		$this->command->setArgv(array_shift($argv));
	}

	/**
	 * Run Manager
	 */
	public function run()
	{
		$this->console->write("<color green>BP Manager</color> <color yellow>" . self::VERSION . "</color>\n");

		$this->command->run();

		$this->console->resetColor();

		exit;
	}
}
