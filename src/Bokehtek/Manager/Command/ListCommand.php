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

			// Bokeh Platform
			'  <color yellow>Bokeh Platform</color>',
			'    <color green>bp:install</color>		<color white>Install latest Bokeh Platform</color>',
			'    <color green>bp:update</color>		<color white>Update Bokeh Platform</color>',
			'    <color green>bp:vendors:install</color>	<color white>Install dependencies</color>',
			'    <color green>bp:vendors:update</color>	<color white>Update dependencies</color>',

			'',


			'<color yellow>To display the help for a command:</color>',
			'  <color green>php ' . $this->scriptName . ' [command] help</color>',
		);

		foreach($lines as $line)
		{
			$this->console->write($line);
		}
	}
}
