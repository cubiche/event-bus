<?php

/**
 * This file is part of the Cubiche component.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cubiche\Core\Bus\Tests\Units\Middlewares\EventDispatcher;

use Cubiche\Core\Bus\Middlewares\EventDispatcher\EventDispatcherMiddleware;
use Cubiche\Core\Bus\Tests\Fixtures\Event\LoginUserEvent;
use Cubiche\Core\Bus\Tests\Fixtures\Event\LoginUserEventListener;
use Cubiche\Core\Bus\Tests\Units\TestCase;
use Cubiche\Core\EventDispatcher\EventDispatcher;

/**
 * EventDispatcherMiddleware class.
 *
 * Generated by TestGenerator on 2016-04-11 at 15:18:25.
 */
class EventDispatcherMiddlewareTests extends TestCase
{
    /**
     * Test Handle method.
     */
    public function testHandle()
    {
        $this
            ->given($dispatcher = new EventDispatcher())
            ->and($middleware = new EventDispatcherMiddleware($dispatcher))
            ->and($event = new LoginUserEvent('ivan@cubiche.com'))
            ->and($dispatcher->addListener($event->eventName(), array(new LoginUserEventListener(), 'onLogin')))
            ->and($dispatcher->addListener($event->eventName(), function (LoginUserEvent $event) {
                $this
                    ->string($event->email())
                    ->isEqualTo('info@cubiche.org')
                ;

                $event->setEmail('fake@email.com');
            }))
            ->and($callable = function (LoginUserEvent $event) {
                $event->setEmail('callback@email.com');
            })
            ->when($result = $middleware->handle($event, $callable))
            ->then()
                ->string($event->email())
                    ->isEqualTo('callback@email.com')
                ->exception(function () use ($middleware, $callable) {
                    $middleware->handle(new \StdClass(), $callable);
                })->isInstanceOf(\InvalidArgumentException::class)
        ;
    }

    /**
     * Test dispatcher method.
     */
    public function testDispatcher()
    {
        $this
            ->given($dispatcher = new EventDispatcher())
            ->and($middleware = new EventDispatcherMiddleware($dispatcher))
            ->when($result = $middleware->dispatcher())
            ->then()
                ->object($result)
                    ->isEqualTo($dispatcher)
        ;
    }
}
