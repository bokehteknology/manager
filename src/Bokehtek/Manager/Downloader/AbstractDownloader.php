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

use Bokehtek\Manager\Downloader\DownloaderInterface;
use Bokehtek\Manager\Console;

/**
 * An abstract downloader
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
abstract class AbstractDownloader implements DownloaderInterface
{
	/**
	 * @var Console
	 */
	public $console;

	public function __construct(Console $console)
	{
		$this->console = $console;
	}
}
