<?php

/*
 * This file is part of the BT Manager package.
 *
 * (c) Carlo <carlo@bokehteknology.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bokehtek\Manager;

/**
 * Package information descriptor
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
class Package
{
	private $downloader;
	private $downloaderData;
	private $path;
	private $url;

	public function __construct()
	{
		$this->downloaderData = new \stdClass();
	}

	/**
	 * Set package downloader
	 *
	 * @param string $downloader
	 */
	public function setDownloader($downloader)
	{
		$this->downloader = $downloader;
	}

	/**
	 * Get package downloader
	 *
	 * @return string
	 */
	public function getDownloader()
	{
		return $this->downloader;
	}

	/**
	 * Set package downloader data
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function setDownloaderData($name, $value)
	{
		$this->downloaderData->$name = $value;
	}

	/**
	 * Get package downloader data
	 *
	 * @param string $name
	 * @return string
	 */
	public function getDownloaderData($name)
	{
		if (isset($this->downloaderData->$name))
		{
			return $this->downloaderData->$name;
		}

		return null;
	}

	/**
	 * Set package path
	 *
	 * @param string $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

	/**
	 * Get package path
	 *
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * Set package URL
	 *
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * Get package URL
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}
}
