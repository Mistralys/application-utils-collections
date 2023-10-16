<?php

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Interfaces\StringPrimaryRecordInterface;

class StringPrimaryRecordImpl implements StringPrimaryRecordInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getID(): string
    {
        return $this->id;
    }
}
