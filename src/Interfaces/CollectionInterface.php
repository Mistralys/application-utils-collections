<?php

declare(strict_types=1);

namespace AppUtils\Interfaces;

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
}
