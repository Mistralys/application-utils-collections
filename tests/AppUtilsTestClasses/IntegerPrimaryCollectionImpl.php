<?php

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Collections\BaseIntegerPrimaryCollection;

class IntegerPrimaryCollectionImpl extends BaseIntegerPrimaryCollection
{
    public const ITEM_A = 1;
    public const ITEM_B = 2;
    public const ITEM_C = 3;

    public const DEFAULT_ITEM = self::ITEM_A;

    public function getDefaultID(): int
    {
        return self::DEFAULT_ITEM;
    }

    protected function registerItems(): void
    {
        // On purpose not alphabetical, to be able to test
        // the sorting of items by ID.
        $this->registerItem(new IntegerPrimaryRecordImpl(self::ITEM_C));
        $this->registerItem(new IntegerPrimaryRecordImpl(self::ITEM_A));
        $this->registerItem(new IntegerPrimaryRecordImpl(self::ITEM_B));
    }
}
