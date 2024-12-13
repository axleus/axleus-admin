<?php

declare(strict_types=1);

namespace AxleusTest\Admin\Handler;

use Axleus\Admin\Handler\DashboardHandler;
use Fig\Http\Message\RequestMethodInterface as Http;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

#[CoversClass(DashboardHandler::class)]
final class DashboardHandlerTest extends TestCase
{
    /** @var ContainerInterface&MockObject */
    protected $container;

    /** @var RouterInterface&MockObject */
    protected $router;

    protected ServerRequest $request;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->router    = $this->createMock(RouterInterface::class);
    }

    public function testDashboardHandlesGetRequest(): void
    {
        $renderer = $this->createMock(TemplateRendererInterface::class);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with('admin::dashboard', $this->isType('array'))
            ->willReturn('');

        $dashboard = new DashboardHandler($renderer);

        $request = new ServerRequest(
            uri: '/axleus/admin',
            method: Http::METHOD_GET,
        );

        $response = $dashboard->handle(
            $request
        );
        self::assertInstanceOf(HtmlResponse::class, $response);
    }
}
