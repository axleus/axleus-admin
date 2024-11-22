<?php

declare(strict_types=1);

namespace Axleus\Admin;

use Laminas\Stdlib\ArrayObject;

final class AdminContainer extends ArrayObject
{
    public function __construct(
        $input = [],
        $flags = self::ARRAY_AS_PROPS,
    ) {
        parent::__construct($input, $flags);
    }
}
