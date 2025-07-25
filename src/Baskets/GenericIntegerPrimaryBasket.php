<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Baskets;

use AppUtils\Collections\BaseIntegerPrimaryCollection;
use AppUtils\Interfaces\IntegerPrimaryRecordInterface;

/**
 * Basket-like collection for records with integer-based primary keys.
 * Can be used to manage items in a basket-like manner, allowing for
 * adding and removing items freely.
 *
 * It can be instantiated directly using {@see self::create()} or extended.
 *
 * > **NOTE**: This class only checks the primary key type of the records,
 * > it does not restrict the item classes to a specific type. In essence,
 * > as long as items implement {@see IntegerPrimaryRecordInterface}, they
 * > can be added to this basket.
 *
 * ## Trait variant
 *
 *  If you want to implement a basket without extending this class,
 *  see the {@see IntegerPrimaryBasketTrait} instead for instructions.
 *
 * @package App Utils
 * @subpackage Collections
 * @phpstan-import-type AnyCollectionRecord from BasketInterface
 */
class GenericIntegerPrimaryBasket extends BaseIntegerPrimaryCollection implements IntegerPrimaryBasketInterface
{
    use BasketTrait;
    use IntegerPrimaryBasketTrait;

    public function getDefaultID(): int
    {
        return $this->getAutoDefault();
    }

    /**
     * @param AnyCollectionRecord ...$initialRecords A collection, a record, or an array of records or collections. All other types will be ignored.
     * @return GenericIntegerPrimaryBasket
     */
    public static function create(...$initialRecords): ?GenericIntegerPrimaryBasket
    {
        return new self($initialRecords);
    }

    public function getAllowedItemClasses(): array
    {
        return array(
            IntegerPrimaryRecordInterface::class
        );
    }
}
