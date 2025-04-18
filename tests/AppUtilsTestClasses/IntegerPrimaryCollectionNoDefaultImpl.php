<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Collections\BaseIntegerPrimaryCollection;

/**
 * Implements a collection of items with an integer primary key,
 * and no default item. Uses the method {@see BaseIntegerPrimaryCollection::getAutoDefault()}
 * to return the default item ID.
 *
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method IntegerPrimaryRecordImpl[] getAll()
 * @method IntegerPrimaryRecordImpl getByID(int $id)
 * @method IntegerPrimaryRecordImpl getDefault()
 */
class IntegerPrimaryCollectionNoDefaultImpl extends BaseIntegerPrimaryCollection
{
    public const ITEM_A = 1;
    public const ITEM_B = 2;
    public const ITEM_C = 3;

    public function getDefaultID(): int
    {
        return $this->getAutoDefault();
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
