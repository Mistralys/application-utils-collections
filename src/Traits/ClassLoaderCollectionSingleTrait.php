<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\Collections\BaseClassLoaderCollection;
use AppUtils\Interfaces\ClassLoaderCollectionSingleInterface;

/**
 * Trait used to implement collections that load their items
 * from classes in a specific folder.
 *
 * ## Usage
 *
 * 1. Use this trait.
 * 2. Use the trait {@see BaseClassLoaderCollectionTrait}.
 * 3. Implement the interface {@see ClassLoaderCollectionSingleInterface}.
 * 4. Implement the abstract methods.
 *
 * @package App Utils
 * @subpackage Collections
 * @see ClassLoaderCollectionSingleInterface
 * @see BaseClassLoaderCollection
 */
trait ClassLoaderCollectionSingleTrait
{
    public function getClassFolders() : array
    {
        return array($this->getClassesFolder());
    }
}
