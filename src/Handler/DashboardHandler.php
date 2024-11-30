<?php

declare(strict_types=1);

namespace Axleus\Admin\Handler;

use Axleus\Admin\ConfigProvider;
use Axleus\Admin\AdminContainer;
use Axleus\Admin\Event\AdminConnectEvent;
use Axleus\Core\Handler\HandlerTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\EventManager\EventManagerInterface;
use Mezzio\Template\TemplateRendererInterface;

class DashboardHandler implements RequestHandlerInterface
{
    use HandlerTrait;

    public function __construct(
        private TemplateRendererInterface $renderer
    ) {
    }

    public function handleGet(ServerRequestInterface $request): ResponseInterface
    {
        // $eventManager  = $request->getAttribute(EventManagerInterface::class);
        // $adminConnect  = new AdminConnectEvent(AdminConnectEvent::EVENT_ADMIN_CONNECT);
        // $dataContainer = new AdminContainer([
        //     ConfigProvider::class => [
        //         // will hold general stats data??
        //     ],
        // ]);
        // $adminConnect->setTarget($dataContainer);

        // $result = $eventManager->triggerEvent($adminConnect);
        return new HtmlResponse($this->renderer->render(
            'admin::dashboard',
            ['layout' => 'admin::layout']
        ));
    }
}
