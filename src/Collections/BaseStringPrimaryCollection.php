<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Collections\BaseStringPrimaryCollection
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\Interfaces\StringPrimaryCollectionInterface;
use AppUtils\Traits\StringPrimaryCollectionTrait;

/**
 * Base class for item collections that have a string-based
 * primary key for records.
 *
 * > NOTE: If you want to use this functionality without extending
 * > this class, you can use the {@see StringPrimaryCollectionTrait}
 * > trait instead.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 *
 * @see StringPrimaryCollectionTrait
 */
abstract class BaseStringPrimaryCollection extends BaseCollection implements StringPrimaryCollectionInterface
{
    use StringPrimaryCollectionTrait;
}
