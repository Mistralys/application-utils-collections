<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\ClassHelper;
use AppUtils\Collections\BaseClassLoaderCollection;
use AppUtils\FileHelper\FolderInfo;
use AppUtilsTestClasses\StringClassesFolder\StringItemC;

/**
 * Implements an unfiltered class loader collection:
 * Will load all classes in the specified folder.
 *
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method BaseStringItem[] getAll()
 * @method BaseStringItem getByID(string $id)
 * @method BaseStringItem getDefault()
 */
class ClassLoaderCollectionImpl extends BaseClassLoaderCollection
{
    public function getDefaultID(): string
    {
        return StringItemC::ITEM_ID;
    }

    public function getClassesFolder(): FolderInfo
    {
        return FolderInfo::factory(__DIR__.'/StringClassesFolder');
    }

    public function isRecursive(): bool
    {
        return true;
    }

    public function getInstanceOfClassName(): ?string
    {
        return null;
    }

    protected function createItemInstance(string $class): BaseStringItem
    {
        return ClassHelper::requireObjectInstanceOf(
            BaseStringItem::class,
            new $class()
        );
    }
}
