<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Interfaces\IntegerPrimaryRecordInterface
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

/**
 * Interface for records that have an integer-based primary key.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 */
interface IntegerPrimaryRecordInterface extends CollectionRecordInterface
{
    public function getID() : int;
}
