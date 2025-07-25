<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Baskets;

use AppUtils\Interfaces\IntegerPrimaryCollectionInterface;

/**
 * Interface for integer-based primary key collections that can be adjusted
 * by adding or removing items.
 *
 * See the base class {@see IntegerPrimaryBasket} for how
 * to implement this interface.
 *
 * @package App Utils
 * @subpackage Collections
 */
interface IntegerPrimaryBasketInterface extends IntegerPrimaryCollectionInterface, BasketInterface
{

}
