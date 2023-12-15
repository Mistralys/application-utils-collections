<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Collections\BaseIntegerPrimaryCollection
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\Interfaces\IntegerPrimaryCollectionInterface;
use AppUtils\Traits\IntegerPrimaryCollectionTrait;

/**
 * Base class for item collections that have a string-based
 * primary key for records.
 *
 * NOTE: If you want to use this functionality without extending
 * this class, you can use the {@see IntegerPrimaryCollectionTrait}
 * trait instead.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 *
 * @see IntegerPrimaryCollectionTrait
 */
abstract class BaseIntegerPrimaryCollection implements IntegerPrimaryCollectionInterface
{
    use IntegerPrimaryCollectionTrait;
}
