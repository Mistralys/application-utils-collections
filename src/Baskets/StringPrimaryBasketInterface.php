<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Baskets;

use AppUtils\Interfaces\StringPrimaryCollectionInterface;

/**
 * Interface for string-based primary key collections that can be adjusted
 * by adding or removing items.
 *
 * See the base class {@see StringPrimaryBasket} for how
 * to implement this interface.
 *
 * @package App Utils
 * @subpackage Collections
 */
interface StringPrimaryBasketInterface extends StringPrimaryCollectionInterface, BasketInterface
{

}
