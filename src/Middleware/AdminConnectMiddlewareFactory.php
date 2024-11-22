<?php

declare(strict_types=1);

namespace Axleus\Admin\Middleware;

use Laminas\EventManager\EventManagerInterface;
use Psr\Container\ContainerInterface;

final class AdminConnectMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AdminConnectMiddleware
    {
        return new AdminConnectMiddleware($container->get(EventManagerInterface::class));
    }
}
