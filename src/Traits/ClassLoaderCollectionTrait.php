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
 * from classes in a specific folder.
 *
 * @package App Utils
 * @subpackage Collections
 * @see ClassLoaderCollectionInterface
 * @see BaseClassLoaderCollection
 */
trait ClassLoaderCollectionTrait
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
            $this->isRecursive(),
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
