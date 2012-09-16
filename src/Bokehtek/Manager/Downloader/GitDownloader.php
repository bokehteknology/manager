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
		$templateWithoutTags = 'cd %s && git fetch origin && git merge origin/master';
		$templateGetTagInfo = 'cd %s && git describe --exact-match %s';

		if ($package->getDownloaderData('updateToReference') != null)
		{
			$lastCommit = @file_get_contents(realpath($package->getPath()) . '/.git/HEAD');

			if (!$lastCommit)
			{
				return false;
			}

			$lastCommit = explode("\n", $lastCommit, 2);
			$lastCommit = $lastCommit[0];

			$tagName = sprintf($templateGetTagInfo, escapeshellarg($package->getPath()), escapeshellarg($lastCommit));
			list($tagName) = $this->console->exec($tagName, true);

			return $this->updateToReference($package->getPath(), $tagName);
		}

		$cmd = sprintf($templateWithoutTags, escapeshellarg($package->getPath()));

		return $this->console->exec($cmd);
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
