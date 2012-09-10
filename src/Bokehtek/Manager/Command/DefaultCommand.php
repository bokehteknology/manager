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

use Bokehtek\Manager\Command\AbstractCommand;

/**
 * Default command
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class DefaultCommand extends AbstractCommand
{
	/**
	 * @var string
	 */
	public $cmd;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * {@inheritDoc}
	 */
	public function run()
	{
		$this->console->write("<color red>There is no interface for \"{$this->cmd}\".</color>");
	}
}
