<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\ClassHelper;
use AppUtils\ClassHelper\BaseClassHelperException;
use AppUtils\Collections\BaseStringPrimaryCollection;
use AppUtils\FileHelper\FolderInfo;
use AppUtils\FileHelper_Exception;
use AppUtils\Interfaces\StringPrimaryRecordInterface;

/**
 * Trait that can be used to register all items in a collection
 * from classes loaded from a specific folder.
 *
 * Usage:
 *
 * 1. Create a class that extends {@see BaseStringPrimaryCollection}.
 * 2. Add this trait to the class.
 * 3. Implement the abstract methods.
 *
 * For an example, see {@see \AppUtilsTestClasses\StringPrimaryFolderCollectionImpl}.
 *
 * @package App Utils
 * @subpackage Collections
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
        $classes = ClassHelper::getClassesInFolder($folder, $referenceClass);
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
