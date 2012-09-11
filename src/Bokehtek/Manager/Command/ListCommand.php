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
			'<color yellow>Usage:</color>',
			'  <color green>command [arguments]</color>',
			'',


			'<color yellow>Available commands:</color>',
			'  <color green>about</color>			<color white>Displays information for BP Manager</color>',
			'  <color green>help</color>			<color white>An alias for \'lists\'</color>',
			'  <color green>list</color>			<color white>Lists commands</color>',
			'',


			'<color yellow>Available interfaces:</color>',

			'  <color yellow>Bokeh Platform</color>',
			'    <color green>bp:install</color>		<color white>Install latest Bokeh Platform</color>',
			'    <color green>bp:update</color>		<color white>Update Bokeh Platform</color>',
		);

		foreach($lines as $line)
		{
			$this->console->write($line);
		}
	}
}
