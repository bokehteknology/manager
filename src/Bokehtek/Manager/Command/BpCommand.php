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
use Bokehtek\Manager\Package;

use Bokehtek\Manager\Downloader\FileDownloader;
use Bokehtek\Manager\Downloader\GitDownloader;

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
		switch($this->interfaceArgument)
		{
			case 'install':
				if (!isset($this->params[0]))
				{
					$this->console->write("<color red>Path not specified!</color>");

					return;
				}
				else if (file_exists($this->params[0]) && is_dir($this->params[0]) && (($files = scandir($this->params[0])) && count($files) > 2))
				{
					$this->console->write("<color red>The directory specified is not empty!</color>");

					return;
				}

				$package = new Package();
				$package->setDownloader('git');
				$package->setPath($this->params[0]);
				$package->setUrl('git://github.com/bokehteknology/Bokeh-Platform.git');

				$latest = 'dev';

				if (!$this->isArgumentSet('dev'))
				{
					$latest = @file_get_contents('https://raw.github.com/bokehteknology/versioncheck/master/bokeh_platform/stable');

					if (!$latest)
					{
						$this->console->write("<color red>Unable to retrieve information about the last released version.</color>");

						return;
					}

					$package->setDownloaderData('reference', 'tags/' . $latest);
				}

				$this->console->exec("mkdir {$this->params[0]}");

				$this->console->write("  - <color green>Bokeh Platform</color> (<color yellow>{$latest}</color>)");
				$this->console->write("    Directory: <color yellow>" . realpath($this->params[0]) . "</color>");
				$this->console->write("    Downloading: ", false);
				$this->console->write("<color yellow>...</color>", false);

				$git = new GitDownloader($this->console);

				if (!$git->download($package))
				{
					$this->console->overwrite("<color yellow>0%</color>\n", true, 3);
					$this->console->write("<color red>There was an error during the download!</color>");

					return;
				}

				$this->console->overwrite("<color yellow>100%</color>\n", true, 3);

				$this->console->write("<color cyan>Bokeh Platform has been successfully downloaded!</color>");

				$this->console->write("\n<color cyan>Now you can install the dependencies by running:</color>");
				$this->console->write("  <color green>php {$this->scriptName} bp:vendors:install {$this->params[0]}</color>");
			break;

			case 'vendors:install':
			case 'vendors:update':
				if (!isset($this->params[0]))
				{
					$this->console->write("<color red>Path not specified!</color>");

					return;
				}
				else if (!file_exists($this->params[0]) || !is_dir($this->params[0]))
				{
					$this->console->write("<color red>The directory specified does not exist!</color>");

					return;
				}

				$bpRoot = realpath($this->params[0]);
				$bpSubRoot = $bpRoot . '/Bokeh-Platform';

				if (!file_exists($bpRoot . '/composer.json') && file_exists($bpSubRoot . '/composer.json'))
				{
					$bpRoot = $bpSubRoot;
				}
				else
				{
					$this->console->write("<color red>The directory specified is not a installation of Bokeh Platform!</color>");

					return;
				}

				$package = new Package();
				$package->setDownloader('file');
				$package->setDownloaderData('name', 'Composer');
				$package->setDownloaderData('secToWait', 3);
				$package->setPath($bpRoot . '/composer.phar');
				$package->setUrl('http://getcomposer.org/composer.phar');

				$file = new FileDownloader($this->console);

				if (!$file->download($package))
				{
					return;
				}

				list($inteface, $option) = explode(':', $this->interfaceArgument);

				$this->console->write("======================================================");
				$this->console->exec("cd {$bpRoot} && php composer.phar {$option}", true, true);
				$this->console->write("======================================================");
			break;

			case 'help':
			
			break;

			default:
				$this->console->write("<color red>No argument specified for the interface.</color>");
			break;
		}
	}
}
