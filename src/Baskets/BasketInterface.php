<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Baskets;

use AppUtils\Interfaces\CollectionInterface;
use AppUtils\Interfaces\CollectionRecordInterface;

/**
 * Interface for collections that act like a basket: They start out empty,
 * and records can be freely added or removed with public methods.
 *
 * @package App Utils
 * @subpackage Collections
 *
 * @phpstan-type AnyCollectionRecord CollectionInterface|CollectionRecordInterface|array<int|string,CollectionInterface|CollectionRecordInterface|mixed>|mixed|NULL
 */
interface BasketInterface extends CollectionInterface
{
    /**
     * Wildcard add method that will add one or more records to
     * the collection as long as a compatible primary type is
     * recognized.
     *
     * @param AnyCollectionRecord ...$items A collection, a record, or an array of records or collections. All other types will be ignored.
     * @return $this
     */
    public function addAny(...$items): self;

    /**
     * Adds all records from any collection to this collection.
     * Only records matching the primary key type of this
     * collection will be added, all others will be ignored.
     *
     * @param CollectionInterface $collection
     * @return $this
     */
    public function addCollection(CollectionInterface $collection): self;

    /**
     * Adds a record to the collection. If the record is already present,
     * it will be ignored.
     *
     * > **NOTE**: This will sort the collection after adding the record.
     * > When adding multiple records, it is more efficient to use {@see addItems()}
     * > instead, as it will only sort the collection once after all records
     * > have been added.
     *
     * @param CollectionRecordInterface $item
     * @return $this
     */
    public function addItem(CollectionRecordInterface $item): self;

    /**
     * Adds multiple records to the collection. If a record is already present,
     * it will be ignored.
     *
     * @param array<int|string,CollectionRecordInterface> $items
     * @return $this
     */
    public function addItems(array $items): self;

    /**
     * Removes a record from the collection by its ID or instance.
     * Records that are not present in the collection will be ignored.
     *
     * @param CollectionRecordInterface|string|int|NULL $recordOrID
     * @return $this
     */
    public function removeItem($recordOrID): self;

    /**
     * List of records or record IDs to remove from the collection.
     * Records that are not present in the collection will be ignored.
     *
     * @param array<int|string,CollectionRecordInterface|int|string> $items
     * @return $this
     */
    public function removeItems(array $items): self;

    /**
     * Removes all records from the collection at once.
     * @return $this
     */
    public function removeAll(): self;

    /**
     * Adds a listener that will be triggered when a record is added to the collection.
     * @param callable $listener
     * @return int
     */
    public function onItemAdded(callable $listener): int;

    /**
     * Adds a listener that will be triggered when a record is removed from the collection.
     * @param callable $listener
     * @return int
     */
    public function onItemRemoved(callable $listener): int;
}
