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

use Bokehtek\Manager\Command\ListCommand;

/**
 * Bokeh Manager Class
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class Manager
{
	/**
	 * @var Console
	 */
	public $console;

	/**
	 * Manager constructor
	 *
	 * @param array $argv	Agrument passed to the script
	 */
	public function __construct($argv)
	{
		$this->console = new Console();

		if (!$this->console->isInteractive)
		{
			exit;
		}

		$argv[0] = isset($argv[0]) ? $argv[0] : 'list';

		switch($argv[0])
		{
			case 'bp':
				$command = new BPCommand();
			break;

			case 'list':
			default:
				$command = new ListCommand();
			break;
		}

		$command->setConsole($this->console);
		$command->setArgv(array_shift($argv));
	}

	/**
	 * Run Manager
	 */
	public function run()
	{
		$command->run();

		$this->console->resetColor();

		exit;
	}
}
