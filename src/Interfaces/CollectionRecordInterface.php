<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Interfaces\CollectionRecordInterface
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

/**
 * Interface for records that can be used in collections.
 *
 * NOTE: This base interface does not contain all relevant
 * methods, these are added by the type-specific interfaces,
 * like {@see StringPrimaryRecordInterface}.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 */
interface CollectionRecordInterface
{
    /**
     * Returns the ID of the record.
     * @return int|string The ID of the record.
     */
    public function getID(); // No type hint here to let the implementing class decide on the type.
}
