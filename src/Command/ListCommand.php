<?php

/*
 * This file is part of the BT Manager package.
 *
 * (c) Carlo <carlo@bokehteknology.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bokehtek\Manager\Command\ListCommand;

use Bokehtek\Manager\Command\AbstractCommand;

/**
 * List command
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class ListCommand extends AbstractCommand
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
		$lines = array(
			'<color yellow>Available interfaces:</color>',
			'	<color green>bp</color>			<color white>Bokeh Platform</color>',
		);

		foreach($lines as $line)
		{
			$this->console->write($line);
		}
	}
}
