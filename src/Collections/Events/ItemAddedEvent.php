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
 * This event is triggered when items in a collection have been fully initialized.
 *
 * Use {@see CollectionInterface::onItemsInitialized()} to add a listener for this event.
 *
 * @package App Utils
 * @subpackage Collection Events
 */
class ItemAddedEvent extends BaseCollectionEvent
{
    public const EVENT_NAME = 'ItemAdded';
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
