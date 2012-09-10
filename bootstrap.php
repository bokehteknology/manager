#!/usr/bin/env php
<?php

/*
 * This file is part of the BT Manager package.
 *
 * (c) Carlo <carlo@bokehteknology.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bokehtek\Manager;

$manager = new Manager($argv);
$manager->run();

?>