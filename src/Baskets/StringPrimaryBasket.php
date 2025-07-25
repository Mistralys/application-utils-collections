<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Baskets;

use AppUtils\Collections\BaseStringPrimaryCollection;

/**
 * Basket-like collection for records with string-based primary keys.
 * Can be used to manage items in a basket-like manner, allowing for
 * adding and removing items freely.
 *
 * It can be instantiated directly using {@see self::create()} or extended.
 *
 * ## Trait variant
 *
 * If you want to implement a basket without extending this class,
 * see the {@see StringPrimaryBasketTrait} instead for instructions.
 *
 * @package App Utils
 * @subpackage Collections
 * @phpstan-import-type AnyCollectionRecord from BasketInterface
 */
class StringPrimaryBasket extends BaseStringPrimaryCollection implements StringPrimaryBasketInterface
{
    use BasketTrait;
    use StringPrimaryBasketTrait;

    public function getDefaultID(): string
    {
        return $this->getAutoDefault();
    }

    /**
     * @param AnyCollectionRecord ...$initialRecords A collection, a record, or an array of records or collections. All other types will be ignored.
     * @return StringPrimaryBasket
     */
    public static function create(...$initialRecords): StringPrimaryBasket
    {
        return new self($initialRecords);
    }
}
