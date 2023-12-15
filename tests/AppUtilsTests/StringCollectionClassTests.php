<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\StringPrimaryCollectionImpl;

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

    public function test_getDefault() : void
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
}
