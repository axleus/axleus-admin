<?php

declare(strict_types=1);

namespace Axleus\Admin\Middleware;

use Axleus\Admin\ConfigProvider;
use Axleus\Admin\AdminContainer;
use Axleus\Admin\Event\AdminConnectEvent;
use Laminas\EventManager\EventManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class AdminConnectMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $eventManager  = $request->getAttribute(EventManagerInterface::class);
        $adminConnect  = new AdminConnectEvent(AdminConnectEvent::EVENT_ADMIN_CONNECT);
        $dataContainer = new AdminContainer([
            ConfigProvider::class => [
                // will hold general stats data??
            ],
        ]);
        $adminConnect->setTarget($dataContainer);

        $result = $eventManager->triggerEvent($adminConnect);
        // DashboardHandler
        return $handler->handle($request->withAttribute(AdminContainer::class, $result->last()));
    }
}
