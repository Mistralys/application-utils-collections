<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\Collections\BaseClassLoaderCollectionMulti;
use AppUtils\Interfaces\ClassLoaderCollectionMultiInterface;

/**
 * Trait used to implement collections that load their items
 * from classes in multiple folders.
 *
 * ## Usage
 *
 * 1. Use this trait.
 * 2. Use the trait {@see BaseClassLoaderCollectionTrait}.
 * 3. Implement the interface {@see ClassLoaderCollectionMultiInterface}.
 * 4. Implement the abstract methods.
 *
 * @package App Utils
 * @subpackage Collections
 * @see ClassLoaderCollectionMultiInterface
 * @see BaseClassLoaderCollectionMulti
 */
trait ClassLoaderCollectionMultiTrait
{

}
