<?php

declare(strict_types=1);

namespace Axleus\Admin;

use Axleus\Core\Middleware\AuthorizedHandlerPipelineDelegator as AuthorizedPipeline;
use Fig\Http\Message\RequestMethodInterface as Http;
use Mezzio\Helper\BodyParams\BodyParamsMiddleware;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies'             => $this->getDependencies(),
            'mezzio-authorization-acl' => $this->getAuthorizationConfig(),
            'routes'                   => $this->getRoutes(),
            'templates'                => $this->getTemplates(),
        ];
    }

    public function getAuthorizationConfig(): array
    {
        return [
            'resources' => [
                'admin.dashboard',
            ],
            'allow'     => [
                'Administrator' => [
                    'admin.dashboard',
                ],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'    => [],
            'delegators' => [
                Middleware\AdminConnectMiddleware::class => [
                    AuthorizedPipeline::class,
                ],
            ],
            'factories'  => [
                Handler\DashboardHandler::class => Handler\DashboardHandlerFactory::class,
            ],
            'invokables' => [
                Middleware\AdminConnectMiddleware::class => Middleware\AdminConnectMiddleware::class,
            ],
        ];
    }

    public function getRoutes(): array
    {
        return [
            [
                'path'            => '/axleus/admin',
                'name'            => 'admin.dashboard',
                'allowed_methods' => [Http::METHOD_GET],
                'middleware'      => [
                    BodyParamsMiddleware::class,
                    Middleware\AdminConnectMiddleware::class,
                    Handler\DashboardHandler::class,
                ],
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
