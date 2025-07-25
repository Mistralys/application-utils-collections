<?php

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\Baskets\GenericStringPrimaryBasket;

/**
 * Basket which restricts the items to a specific class,
 * {@see SpecificItemImpl}.
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
