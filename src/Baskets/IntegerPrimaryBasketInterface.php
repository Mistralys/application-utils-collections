<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Baskets;

use AppUtils\Interfaces\IntegerPrimaryCollectionInterface;
use AppUtils\Interfaces\IntegerPrimaryRecordInterface;

/**
 * Interface for integer-based primary key collections that can be adjusted
 * by adding or removing items.
 *
 * See the base class {@see GenericIntegerPrimaryBasket} for how
 * to implement this interface.
 *
 * @package App Utils
 * @subpackage Collections
 */
interface IntegerPrimaryBasketInterface extends IntegerPrimaryCollectionInterface, BasketInterface
{
    /**
     * @return class-string<IntegerPrimaryRecordInterface>[]
     */
    public function getAllowedItemClasses(): array;
}
