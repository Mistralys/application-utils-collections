<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Collections\BaseStringPrimaryCollection;

/**
 * This collection has no specific default item.
 * It automatically sets the default item to the
 * first item in the collection.
 *
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method StringPrimaryRecordImpl[] getAll()
 * @method StringPrimaryRecordImpl getByID(string $id)
 * @method StringPrimaryRecordImpl getDefault()
 */
class StringPrimaryCollectionNoDefaultImpl extends BaseStringPrimaryCollection
{
    public const ITEM_A = 'a';
    public const ITEM_B = 'b';
    public const ITEM_C = 'c';

    public function getDefaultID(): string
    {
        return $this->getAutoDefault();
    }

    protected function registerItems(): void
    {
        $this->registerItem(new StringPrimaryRecordImpl(self::ITEM_A));
        $this->registerItem(new StringPrimaryRecordImpl(self::ITEM_B));
        $this->registerItem(new StringPrimaryRecordImpl(self::ITEM_C));
    }
}
