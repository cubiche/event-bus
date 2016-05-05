<?php

/**
 * This file is part of the Cubiche/Model component.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cubiche\Domain\Model\Tests\Units\Specification;

use Cubiche\Domain\Model\Selector\Entity;
use Cubiche\Domain\Model\Specification\ModelCriteria;
use Cubiche\Domain\Model\Tests\Units\TestCase;

/**
 * ModelCriteriaTests class.
 *
 * Generated by TestGenerator on 2016-05-03 at 16:01:26.
 */
class ModelCriteriaTests extends TestCase
{
    /**
     * Test AsEntity method.
     */
    public function testAsEntity()
    {
        $this
            ->given($criteria = ModelCriteria::asEntity())
            ->then()
                ->object($criteria)
                    ->isInstanceOf(Entity::class)
        ;
    }
}
