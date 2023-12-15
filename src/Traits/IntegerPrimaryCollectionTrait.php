<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Traits\StringPrimaryCollectionTrait
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\Collections\BaseIntegerPrimaryCollection;
use AppUtils\Collections\CollectionException;
use AppUtils\Interfaces\IntegerPrimaryCollectionInterface;
use AppUtils\Interfaces\IntegerPrimaryRecordInterface;

/**
 * Trait that can be used to implement an integer-based item collection
 * without extending the {@see BaseIntegerPrimaryCollection} class - for
 * example, if the class already extends another class.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 *
 * @see IntegerPrimaryCollectionInterface
 */
trait IntegerPrimaryCollectionTrait
{
    /**
     * @var array<int,IntegerPrimaryRecordInterface>
     */
    protected array $items;

    /**
     * @return array<int,IntegerPrimaryRecordInterface>
     */
    protected function initItems() : array
    {
        if(isset($this->items)) {
            return $this->items;
        }

        $this->items = array();

        $this->registerItems();

        ksort($this->items);

        return $this->items;
    }

    abstract protected function registerItems() : void;

    protected function registerItem(IntegerPrimaryRecordInterface $item) : self
    {
        $this->items[$item->getID()] = $item;
        return $this;
    }

    /**
     * @return IntegerPrimaryRecordInterface[]
     */
    public function getAll() : array
    {
        return array_values($this->initItems());
    }

    /**
     * @return IntegerPrimaryRecordInterface
     * @throws CollectionException
     */
    public function getDefault(): IntegerPrimaryRecordInterface
    {
        return $this->getByID($this->getDefaultID());
    }

    /**
     * @param int $id
     * @return IntegerPrimaryRecordInterface
     * @throws CollectionException
     */
    public function getByID(int $id) : IntegerPrimaryRecordInterface
    {
        $items = $this->initItems();

        if(isset($items[$id]))
        {
            return $items[$id];
        }

        throw new CollectionException(
            'Collection record does not exist.',
            sprintf(
                'The collection record with ID "%s" does not exist.',
                $id
            ),
            IntegerPrimaryCollectionInterface::ERROR_CODE_RECORD_NOT_FOUND
        );
    }

    public function idExists(int $id) : bool
    {
        $items = $this->initItems();

        return isset($items[$id]);
    }

    /**
     * @return int[]
     */
    public function getIDs(): array
    {
        return array_keys($this->initItems());
    }
}
