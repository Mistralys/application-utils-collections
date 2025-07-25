<?php
/**
 * @package App Utils
 * @subpackage Collection Events
 */

declare(strict_types=1);

namespace AppUtils\Collections\Events;

use AppUtils\Interfaces\CollectionInterface;
use AppUtils\Interfaces\CollectionRecordInterface;

/**
 * This event is triggered when an item has been removed from a collection.
 *
 * Use {@see CollectionInterface::onItemRemoved()} to add a listener for this event.
 *
 * @package App Utils
 * @subpackage Collection Events
 */
class ItemRemovedEvent extends BaseCollectionEvent
{
    public const EVENT_NAME = 'ItemRemoved';

    private CollectionRecordInterface $item;

    public function getEventName(): string
    {
        return self::EVENT_NAME;
    }

    public function __construct(CollectionInterface $collection, CollectionRecordInterface $item)
    {
        $this->item = $item;
        parent::__construct($collection);
    }

    public function getItem(): CollectionRecordInterface
    {
        return $this->item;
    }
}
