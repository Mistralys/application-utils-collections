<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Collections\BaseStringPrimaryCollection;

/**
 * This collection has no items.
 *
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method StringPrimaryRecordImpl[] getAll()
 * @method StringPrimaryRecordImpl getByID(string $id)
 * @method StringPrimaryRecordImpl getDefault()
 */
class StringPrimaryCollectionEmptyImpl extends BaseStringPrimaryCollection
{
    public function getDefaultID(): string
    {
        return $this->getAutoDefault();
    }

    protected function registerItems(): void
    {
    }
}
