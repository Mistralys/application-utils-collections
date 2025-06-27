<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Interfaces\IntegerPrimaryCollectionInterface
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

use AppUtils\Collections\BaseIntegerPrimaryCollection;
use AppUtils\Traits\IntegerPrimaryCollectionTrait;

/**
 * Interface for classes that can be used as collections
 * with string-based record primary keys.
 *
 * To use this interface, either:
 *
 * - Extend the {@see BaseIntegerPrimaryCollection} class.
 * - Use the {@see IntegerPrimaryCollectionTrait} trait.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 *
 * @see BaseIntegerPrimaryCollection
 * @see IntegerPrimaryCollectionTrait
 */
interface IntegerPrimaryCollectionInterface extends CollectionInterface
{
    public const ERROR_CODE_RECORD_NOT_FOUND = 148101;
    public const ID_NO_DEFAULT_AVAILABLE = -1;

    /**
     * @return object[]
     */
    public function getAll() : array;

    /**
     * @param int $id
     * @return IntegerPrimaryRecordInterface
     */
    public function getByID(int $id) : IntegerPrimaryRecordInterface;

    public function getDefault() : IntegerPrimaryRecordInterface;

    public function getDefaultID() : int;

    public function idExists(int $id) : bool;

    /**
     * @return int[]
     */
    public function getIDs() : array;
}
