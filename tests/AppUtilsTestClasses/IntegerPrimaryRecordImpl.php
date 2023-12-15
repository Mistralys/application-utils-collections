<?php

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Interfaces\IntegerPrimaryRecordInterface;

class IntegerPrimaryRecordImpl implements IntegerPrimaryRecordInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getID(): int
    {
        return $this->id;
    }
}
