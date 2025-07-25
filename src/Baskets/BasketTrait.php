<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Baskets;

use AppUtils\Collections\Events\ItemAddedEvent;
use AppUtils\Collections\Events\ItemRemovedEvent;
use AppUtils\Interfaces\CollectionInterface;
use AppUtils\Interfaces\CollectionRecordInterface;

/**
 * Trait that can be used to implement a basket of items without
 * extending the {@see GenericStringPrimaryBasket} or {@see GenericIntegerPrimaryBasket}
 * classes - for example, if your class already extends another class.
 *
 * For individual instructions, please see:
 *
 * - {@see StringPrimaryBasketTrait} for string-primary items
 * - {@see IntegerPrimaryBasketTrait} for integer-primary items
 *
 * @package App Utils
 * @subpackage Collections
 * @phpstan-import-type AnyCollectionRecord from BasketInterface
 */
trait BasketTrait
{
    /**
     * @var array<int|string,CollectionRecordInterface>
     */
    private array $initialItems = array();

    /**
     * Optional constructor that can be used to
     * initialize the collection with items.
     *
     * @param AnyCollectionRecord $initialItems
     */
    public function __construct(...$initialItems)
    {
        $this->importInitialItems($initialItems);
    }

    public function addAny(...$items) : self
    {
        foreach($items as $item) {
            if ($item instanceof CollectionInterface) {
                $this->addCollection($item);
            } elseif (is_array($item)) {
                $this->addAny(...$item);
            } elseif ($item instanceof CollectionRecordInterface) {
                $this->addItem($item);
            }
        }

        return $this;
    }

    /**
     * @param AnyCollectionRecord $subject
     * @return void
     */
    protected function importInitialItems($subject): void
    {
        if($subject instanceof CollectionInterface) {
            foreach($subject->getAll() as $item) {
                $this->importInitialItems($item);
            }
            return;
        }

        if(is_array($subject)) {
            foreach($subject as $item) {
                $this->importInitialItems($item);
            }
            return;
        }

        if($subject instanceof CollectionRecordInterface) {
            $this->importInitialItem($subject);
        }
    }

    abstract protected function importInitialItem(CollectionRecordInterface $item): void;

    protected function registerItems(): void
    {
        foreach($this->initialItems as $item) {
            $this->addItem($item);
        }

        $this->initialItems = array();
    }

    public function addCollection(CollectionInterface $collection) : self
    {
        return $this->addItems($collection->getAll());
    }

    public function addItem(CollectionRecordInterface $item): self
    {
        $this->initItems();

        if($this->tryRegisterItem($item)) {
            $this->doSort();
            $this->triggerItemAdded($item);
        }

        return $this;
    }

    /**
     * @param array<int|string,CollectionRecordInterface|mixed> $items
     * @return array<int|string,CollectionRecordInterface>
     */
    abstract protected function filterItems(array $items) : array;

    protected function triggerItemAdded(CollectionRecordInterface $item): void
    {
        $this->triggerEvent(new ItemAddedEvent($this, $item), false);
    }

    protected function triggerItemRemoved(CollectionRecordInterface $item): void
    {
        $this->triggerEvent(new ItemRemovedEvent($this, $item), false);
    }

    public function onItemAdded(callable $listener): int
    {
        return $this->addEventListener(ItemAddedEvent::EVENT_NAME, $listener);
    }

    public function onItemRemoved(callable $listener): int
    {
        return $this->addEventListener(ItemRemovedEvent::EVENT_NAME, $listener);
    }

    public function removeItems(array $items): self
    {
        foreach($items as $itemOrID) {
            $this->removeItem($itemOrID);
        }

        return $this;
    }

    public function removeAll() : self
    {
        if(isset($this->items)) {
            return $this->removeItems($this->items);
        }

        return $this->removeItems($this->initialItems);
    }
}
