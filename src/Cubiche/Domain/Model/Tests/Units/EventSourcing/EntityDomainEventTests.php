<?php

/**
 * This file is part of the Cubiche/Model component.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cubiche\Domain\Model\Tests\Units\EventSourcing;

use Cubiche\Domain\Model\EventSourcing\EntityDomainEvent;
use Cubiche\Domain\Model\EventSourcing\EntityDomainEventInterface;
use Cubiche\Domain\Model\Tests\Fixtures\CategoryId;
use Cubiche\Domain\Model\Tests\Units\TestCase;

/**
 * EntityDomainEventTests class.
 *
 * Generated by TestGenerator on 2016-05-03 at 16:01:26.
 */
class EntityDomainEventTests extends TestCase
{
    /**
     * Test create.
     */
    public function testCreate()
    {
        $this
            ->given($event = new EntityDomainEvent(CategoryId::fromNative($this->faker->ean13())))
            ->then()
                ->object($event)
                    ->isInstanceOf(EntityDomainEventInterface::class)
        ;
    }

    /**
     * Test AggregateId method.
     */
    public function testAggregateId()
    {
        $this
            ->given($id = CategoryId::fromNative($this->faker->ean13()))
            ->and($event = new EntityDomainEvent($id))
            ->then()
                ->object($event->aggregateId())
                    ->isEqualTo($id)
        ;
    }
}