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
 * About command
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class AboutCommand extends AbstractCommand
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
			'<color green>BP Manager - A manager system for Bokeh Teknology products</color>',
			'<color yellow>It allows you to install, update, manage some Bokeh Teknology products.</color>',
			'',
			'<color cyan>For more information see http://www.bokehteknology.net/</color>',
			'',
			'<color yellow>Authors:</color>',
			'  <color green>Carlo - carlo@bokehteknology.net</color>		GitHub: carlino1994',
		);

		foreach($lines as $line)
		{
			$this->console->write($line);
		}
	}
}
