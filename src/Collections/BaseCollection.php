<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\Collections\Events\CollectionEventInterface;
use AppUtils\Collections\Events\ItemsInitializedEvent;

/**
 * Base class for all collection types.
 *
 * @package App Utils
 * @subpackage Collections
 */
abstract class BaseCollection implements CollectionEventsInterface
{
    protected array $eventListeners = array();

    protected static int $listenerCounter = 0;

    public function countRecords() : int
    {
        return count($this->getIDs());
    }

    public function onItemsInitialized(callable $listener) : int
    {
        return $this->addEventListener(ItemsInitializedEvent::EVENT_NAME, $listener);
    }

    protected function addEventListener(string $eventName, callable $listener) : int
    {
        self::$listenerCounter++;

        if(!isset($this->eventListeners[$eventName])) {
            $this->eventListeners[$eventName] = array();
        }

        $this->eventListeners[$eventName][self::$listenerCounter] = $listener;

        return self::$listenerCounter;
    }

    protected function triggerEvent(CollectionEventInterface $event, bool $removeListeners=true) : void
    {
        $name = $event->getEventName();

        if(!isset($this->eventListeners[$name])) {
            return;
        }

        foreach($this->eventListeners[$name] as $listener) {
            $listener($event);
        }

        if($removeListeners) {
            unset($this->eventListeners[$name]);
        }
    }

    public function removeListener(int $listenerNumber) : self
    {
        foreach($this->eventListeners as $eventName => $listeners) {
            if(isset($listeners[$listenerNumber])) {
                unset($this->eventListeners[$eventName][$listenerNumber]);
            }
        }

        return $this;
    }

    public function removeAllListeners() : self
    {
        $this->eventListeners = array();
        return $this;
    }

    public function getEventListeners(string $eventName) : array
    {
        return $this->eventListeners[$eventName] ?? array();
    }
}
