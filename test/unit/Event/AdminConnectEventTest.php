<?php

declare(strict_types=1);

namespace AxleusTest\Admin\Event;

use Axleus\Admin\Event\AdminConnectEvent;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AdminConnectEvent::class)]
final class AdminConnectEventTest extends TestCase
{
    public function testAdminConnectEventReturnsCorrectEvent(): void
    {
        self::assertEquals('admin.connect', (new AdminConnectEvent())->getName());
    }
}
