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

    /**
     * Gets all folders in which to look for classes.
     *
     * > NOTE: If a folder does not exist on disk,
     * > it will be silently ignored. If this is not
     * > the desired behavior, check if the folder
     * > exists in your folder logic.
     *
     * @return FolderInfo[]
     */
    public function getClassFolders() : array;

    /**
     * Whether classes are loaded recursively from subfolders.
     * @return bool
     */
    public function isRecursive() : bool;
}
