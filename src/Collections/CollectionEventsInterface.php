<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\Interfaces\CollectionInterface;

/**
 * Interface for the available item collections that support events.
 *
 * @package App Utils
 * @subpackage Collections
 */
interface CollectionEventsInterface extends CollectionInterface
{
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
