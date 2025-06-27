<?php
/**
 * @package App Utils
 * @subpackage Collection Events
 */

declare(strict_types=1);

namespace AppUtils\Collections\Events;

use AppUtils\Interfaces\CollectionInterface;

/**
 * Interface for collection events.
 * A base implementation is provided by {@see BaseCollectionEvent}.
 *
 * @package App Utils
 * @subpackage Collection Events
 */
interface CollectionEventInterface
{
    public function getEventName() : string;
    public function getCollection(): CollectionInterface;
}
