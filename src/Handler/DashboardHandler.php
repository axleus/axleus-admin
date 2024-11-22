<?php

declare(strict_types=1);

namespace Axleus\Admin\Handler;

use Axleus\Core\Handler\HandlerTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class DashboardHandler implements RequestHandlerInterface
{
    use HandlerTrait;

    public function __construct(
        TemplateRendererInterface $renderer
    ) {
    }

    public function handleGet(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->renderer->render(
            'admin::dashboard',
            [
                'layout' => 'admin::layout', // render our layout for the admin module
            ]
        ));
    }
}
