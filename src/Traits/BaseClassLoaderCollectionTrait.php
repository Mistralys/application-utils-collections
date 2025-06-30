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
use AppUtils\ClassHelper\Repository\ClassRepositoryManager;
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
 * ## Custom class repository
 *
 * The class loader will use the global class repository manager
 * that relies on the Class Helper's cache folder being set via
 * {@see ClassHelper::setCacheFolder()}.
 *
 * Override the {@see self::getClassRepository()} method if you
 * want to use a custom class repository manager instance with
 * a different cache folder.
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

        foreach($this->getClassNames() as $class)
        {
            $instance = $this->createItemInstance($class);

            if($instance !== null) {
                $this->registerItem($instance);
            }
        }
    }

    /**
     * @throws CollectionException {@see CollectionException::ERROR_CLASS_CACHE_FOLDER_NOT_SET}
     * @throws ClassRepositoryException
     */
    private function requireCacheFolderIsSet() : void
    {
        if ($this->getClassRepository()->getCacheFolder()->exists()) {
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
     * Overridable method that can be used to work with
     * a custom class repository manager instance instead
     * of the default one.
     *
     * @overridable
     * @return ClassRepositoryManager
     * @throws ClassRepositoryException
     */
    protected function getClassRepository() : ClassRepositoryManager
    {
        return ClassHelper::getRepositoryManager()->createDefault();
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
                ...$this->getClassRepository()->findClassesInFolder(
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
     * > NOTE: Returning `NULL` will skip the item, which
     * > is useful to filter out classes according to your
     * > needs.
     *
     * @param class-string $class
     * @return StringPrimaryRecordInterface|NULL
     */
    abstract protected function createItemInstance(string $class) : ?StringPrimaryRecordInterface;
}
