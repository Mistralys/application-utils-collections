<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

use AppUtils\Collections\BaseClassLoaderCollectionMulti;
use AppUtils\Traits\ClassLoaderCollectionMultiTrait;

/**
 * Interface for collections that load items from classes
 * stored in multiple folders.
 *
 * This is implemented by {@see ClassLoaderCollectionMultiTrait}.
 *
 * @package App Utils
 * @subpackage Collections
 * @see BaseClassLoaderCollectionMulti
 * @see ClassLoaderCollectionMultiTrait
 */
interface ClassLoaderCollectionMultiInterface extends ClassLoaderCollectionInterface
{
}
