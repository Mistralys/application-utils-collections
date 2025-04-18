<?php

declare(strict_types=1);

namespace AppUtilsTestClasses\StringClassesFolderA;

use AppUtilsTestClasses\BaseStringItem;

class StringItemD extends BaseStringItem
{
    public const ITEM_ID = 'D';

    public function getID(): string
    {
        return self::ITEM_ID;
    }
}
