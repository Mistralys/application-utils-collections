<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\Interfaces\ClassLoaderCollectionInterface;
use AppUtils\Interfaces\ClassLoaderCollectionMultiInterface;
use AppUtils\Traits\BaseClassLoaderCollectionTrait;
use AppUtils\Traits\ClassLoaderCollectionMultiTrait;

/**
 * Collection class that loads its items from classes
 * in multiple folders and instantiating them.
 * Supports filtering the classes by their type.
 *
 *  ## Usage
 *
 *  1. Set the class cache folder using {@see ClassHelper::setCacheFolder()}.
 *  2. Extend this class
 *  3. Implement the abstract methods
 *
 *  To filter the classes, return the class name to filter
 *  by in {@see self::getInstanceOfClassName()}.
 *
 * @package App Utils
 * @subpackage Collections
 */
abstract class BaseClassLoaderCollectionMulti extends BaseStringPrimaryCollection implements ClassLoaderCollectionMultiInterface
{
    use BaseClassLoaderCollectionTrait;
    use ClassLoaderCollectionMultiTrait;
}
