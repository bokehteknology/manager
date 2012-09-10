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

/**
 * An abstract console command
 *
 * @author Carlo <carlo@bokehteknology.net>
 */
interface CommandInterface
{
	/**
	 * Run the command
	 */
	public function run();
}
