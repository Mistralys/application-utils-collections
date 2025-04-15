<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

use AppUtils\Collections\BaseClassLoaderCollection;
use AppUtils\FileHelper\FolderInfo;

/**
 * Interface for collections that load items from classes
 * stored in a folder.
 *
 * @package App Utils
 * @subpackage Collections
 * @see BaseClassLoaderCollection
 */
interface ClassLoaderCollectionInterface extends StringPrimaryCollectionInterface
{
    public function getClassesFolder() : FolderInfo;

    /**
     * If not `NULL`, only instances of this type will be loaded.
     *
     * @return class-string|NULL Return `NULL` to load all classes.
     */
    public function getInstanceOfClassName() : ?string;

    /**
     * @return class-string[]
     */
    public function getClassNames() : array;
}
