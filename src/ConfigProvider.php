<?php

declare(strict_types=1);

namespace Axleus\Admin;

use Fig\Http\Message\RequestMethodInterface as Http;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'routes'       => $this->getRoutes(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [],
            'factories' => [
                Middleware\AdminConnectMiddleware::class => Middleware\AdminConnectMiddlewareFactory::class,
            ],
        ];
    }

    public function getRoutes(): array
    {
        return [
            [
                'path' => '/admin',
                'name' => 'Admin Dashboard',
                'middleware' => [
                    BodyParamsMiddleware::class,
                    Middleware\AdminConnectMiddleware::class,
                    Handler\DashboardHandler::class,
                ],
                'allowed_methods' => [Http::METHOD_GET],
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'admin' => [__DIR__ . '/../templates/admin'],
            ],
        ];
    }
}
