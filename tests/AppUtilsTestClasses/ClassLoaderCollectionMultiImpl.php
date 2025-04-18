<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\ClassHelper;
use AppUtils\Collections\BaseClassLoaderCollectionMulti;
use AppUtils\FileHelper\FolderInfo;
use AppUtilsTestClasses\StringClassesFolderB\StringItemC;

/**
 * Implements an unfiltered class loader collection
 * that will load classes from multiple folders.
 *
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method BaseStringItem[] getAll()
 * @method BaseStringItem getByID(string $id)
 * @method BaseStringItem getDefault()
 */
class ClassLoaderCollectionMultiImpl extends BaseClassLoaderCollectionMulti
{
    public function getDefaultID(): string
    {
        return StringItemC::ITEM_ID;
    }

    public function getClassFolders(): array
    {
        return array(
            FolderInfo::factory(__DIR__ . '/StringClassesFolderB'),
            FolderInfo::factory(__DIR__ . '/StringClassesFolderA'),

            // Duplicate folder: Must not create duplicate class entries
            FolderInfo::factory(__DIR__ . '/StringClassesFolderB'),

            // Non-existent folder, must be ignored
            FolderInfo::factory('/NonExistentFolder')
        );
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
