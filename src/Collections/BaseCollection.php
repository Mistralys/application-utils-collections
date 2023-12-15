<?php

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\Interfaces\CollectionInterface;

abstract class BaseCollection implements CollectionInterface
{
    public function countRecords() : int
    {
        return count($this->getIDs());
    }
}
