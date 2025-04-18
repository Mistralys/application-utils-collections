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
use AppUtilsTestClasses\StringClassesFolderB\StringItemA;

/**
 * Implements a class loader collection that only loads
 * classes that are instances of a specific class.
 *
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method BaseStringItem[] getAll()
 * @method BaseStringItem getByID(string $id)
 * @method BaseStringItem getDefault()
 */
class ClassLoaderCollectionInstanceOfImpl extends BaseClassLoaderCollection
{
    public function getDefaultID(): string
    {
        return StringItemA::ITEM_ID;
    }

    public function getClassesFolder(): FolderInfo
    {
        return FolderInfo::factory(__DIR__ . '/StringClassesFolderB');
    }

    public function isRecursive(): bool
    {
        return true;
    }

    public function getInstanceOfClassName(): ?string
    {
        return StringItemA::class;
    }

    protected function createItemInstance(string $class): BaseStringItem
    {
        return ClassHelper::requireObjectInstanceOf(
            BaseStringItem::class,
            new $class()
        );
    }
}
