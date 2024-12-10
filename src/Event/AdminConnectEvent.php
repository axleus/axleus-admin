<?php

declare(strict_types=1);

namespace Axleus\Admin\Event;

use Laminas\EventManager\Event;

class AdminConnectEvent extends Event
{
    public final const EVENT_ADMIN_CONNECT = 'admin.connect';

    public function getName()
    {
        return static::EVENT_ADMIN_CONNECT;
    }
}
