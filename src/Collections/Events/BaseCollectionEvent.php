<?php
/**
 * @package App Utils
 * @subpackage Collection Events
 */

declare(strict_types=1);

namespace AppUtils\Collections\Events;

use AppUtils\Interfaces\CollectionInterface;

/**
 * @package App Utils
 * @subpackage Collection Events
 */
abstract class BaseCollectionEvent implements CollectionEventInterface
{
    protected CollectionInterface $collection;

    public function __construct(CollectionInterface $collection)
    {
        $this->collection = $collection;
    }

    public function getCollection(): CollectionInterface
    {
        return $this->collection;
    }
}
