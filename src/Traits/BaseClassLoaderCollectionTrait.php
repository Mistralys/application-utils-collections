<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\ClassHelper;
use AppUtils\ClassHelper\BaseClassHelperException;
use AppUtils\ClassHelper\Repository\ClassRepositoryException;
use AppUtils\Collections\BaseClassLoaderCollection;
use AppUtils\Collections\CollectionException;
use AppUtils\ConvertHelper;
use AppUtils\Interfaces\ClassLoaderCollectionInterface;
use AppUtils\Interfaces\StringPrimaryRecordInterface;

/**
 * Trait used to implement collections that load their items
 * from classes in folders on disk.
 *
 * ## Usage
 *
 * 1. Use this trait.
 * 2. Use either the trait {@see ClassLoaderCollectionSingleTrait} or {@see ClassLoaderCollectionMultiTrait}.
 * 3. Implement either the interface {@see ClassLoaderCollectionSingleInterface} or {@see ClassLoaderCollectionMultiInterface}.
 * 4. Implement the abstract methods.
 *
 * @package App Utils
 * @subpackage Collections
 * @see ClassLoaderCollectionInterface
 * @see BaseClassLoaderCollection
 */
trait BaseClassLoaderCollectionTrait
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

    /**
     * @throws CollectionException {@see CollectionException::ERROR_CLASS_CACHE_FOLDER_NOT_SET}
     */
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
        $classes = array();

        foreach($this->getClassFolders() as $folder)
        {
            if(!$folder->exists()) {
                continue;
            }

            array_push(
                $classes,
                ...ClassHelper::findClassesInRepository(
                    $folder,
                    $this->isRecursive(),
                    $this->getInstanceOfClassName()
                )
                    ->getClasses()
            );
        }

        $classes = array_unique($classes);

        sort($classes);

        return $classes;
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
