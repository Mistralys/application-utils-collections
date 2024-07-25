<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\ClassHelper;
use AppUtils\Collections\BaseStringPrimaryCollection;
use AppUtils\FileHelper\FolderInfo;
use AppUtils\Traits\RegisterStringFromFolderTrait;
use AppUtilsTestClasses\StringClassesFolder\StringItemA;
use AppUtilsTestClasses\StringClassesFolder\StringItemC;

/**
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method BaseStringItem[] getAll()
 * @method BaseStringItem getByID(string $id)
 * @method BaseStringItem getDefault()
 */
class StringPrimaryFolderCollectionImpl extends BaseStringPrimaryCollection
{
    use RegisterStringFromFolderTrait;

    public function getDefaultID(): string
    {
        return StringItemC::ITEM_ID;
    }

    protected function getClassesFolder(): FolderInfo
    {
        return FolderInfo::factory(__DIR__.'/StringClassesFolder');
    }

    protected function getReferenceClassName(): string
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
