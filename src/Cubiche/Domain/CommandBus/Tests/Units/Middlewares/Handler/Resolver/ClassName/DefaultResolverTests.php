<?php

/**
 * This file is part of the Cubiche/Command component.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cubiche\Domain\CommandBus\Tests\Units\Middlewares\Handler\Resolver\ClassName;

use Cubiche\Domain\CommandBus\Middlewares\Handler\Resolver\ClassName\DefaultResolver;
use Cubiche\Domain\CommandBus\Tests\Fixtures\LoginUserCommand;
use Cubiche\Domain\CommandBus\Tests\Units\TestCase;

/**
 * DefaultResolver class.
 *
 * Generated by TestGenerator on 2016-04-07 at 15:40:41.
 */
class DefaultResolverTests extends TestCase
{
    /**
     * Test Resolve method.
     */
    public function testResolve()
    {
        $this
            ->given($resolver = new DefaultResolver())
            ->when($result = $resolver->resolve(new LoginUserCommand('ivan@cubiche.com', 'plainpassword')))
            ->then()
                ->string($result)
                    ->isEqualTo(LoginUserCommand::class)
        ;
    }
}
