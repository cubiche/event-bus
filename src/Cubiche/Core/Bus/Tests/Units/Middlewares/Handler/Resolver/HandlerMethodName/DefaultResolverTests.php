<?php

/**
 * This file is part of the Cubiche package.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cubiche\Core\Bus\Tests\Units\Middlewares\Handler\Resolver\HandlerMethodName;

use Cubiche\Core\Bus\Middlewares\Handler\Resolver\HandlerMethodName\DefaultResolver;
use Cubiche\Core\Bus\Tests\Fixtures\Command\LoginUserCommand;
use Cubiche\Core\Bus\Tests\Units\TestCase;

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
                    ->isEqualTo('handle')
        ;
    }
}
