<?php

/**
 * This file is part of the Cubiche package.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cubiche\Domain\Collections\Specification\Quantifier;

use Cubiche\Domain\Collections\Specification\SpecificationVisitorInterface;

/**
 * All Quantifier Class.
 *
 * @author Karel Osorio Ramírez <osorioramirez@gmail.com>
 */
class All extends Quantifier
{
    /**
     * {@inheritdoc}
     *
     * @see \Cubiche\Domain\Collections\Specification\Specification::visit($visitor)
     */
    public function visit(SpecificationVisitorInterface $visitor)
    {
        return $visitor->visitAll($this);
    }
}
