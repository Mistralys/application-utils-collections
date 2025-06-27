<?php
/**
 * @package App Utils
 * @subpackage Collection Events
 */

declare(strict_types=1);

namespace AppUtils\Collections\Events;

use AppUtils\Interfaces\CollectionInterface;

/**
 * This event is triggered when items in a collection have been fully initialized.
 *
 * Use {@see CollectionInterface::onItemsInitialized()} to add a listener for this event.
 *
 * @package App Utils
 * @subpackage Collection Events
 */
class ItemsInitializedEvent extends BaseCollectionEvent
{
    public const EVENT_NAME = 'ItemsInitialized';

    public function getEventName(): string
    {
        return self::EVENT_NAME;
    }
}
