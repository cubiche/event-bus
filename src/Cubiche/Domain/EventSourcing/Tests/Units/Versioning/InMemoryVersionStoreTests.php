<?php

/**
 * This file is part of the Cubiche/EventSourcing component.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cubiche\Domain\EventSourcing\Tests\Units\Versioning;

use Cubiche\Domain\EventSourcing\Tests\Fixtures\PostEventSourced;
use Cubiche\Domain\EventSourcing\Tests\Units\TestCase;
use Cubiche\Domain\EventSourcing\Versioning\InMemoryVersionStore;
use Cubiche\Domain\EventSourcing\Versioning\Version;

/**
 * InMemoryVersionStoreTests class.
 *
 * Generated by TestGenerator on 2016-07-29 at 12:24:22.
 */
class InMemoryVersionStoreTests extends TestCase
{
    /**
     * @return InMemoryVersionStore
     */
    protected function createStore()
    {
        return new InMemoryVersionStore();
    }

    /**
     * Test PersistAggregateRootVersion method.
     */
    public function testPersistAggregateRootVersion()
    {
        $this
            ->given($store = $this->createStore())
            ->and($aggregateVersion = Version::fromString('1.2.45'))
            ->and($applicationVersion = Version::fromString('1.2.0'))
            ->when(
                $store->persistAggregateRootVersion(PostEventSourced::class, $aggregateVersion, $applicationVersion)
            )
            ->then()
                ->object($store->loadAggregateRootVersion(PostEventSourced::class, $applicationVersion))
                    ->isEqualTo($aggregateVersion)
        ;
    }

    /**
     * Test LoadAggregateRootVersion method.
     */
    public function testLoadAggregateRootVersion()
    {
        $this
            ->given($store = $this->createStore())
            ->and($applicationVersion = Version::fromString('1.2.0'))
            ->then()
                ->object($store->loadAggregateRootVersion(PostEventSourced::class, $applicationVersion))
                    ->isEqualTo(Version::fromString('0.0.0'))
                ->object($store->loadAggregateRootVersion(PostEventSourced::class))
                    ->isEqualTo(Version::fromString('0.0.0'))
        ;
    }

    /**
     * Test PersistApplicationVersion method.
     */
    public function testPersistApplicationVersion()
    {
        $this
            ->given($store = $this->createStore())
            ->and($applicationVersion = Version::fromString('1.2.0'))
            ->when($store->persistApplicationVersion($applicationVersion))
            ->then()
                ->object($store->loadApplicationVersion())
                    ->isEqualTo($applicationVersion)
        ;
    }

    /**
     * Test LoadApplicationVersion method.
     */
    public function testLoadApplicationVersion()
    {
        $this
            ->given($store = $this->createStore())
            ->then()
                ->object($store->loadApplicationVersion())
                    ->isEqualTo(Version::fromString('0.0.0'))
        ;
    }
}
