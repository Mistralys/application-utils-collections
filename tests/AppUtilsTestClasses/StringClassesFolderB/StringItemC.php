<?php

declare(strict_types=1);

namespace AppUtilsTestClasses\StringClassesFolderB;

use AppUtilsTestClasses\BaseStringItem;

class StringItemC extends BaseStringItem
{
    public const ITEM_ID = 'C';

    public function getID(): string
    {
        return self::ITEM_ID;
    }
}
