<?php

/*
 * This file is part of the Cubiche package.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cubiche\Domain\Collections\Comparator;

use Cubiche\Domain\System\Enum;

/**
 * Sorting Order Enum.
 *
 * @method Order ASC()
 * @method Order DESC()
 *
 * @author Karel Osorio Ramírez <osorioramirez@gmail.com>
 */
final class Order extends Enum
{
    const ASC = 1;
    const DESC = -1;
}