<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Collections\BaseIntegerPrimaryCollection;

/**
 * Implements an empty collection of items with an integer primary key.
 *
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method IntegerPrimaryRecordImpl[] getAll()
 * @method IntegerPrimaryRecordImpl getByID(int $id)
 * @method IntegerPrimaryRecordImpl getDefault()
 */
class IntegerPrimaryCollectionEmptyImpl extends BaseIntegerPrimaryCollection
{
    public function getDefaultID(): int
    {
        return $this->getAutoDefault();
    }

    protected function registerItems(): void
    {
    }
}
