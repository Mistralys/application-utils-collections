<?php

declare(strict_types=1);

namespace AppUtilsTestClasses\StringClassesFolder;

use AppUtilsTestClasses\BaseStringItem;

class StringItemA extends BaseStringItem
{
    public const ITEM_ID = 'A';

    public function getID(): string
    {
        return self::ITEM_ID;
    }
}
