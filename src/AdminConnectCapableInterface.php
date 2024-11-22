<?php

declare(strict_types=1);

namespace Axleus\Admin;

interface AdminConnectCapableInterface
{
    public function loadDashboardData(): ?DashboardDataEntityInterface;
}
