<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Interfaces\StringPrimaryCollectionInterface
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

use AppUtils\Collections\BaseStringPrimaryCollection;
use AppUtils\Traits\StringPrimaryCollectionTrait;

/**
 * Interface for classes that can be used as collections
 * with string-based record primary keys.
 *
 * To use this interface, either:
 *
 * - Extend the {@see BaseStringPrimaryCollection} class.
 * - Use the {@see StringPrimaryCollectionTrait} trait.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 *
 * @see BaseStringPrimaryCollection
 * @see StringPrimaryCollectionTrait
 */
interface StringPrimaryCollectionInterface extends CollectionInterface
{
    public const ERROR_CODE_RECORD_NOT_FOUND = 145501;
    public const ID_NO_DEFAULT_AVAILABLE = 'no-default-available';

    /**
     * @return object[]
     */
    public function getAll() : array;

    /**
     * @param string $id
     * @return StringPrimaryRecordInterface
     */
    public function getByID(string $id) : StringPrimaryRecordInterface;

    public function getDefault() : StringPrimaryRecordInterface;

    public function getDefaultID() : string;

    public function idExists(string $id) : bool;

    /**
     * @return string[]
     */
    public function getIDs() : array;
}
