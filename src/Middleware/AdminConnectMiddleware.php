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
    public function __construct(
        private EventManagerInterface $eventManager,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $adminConnect  = new AdminConnectEvent(AdminConnectEvent::EVENT_ADMIN_CONNECT);
        $dataContainer = new AdminContainer([
            ConfigProvider::class => [
                // will hold general stats data??
            ],
        ]);
        $adminConnect->setTarget($dataContainer);

        $result = $this->eventManager->triggerEvent($adminConnect);
        // BashboardHandler
        return $handler->handle($request->withAttribute(AdminContainer::class, $result->last()));
    }
}
