<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\StringClassesFolder\StringItemB;
use AppUtilsTestClasses\StringClassesFolder\StringItemC;
use AppUtilsTestClasses\StringPrimaryFolderCollectionImpl;

final class StringFromFolderTests extends BaseTestCase
{
    public function test_getItems() : void
    {
        $collection = new StringPrimaryFolderCollectionImpl();

        $this->assertCount(3, $collection->getAll());
        $this->assertInstanceOf(StringItemB::class, $collection->getByID(StringItemB::ITEM_ID));
        $this->assertInstanceOf(StringItemC::class, $collection->getDefault());
    }
}
