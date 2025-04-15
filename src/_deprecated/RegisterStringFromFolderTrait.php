<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\ClassHelper;
use AppUtils\ClassHelper\BaseClassHelperException;
use AppUtils\FileHelper\FolderInfo;
use AppUtils\FileHelper_Exception;
use AppUtils\Interfaces\StringPrimaryRecordInterface;

/**
 * DEPRECATED: Use {@see RegisterFolderClassesTrait} instead.
 *
 * @package App Utils
 * @subpackage Collections
 * @deprecated Use {@see RegisterFolderClassesTrait} instead.
 */
trait RegisterStringFromFolderTrait
{
    /**
     * @return void
     * @throws BaseClassHelperException
     * @throws FileHelper_Exception
     */
    protected function registerItems(): void
    {
        $this->registerFromClassFolder(
            $this->getClassesFolder(),
            $this->getReferenceClassName()
        );
    }

    /**
     * @param FolderInfo $folder
     * @param class-string $referenceClass
     * @return void
     * @throws BaseClassHelperException
     * @throws FileHelper_Exception
     */
    protected function registerFromClassFolder(FolderInfo $folder, string $referenceClass) : void
    {
        $classes = ClassHelper::findClassesInRepository($folder, true, $referenceClass);
        foreach($classes as $class) {
            $this->registerItem($this->createItemInstance($class));
        }
    }

    abstract protected function getClassesFolder() : FolderInfo;

    /**
     * Gets the class name used as a reference to generate the
     * class names.
     *
     * @return class-string
     */
    abstract protected function getReferenceClassName() : string;

    /**
     * Creates an instance of the target item class.
     * This allows passing any required constructor parameters.
     *
     * @param class-string $class
     * @return StringPrimaryRecordInterface
     */
    abstract protected function createItemInstance(string $class) : StringPrimaryRecordInterface;
}
