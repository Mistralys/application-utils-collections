<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\IntegerPrimaryCollectionImpl;

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
}
