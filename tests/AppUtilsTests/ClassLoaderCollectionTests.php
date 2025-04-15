<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtils\ClassHelper;
use AppUtils\FileHelper\FolderInfo;
use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\ClassLoaderCollectionImpl;
use AppUtilsTestClasses\StringClassesFolder\StringItemA;
use AppUtilsTestClasses\StringClassesFolder\StringItemB;
use AppUtilsTestClasses\StringClassesFolder\StringItemC;
use AppUtilsTestClasses\ClassLoaderCollectionInstanceOfImpl;

final class ClassLoaderCollectionTests extends BaseTestCase
{
    // region: _Tests

    /**
     * Collection that loads all classes without instanceof filtering.
     * @see ClassLoaderCollectionImpl
     */
    public function test_getItems() : void
    {
        $collection = new ClassLoaderCollectionImpl();

        $this->assertCount(3, $collection->getAll());
        $this->assertInstanceOf(StringItemB::class, $collection->getByID(StringItemB::ITEM_ID));
        $this->assertInstanceOf(StringItemC::class, $collection->getDefault());
    }

    /**
     * Collection limited to load instances of {@see StringItemA}.
     * @see ClassLoaderCollectionInstanceOfImpl
     */
    public function test_getItemsInstanceOf() : void
    {
        $collection = new ClassLoaderCollectionInstanceOfImpl();

        $this->assertCount(1, $collection->getAll());
        $this->assertInstanceOf(StringItemA::class, $collection->getByID(StringItemA::ITEM_ID));
    }

    // endregion

    // region: Support methods

    protected function setUp(): void
    {
        parent::setUp();

        ClassHelper::setCacheFolder(FolderInfo::factory(__DIR__.'/../cache'));
    }

    // endregion
}
