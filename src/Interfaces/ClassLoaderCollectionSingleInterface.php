<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Interfaces;

use AppUtils\Collections\BaseClassLoaderCollection;
use AppUtils\FileHelper\FolderInfo;
use AppUtils\Traits\ClassLoaderCollectionSingleTrait;

/**
 * Interface for collections that load items from classes
 * stored in a single folder (with or without subfolders).
 *
 * This is implemented using {@see ClassLoaderCollectionSingleTrait}.
 *
 * @package App Utils
 * @subpackage Collections
 * @see BaseClassLoaderCollection
 * @see ClassLoaderCollectionSingleTrait
 */
interface ClassLoaderCollectionSingleInterface extends ClassLoaderCollectionInterface
{
    public function getClassesFolder() : FolderInfo;
}
