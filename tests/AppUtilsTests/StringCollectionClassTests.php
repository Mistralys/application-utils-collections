<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtils\Collections\BaseStringPrimaryCollection;
use AppUtils\Interfaces\StringPrimaryCollectionInterface;
use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\IntegerPrimaryCollectionImpl;
use AppUtilsTestClasses\StringPrimaryCollectionEmptyImpl;
use AppUtilsTestClasses\StringPrimaryCollectionImpl;
use AppUtilsTestClasses\StringPrimaryCollectionNoDefaultImpl;

final class StringCollectionClassTests extends BaseTestCase
{
    public function test_getItems() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $this->assertCount(3, $collection->getAll());
    }

    public function test_getByID() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $item = $collection->getByID(StringPrimaryCollectionImpl::ITEM_A);

        $this->assertSame(StringPrimaryCollectionImpl::ITEM_A, $item->getID());
    }

    public function test_getByIDNotExistsException() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $this->expectExceptionCode(StringPrimaryCollectionImpl::ERROR_CODE_RECORD_NOT_FOUND);

        $collection->getByID('unknown item');
    }

    public function test_idExists() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $this->assertTrue($collection->idExists(StringPrimaryCollectionImpl::ITEM_A));
    }

    public function test_idNotExists() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $this->assertFalse($collection->idExists('unknown item'));
    }

    public function test_getDefaultWithSpecificDefaultCollection() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $item = $collection->getDefault();

        $this->assertSame(StringPrimaryCollectionImpl::DEFAULT_ITEM, StringPrimaryCollectionImpl::ITEM_A, 'Default must be item A.');
        $this->assertSame(StringPrimaryCollectionImpl::DEFAULT_ITEM, $item->getID());
    }

    public function test_getIDs() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $this->assertSame(
            array(
                StringPrimaryCollectionImpl::ITEM_A,
                StringPrimaryCollectionImpl::ITEM_B,
                StringPrimaryCollectionImpl::ITEM_C
            ),
            $collection->getIDs()
        );
    }

    public function test_countRecords() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $this->assertSame(3, $collection->countRecords());
    }

    /**
     * The collection uses {@see BaseStringPrimaryCollection::getAutoDefault()}
     * to determine the default item. This must be the first item
     * in the collection.
     */
    public function test_noSpecificDefaultItem() : void
    {
        $collection = new StringPrimaryCollectionNoDefaultImpl();

        $this->assertNotEmpty($collection->getAll());

        $this->assertSame(
            StringPrimaryCollectionNoDefaultImpl::ITEM_A,
            $collection->getDefaultID()
        );

        $this->assertSame(
            StringPrimaryCollectionNoDefaultImpl::ITEM_A,
            $collection->getDefault()->getID()
        );
    }

    /**
     * An empty collection is fully functional until you try to
     * access the default item. This causes an exception because
     * {@see StringPrimaryCollectionInterface::getByID()} expects
     * the ID to exist.
     */
    public function test_emptyCollection() : void
    {
        $collection = new StringPrimaryCollectionEmptyImpl();

        $this->assertEmpty($collection->getAll());

        $this->assertSame(
            StringPrimaryCollectionInterface::ID_NO_DEFAULT_AVAILABLE,
            $collection->getDefaultID()
        );

        $this->expectExceptionCode(StringPrimaryCollectionInterface::ERROR_CODE_RECORD_NOT_FOUND);

        $collection->getDefault();
    }
}
