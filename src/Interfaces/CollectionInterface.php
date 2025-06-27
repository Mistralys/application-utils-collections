<?php

declare(strict_types=1);

namespace AppUtils\Interfaces;

use AppUtils\Collections\Events\ItemsInitializedEvent;

/**
 * Interface for classes that can be used as collections.
 *
 * > NOTE: This base interface does not contain all relevant
 * > methods, these are added by the type-specific interfaces,
 * > like {@see StringPrimaryCollectionInterface}.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 */
interface CollectionInterface
{
    /**
     * @return CollectionRecordInterface[]
     */
    public function getAll() : array;

    /**
     * @return array<int|mixed>
     */
    public function getIDs() : array;

    public function getDefault() : CollectionRecordInterface;

    public function countRecords() : int;

    /**
     * Adds a listener that will be called when the items
     * in the collection have been fully initialized.
     *
     * The listener gets a single argument, which is the
     * event object of the type {@see ItemsInitializedEvent}.
     *
     * @param callable $listener
     * @return int Number of the listener, which can be used to remove it later. NOTE: The number is unique across all collections during the application lifetime.
     */
    public function onItemsInitialized(callable $listener) : int;

    /**
     * Removes a listener by its number.
     *
     * @param int $listenerNumber
     * @return $this
     */
    public function removeListener(int $listenerNumber) : self;

    /**
     * Removes all listeners for all events.
     *
     * @return $this
     */
    public function removeAllListeners() : self;

    /**
     * Returns the listeners for a specific event.
     *
     * @param string $eventName
     * @return array<int,callable> Listener numbers as keys, listeners as values.
     */
    public function getEventListeners(string $eventName) : array;
}
