<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtils\Interfaces\IntegerPrimaryCollectionInterface;
use AppUtils\Interfaces\StringPrimaryCollectionInterface;
use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\IntegerPrimaryCollectionEmptyImpl;
use AppUtilsTestClasses\IntegerPrimaryCollectionImpl;
use AppUtilsTestClasses\IntegerPrimaryCollectionNoDefaultImpl;
use AppUtilsTestClasses\StringPrimaryCollectionEmptyImpl;
use AppUtilsTestClasses\StringPrimaryCollectionNoDefaultImpl;

final class IntegerCollectionClassTests extends BaseTestCase
{
    public function test_getItems() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $this->assertCount(3, $collection->getAll());
    }

    public function test_getByID() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $item = $collection->getByID(IntegerPrimaryCollectionImpl::ITEM_A);

        $this->assertSame(IntegerPrimaryCollectionImpl::ITEM_A, $item->getID());
    }

    public function test_getByIDNotExistsException() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $this->expectExceptionCode(IntegerPrimaryCollectionImpl::ERROR_CODE_RECORD_NOT_FOUND);

        $collection->getByID(999);
    }

    public function test_idExists() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $this->assertTrue($collection->idExists(IntegerPrimaryCollectionImpl::ITEM_A));
    }

    public function test_idNotExists() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $this->assertFalse($collection->idExists(999));
    }

    public function test_getDefault() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $item = $collection->getDefault();

        $this->assertSame(IntegerPrimaryCollectionImpl::DEFAULT_ITEM, IntegerPrimaryCollectionImpl::ITEM_A, 'Default must be item A.');
        $this->assertSame(IntegerPrimaryCollectionImpl::DEFAULT_ITEM, $item->getID());
    }

    public function test_getIDs() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $this->assertSame(
            array(
                IntegerPrimaryCollectionImpl::ITEM_A,
                IntegerPrimaryCollectionImpl::ITEM_B,
                IntegerPrimaryCollectionImpl::ITEM_C
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
     * The collection uses {@see BaseIntegerPrimaryCollection::getAutoDefault()}
     * to determine the default item. This must be the first item
     * in the collection.
     */
    public function test_noSpecificDefaultItem() : void
    {
        $collection = new IntegerPrimaryCollectionNoDefaultImpl();

        $this->assertNotEmpty($collection->getAll());

        $this->assertSame(
            IntegerPrimaryCollectionNoDefaultImpl::ITEM_A,
            $collection->getDefaultID()
        );

        $this->assertSame(
            IntegerPrimaryCollectionNoDefaultImpl::ITEM_A,
            $collection->getDefault()->getID()
        );
    }

    /**
     * An empty collection is fully functional until you try to
     * access the default item. This causes an exception because
     * {@see IntegerPrimaryCollectionInterface::getByID()} expects
     * the ID to exist.
     */
    public function test_emptyCollection() : void
    {
        $collection = new IntegerPrimaryCollectionEmptyImpl();

        $this->assertEmpty($collection->getAll());

        $this->assertSame(
            IntegerPrimaryCollectionInterface::ID_NO_DEFAULT_AVAILABLE,
            $collection->getDefaultID()
        );

        $this->expectExceptionCode(IntegerPrimaryCollectionInterface::ERROR_CODE_RECORD_NOT_FOUND);

        $collection->getDefault();
    }
}
