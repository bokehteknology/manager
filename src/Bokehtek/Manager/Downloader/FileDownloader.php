<?php

/*
 * This file is part of the BT Manager package.
 *
 * (c) Carlo <carlo@bokehteknology.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bokehtek\Manager\Downloader;

use Bokehtek\Manager\Downloader\AbstractDownloader;
use Bokehtek\Manager\Console;
use Bokehtek\Manager\Package;

/**
 * File Downloader
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class FileDownloader extends AbstractDownloader
{
	public function __construct(Console $console)
	{
		parent::__construct($console);
	}

	/**
	 * {@inheritDoc}
	 */
	public function download(Package $package)
	{
		$templateHeader = 'curl -sI %s';
		$template = 'wget -q -b -O %s %s &> /dev/null 2>&1';

		$cmdHeader = sprintf($templateHeader, escapeshellarg($package->getUrl()));
		$cmd = sprintf($template, escapeshellarg($package->getPath()), escapeshellarg($package->getUrl()));

		if ($package->getDownloaderData('name') == null)
		{
			$this->console->write("  - <color green>{$package->getUrl()}</color>");
		}
		else
		{
			$this->console->write("  - <color green>{$package->getDownloaderData('name')}</color>");
		}

		if (!$package->getDownloaderData('hideSaveTo'))
		{
			$this->console->write("    File: <color yellow>{$package->getPath()}</color>");
		}

		$this->console->write("    Downloading: ", false);
		$this->console->write("<color yellow>  0%</color>", false);

		$httpStatus = $this->console->exec("{$cmdHeader} | grep HTTP/1. | cut -d ' ' -f 2", true);

		if ($httpStatus[0] == 200)
		{
			$fileSize = $this->console->exec("{$cmdHeader} | grep Content-Length | cut -d ' ' -f 2", true);
			
			if (count($fileSize) == 0)
			{
				unset($fileSize);
			}
			else
			{
				$fileSize = $fileSize[0];
			}

			@unlink($package->getPath());
			$this->console->exec("touch {$package->getPath()}");

			$this->console->exec($cmd);

			if (isset($fileSize))
			{
				$downloadComplete = false;

				while(!$downloadComplete)
				{
					// 0.5 sec
					usleep(500000);

					$currentDownloaded = $this->console->exec("du {$package->getPath()} | cut -d '\t' -f 1", true);
					$currentDownloaded = ((int) $currentDownloaded[0]) * 1024;

					$pc = (int) (($currentDownloaded / $fileSize) * 100);
					$pcString = (string) $pc;

					$this->console->overwrite("<color yellow>" . str_repeat(' ', (3 - strlen($pcString))) . $pc . "%</color>", false, 4);

					if ($currentDownloaded >= $fileSize)
					{
						$downloadComplete = true;
					}
				}
			}

			$this->console->overwrite("<color yellow>100%</color>\n", true, 4);

			if (!isset($fileSize))
			{
				$secToWait = ($package->getDownloaderData('secToWait') == null) ? 5 : ((int) $package->getDownloaderData('secToWait'));
				$sec = 0;

				$this->console->write("  >> <color red>The remote host has not provided the size of the file to download.</color>");
				$this->console->write("  >> <color red>Wait {$secToWait} seconds </color>", false);

				do
				{
					$this->console->write("<color red>.</color>", false);
					sleep(1);
					$sec++;
				} while($sec < $secToWait);

				$this->console->write("\n");
			}

			return true;
		}

		$this->console->write("\n\n<color red>There was an error while downloading {$package->getDownloaderData('name')}!</color>");

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function update(Package $package)
	{
		// The same as download
		return $this->download($package);
	}
}
