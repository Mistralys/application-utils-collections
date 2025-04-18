<?php

declare(strict_types=1);

namespace AppUtilsTestClasses\StringClassesFolderB;

use AppUtilsTestClasses\BaseStringItem;

class StringItemB extends BaseStringItem
{
    public const ITEM_ID = 'B';

    public function getID(): string
    {
        return self::ITEM_ID;
    }
}
