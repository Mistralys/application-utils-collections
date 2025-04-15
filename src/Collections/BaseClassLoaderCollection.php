<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\Interfaces\ClassLoaderCollectionInterface;
use AppUtils\Traits\ClassLoaderCollectionTrait;

/**
 * Collection class that loads its items from classes
 * in a specific folder and instantiating them.
 * Supports filtering the classes by their type.
 *
 * ## Usage
 *
 * 1. Extend this class
 * 2. Implement the interface methods
 *
 * To filter the classes, return the class name to filter
 * by in {@see getInstanceOfClassName()}.
 *
 * @package App Utils
 * @subpackage Collections
 */
abstract class BaseClassLoaderCollection extends BaseStringPrimaryCollection implements ClassLoaderCollectionInterface
{
    use ClassLoaderCollectionTrait;
}
