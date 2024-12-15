<?php

declare(strict_types=1);

namespace Axleus\Admin;

use Laminas\Stdlib\ArrayObject;
use Laminas\Stdlib\Exception\InvalidArgumentException;

final class AdminContainer extends ArrayObject
{
    /**
     * @param array $input
     * @throws InvalidArgumentException
     */
    public function __construct(
        $input = [],
    ) {
        parent::__construct($input, self::ARRAY_AS_PROPS);
    }
}
