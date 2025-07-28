<?php

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Baskets\GenericStringPrimaryBasket;

/**
 * Basket which restricts the items to a specific class,
 * {@see SpecificItemImpl}.
 *
 * @method SpecificItemImpl[] getAll()
 * @method SpecificItemImpl getByID(string $id)
 * @method static SpecificItemBasketImpl create(...$initialRecords)
 */
class SpecificItemBasketImpl extends GenericStringPrimaryBasket
{
    public function getAllowedItemClasses(): array
    {
        return array(
            SpecificItemImpl::class
        );
    }
}
