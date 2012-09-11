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
		$template = 'wget --quiet -O %s %s';

		$cmd = sprintf($template, escapeshellarg($package->getPath()), escapeshellarg($package->getUrl()));

		return $this->console->exec($cmd);
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
