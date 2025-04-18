<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\ClassHelper;
use AppUtils\Interfaces\ClassLoaderCollectionSingleInterface;
use AppUtils\Traits\BaseClassLoaderCollectionTrait;
use AppUtils\Traits\ClassLoaderCollectionSingleTrait;

/**
 * Collection class that loads its items from classes
 * in a specific folder and instantiating them.
 * Supports filtering the classes by their type.
 *
 * ## Usage
 *
 * 1. Set the class cache folder using {@see ClassHelper::setCacheFolder()}.
 * 2. Extend this class
 * 3. Implement the abstract methods
 *
 * To filter the classes, return the class name to filter
 * by in {@see self::getInstanceOfClassName()}.
 *
 * @package App Utils
 * @subpackage Collections
 */
abstract class BaseClassLoaderCollection extends BaseStringPrimaryCollection implements ClassLoaderCollectionSingleInterface
{
    use BaseClassLoaderCollectionTrait;
    use ClassLoaderCollectionSingleTrait;
}
