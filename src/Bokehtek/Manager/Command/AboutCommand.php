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
use Bokehtek\Manager\Manager;

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
		$lines = array();
		$lines[] = '<color green>BP Manager - A manager system for Bokeh Teknology products</color>';
		$lines[] = '<color yellow>It allows you to install, update, manage some Bokeh Teknology products.</color>';
		$lines[] = '';

		$tagsFile = @file_get_contents('https://api.github.com/repos/bokehteknology/manager/tags');

		if ($tagsFile !== false)
		{
			$tags = @json_decode($tagsFile);

			if (count($tags) > 0)
			{
				$tag = $tags[0];

				if (version_compare($tag->name, Manager::VERSION, '>'))
				{
					$lines[] = '<color red>BP Manager is out of date!</color>';
					$lines[] = "<color red>The latest version available is {$tag->name}.</color>";
					$lines[] = '';
				}
			}
		}

		$lines[] = '<color cyan>For more information see http://www.bokehteknology.net/</color>';
		$lines[] = '';
		$lines[] = '<color yellow>Author:</color>';
		$lines[] = '  <color green>Carlo - carlo@bokehteknology.net</color>		GitHub: <color green>carlino1994</color>';

		$contributorsFile = @file_get_contents('https://api.github.com/repos/bokehteknology/manager/contributors');

		if ($contributorsFile !== false)
		{
			$contributors = @json_decode($contributorsFile);

			$lines[] = '';
			$lines[] = '<color yellow>All contributors:</color>';

			foreach($contributors as $key => $contributor)
			{
				$lines[] = "  - <color green>{$contributor->login}</color>";
			}
		}

		foreach($lines as $line)
		{
			$this->console->write($line);
		}
	}
}
