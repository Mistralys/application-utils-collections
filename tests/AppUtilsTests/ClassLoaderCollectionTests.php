<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\ClassLoaderCollectionImpl;
use AppUtilsTestClasses\ClassLoaderCollectionMultiImpl;
use AppUtilsTestClasses\StringClassesFolderB\StringItemA;
use AppUtilsTestClasses\StringClassesFolderB\StringItemB;
use AppUtilsTestClasses\StringClassesFolderB\StringItemC;
use AppUtilsTestClasses\ClassLoaderCollectionInstanceOfImpl;
use AppUtilsTestClasses\StringClassesFolderA\StringItemD;

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

    /**
     * Collection that loads classes from multiple folders without instanceof filtering.
     *
     * This tests several things:
     *
     * - That duplicate folder paths do not lead to duplicate items
     * - That non-existent folders are ignored
     *
     * @see ClassLoaderCollectionMultiImpl
     */
    public function test_multipleFolders() : void
    {
        $collection = new ClassLoaderCollectionMultiImpl();

        $this->assertCount(4, $collection->getAll());
        $this->assertInstanceOf(StringItemD::class, $collection->getByID(StringItemD::ITEM_ID));
    }

    /**
     * Collection that loads classes from multiple folders without instanceof filtering.
     *
     * This tests several things:
     *
     * - That duplicate folder paths do not lead to duplicate class entries
     * - That non-existent folders are ignored
     * - That the classes are sorted alphabetically
     *
     * WARNING: The namespaces influence the order of the classes.
     *
     * This can be deceiving because like in this test, the namespace imports
     * cause them to not be directly visible. As a result, the {@see StringItemD}
     * class is listed first, even though you would expect {@see StringItemA}
     * to come first.
     *
     * @see ClassLoaderCollectionMultiImpl
     */
    public function test_classNamesAreSorted() : void
    {
        $collection = new ClassLoaderCollectionMultiImpl();

        $this->assertSame(
            array(
                StringItemD::class,
                StringItemA::class,
                StringItemB::class,
                StringItemC::class
            ),
            $collection->getClassNames()
        );
    }

    // endregion
}
