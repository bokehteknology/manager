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
 * Interface for Bokeh Platform
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class BpCommand extends AbstractCommand
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * {@inheritDoc}
	 */
	public function run()
	{
		$this->console->write("<color cyan>This is an interface for Bokeh Platform.</color>");
	}
}
