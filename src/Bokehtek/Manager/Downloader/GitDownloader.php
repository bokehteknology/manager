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
 * Git Downloader
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class GitDownloader extends AbstractDownloader
{
	public function __construct(Console $console)
	{
		parent::__construct($console);

		putenv('GIT_ASKPASS=echo');
	}

	/**
	 * {@inheritDoc}
	 */
	public function download(Package $package)
	{
		$template = 'git clone --quiet %s %s && cd %2$s && git fetch origin';
		$update = true;

		$cmd = sprintf($template, escapeshellarg($package->getUrl()), escapeshellarg($package->getPath()), escapeshellarg($package->getDownloaderData('reference')));

		$download = $this->console->exec($cmd);

		if ($download && $package->getDownloaderData('reference') != null)
		{
			$update = $this->updateToReference($package->getPath(), $package->getDownloaderData('reference'));
		}

		return $download && $update;
	}

	/**
	 * {@inheritDoc}
	 */
	public function update(Package $package)
	{
	}

	/**
	 * Update repository to a specific reference
	 *
	 * @param string $path
	 * @param string $reference
	 * @return bool
	 */
	public function updateToReference($path, $reference)
	{
		$template = 'cd %s && git checkout --quiet %s && git reset --quiet --hard %2$s';

		$cmd = sprintf($template, escapeshellarg($path), escapeshellarg($reference));

		return $this->console->exec($cmd);
	}
}
