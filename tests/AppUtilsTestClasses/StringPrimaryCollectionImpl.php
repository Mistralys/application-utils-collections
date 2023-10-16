<?php

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Collections\BaseStringPrimaryCollection;

class StringPrimaryCollectionImpl extends BaseStringPrimaryCollection
{
    public const ITEM_A = 'a';
    public const ITEM_B = 'b';
    public const ITEM_C = 'c';

    public const DEFAULT_ITEM = self::ITEM_A;

    public function getDefaultID(): string
    {
        return self::DEFAULT_ITEM;
    }

    protected function registerItems(): void
    {
        // On purpose not alphabetical, to be able to test
        // the sorting of items by ID.
        $this->registerItem(new StringPrimaryRecordImpl(self::ITEM_C));
        $this->registerItem(new StringPrimaryRecordImpl(self::ITEM_A));
        $this->registerItem(new StringPrimaryRecordImpl(self::ITEM_B));
    }
}
