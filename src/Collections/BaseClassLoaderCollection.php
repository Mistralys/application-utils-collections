<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\ClassHelper;
use AppUtils\ClassHelper\BaseClassHelperException;
use AppUtils\ClassHelper\Repository\ClassRepositoryException;
use AppUtils\ConvertHelper;
use AppUtils\Interfaces\ClassLoaderCollectionInterface;
use AppUtils\Interfaces\StringPrimaryRecordInterface;

/**
 * Collection class that loads its items from classes
 * in a specific folder and instantiating them.
 * Supports filtering the classes by their type.
 *
 * ## Usage
 *
 * 1. Extend this class
 * 2. Implement the interface methods
 *
 * To filter the classes, return the class name to filter
 * by in {@see getInstanceOfClassName()}.
 *
 * @package App Utils
 * @subpackage Collections
 */
abstract class BaseClassLoaderCollection extends BaseStringPrimaryCollection implements ClassLoaderCollectionInterface
{
    /**
     * @return void
     * @throws CollectionException {@see CollectionException::ERROR_CLASS_CACHE_FOLDER_NOT_SET}
     * @throws BaseClassHelperException
     */
    protected function registerItems(): void
    {
        $this->requireCacheFolderIsSet();

        foreach($this->getClassNames() as $class) {
            $this->registerItem($this->createItemInstance($class));
        }
    }

    private function requireCacheFolderIsSet() : void
    {
        if (ClassHelper::getCacheFolder() !== null) {
            return;
        }

        throw new CollectionException(
            'The class cache folder is not set. ',
            sprintf(
                'The cache folder must be set with %s before loading classes.',
                ConvertHelper::callback2string(array(ClassHelper::class, 'setCacheFolder'))
            ),
            CollectionException::ERROR_CLASS_CACHE_FOLDER_NOT_SET
        );
    }

    /**
     * @inheritDoc
     * @throws ClassRepositoryException
     */
    public function getClassNames() : array
    {
        return ClassHelper::findClassesInRepository(
            $this->getClassesFolder(),
            true,
            $this->getInstanceOfClassName()
        )
            ->getClasses();
    }

    /**
     * Creates an instance of the target item class.
     * This allows passing any required constructor parameters.
     *
     * @param class-string $class
     * @return StringPrimaryRecordInterface
     */
    abstract protected function createItemInstance(string $class) : StringPrimaryRecordInterface;
}
