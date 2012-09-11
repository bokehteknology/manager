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

use Bokehtek\Manager\Console;
use Bokehtek\Manager\Package;

/**
 * Interface for downloaders classes
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
interface DownloaderInterface
{
	/**
	 * Download package
	 */
	public function download(Package $package);

	/**
	 * Update package
	 */
	public function update(Package $package);
}
