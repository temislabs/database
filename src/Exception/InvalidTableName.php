<?php

/*
 * Copyright (c) 2023 Sura
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace Temis\Database\Exception;

use Temis\Corner\CornerInterface;
use Temis\Corner\CornerTrait;

/**
 * Class InvalidTableName
 * @package Temis\Database\Exception
 */
class InvalidTableName extends \InvalidArgumentException implements CornerInterface
{
    use CornerTrait;
}
