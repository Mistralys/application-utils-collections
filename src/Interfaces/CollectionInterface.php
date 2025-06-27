<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

/**
 * General-purpose interface for classes that can be used as collections.
 *
 * > NOTE: This base interface is not strictly type-specific.
 * > Separate interfaces are used to refine the type of IDs
 * > used to identify records in the collection.
 * > An example is {@see StringPrimaryCollectionInterface}.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 */
interface CollectionInterface
{
    /**
     * Gets all records available in the collection.
     * @return CollectionRecordInterface[]
     */
    public function getAll() : array;

    /**
     * Gets a list of all IDs in the collection.
     * @return array<int,string|int>
     */
    public function getIDs() : array;

    /**
     * Gets the default record in the collection.
     * @return CollectionRecordInterface
     */
    public function getDefault() : CollectionRecordInterface;

    /**
     * Counts all records available in the collection.
     * @return int
     */
    public function countRecords() : int;
}
