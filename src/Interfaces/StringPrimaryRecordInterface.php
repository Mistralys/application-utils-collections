<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Interfaces\StringPrimaryRecordInterface
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

/**
 * Interface for records that have a string-based primary key.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 */
interface StringPrimaryRecordInterface extends CollectionRecordInterface
{
    public function getID() : string;
}
