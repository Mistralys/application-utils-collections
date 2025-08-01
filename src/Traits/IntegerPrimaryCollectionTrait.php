<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Traits\IntegerPrimaryCollectionTrait
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\Collections\CollectionException;
use AppUtils\Collections\Events\ItemsInitializedEvent;
use AppUtils\Collections\RecordNotExistsException;
use AppUtils\Interfaces\CollectionRecordInterface;
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
 * @auto-generated This trait was generated by the {@see \AppUtils\Collections\Build\TraitBuilder::build()} command @2025-07-25 09:10:36
 *
 * @see IntegerPrimaryCollectionInterface
 */
trait IntegerPrimaryCollectionTrait
{
    /**
     * @var array<int,IntegerPrimaryRecordInterface>|NULL
     */
    protected ?array $items = null;

    /**
     * @return array<int,IntegerPrimaryRecordInterface>
     */
    protected function initItems() : array
    {
        if($this->items !== null) {
            return $this->items;
        }

        $this->items = array();

        $this->registerItems();
        $this->doSort();

        $this->triggerEvent(new ItemsInitializedEvent($this));

        // PHPStan does not understand that the items are initialized at this point.
        return $this->items ?? array();
    }

    /**
     * @return $this
     */
    protected function doSort() : self
    {
        if(isset($this->items)) {
            uasort($this->items, array($this, 'sortItems'));
        }

        return $this;
    }

    protected function isInitialized() : bool
    {
        return isset($this->items);
    }

    /**
     * Resets the collection, clearing all items.
     * @return void
     */
    protected function reset() : void
    {
        $this->items = null;
    }

    protected function sortItems(IntegerPrimaryRecordInterface $a, IntegerPrimaryRecordInterface $b) : int
    {
        return $a->getID() - $b->getID();
    }

    abstract protected function registerItems() : void;

    /**
     * Registers an item in the collection.
     *
     * > NOTE: Use {@see self::tryRegisterItem()} if you want to check
     * > whether the item was successfully registered or not.
     *
     * @param CollectionRecordInterface $item
     * @return $this
     */
    protected function registerItem(CollectionRecordInterface $item) : self
    {
        $this->tryRegisterItem($item);
        return $this;
    }

    /**
     * Registers an item in the collection if it is of the expected type
     * and not already present in the collection.
     *
     * @param CollectionRecordInterface $item
     * @return bool Whether the item was successfully registered.
     */
    protected function tryRegisterItem(CollectionRecordInterface $item) : bool
    {
        if($item instanceof IntegerPrimaryRecordInterface && !isset($this->items[$item->getID()])) {
            $this->items[$item->getID()] = $item;
            return true;
        }

        return false;
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
     * @param integer $id
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

        throw new RecordNotExistsException($this, $id, IntegerPrimaryCollectionInterface::ERROR_CODE_RECORD_NOT_FOUND);
    }

    public function idExists(int $id) : bool
    {
        $items = $this->initItems();

        return isset($items[$id]);
    }

    public function getIDs(): array
    {
        return array_keys($this->initItems());
    }

    /**
     * Utility method that can be used in the {@see self::getDefaultID()}
     * method if no specific default ID is available. Will automatically
     * use the first item in the collection as the default ID if the
     * list is not empty.
     *
     * @return integer
     */
    protected function getAutoDefault() : int
    {
        // Important: Init the items here to ensure that the
        // collection is loaded and sorted before we try to
        // access the first item.
        $items = $this->initItems();

        if(!empty($items)) {
            return array_key_first($items);
        }

        return IntegerPrimaryCollectionInterface::ID_NO_DEFAULT_AVAILABLE;
    }
}
