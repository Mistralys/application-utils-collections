<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtils\Baskets\GenericIntegerPrimaryBasket;
use AppUtils\Baskets\GenericStringPrimaryBasket;
use AppUtils\Collections\Events\ItemRemovedEvent;
use AppUtils\Interfaces\CollectionInterface;
use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\IntegerPrimaryRecordImpl;
use AppUtilsTestClasses\SpecificItemBasketImpl;
use AppUtilsTestClasses\SpecificItemImpl;
use AppUtilsTestClasses\StringPrimaryRecordImpl;
use stdClass;

final class BasketCollectionTests extends BaseTestCase
{
    public function test_emptyByDefault() : void
    {
        $collection = new GenericStringPrimaryBasket();

        $this->assertEmpty($collection->getAll());
        $this->assertSame(0, $collection->countRecords());
    }

    public function test_addItem() : void
    {
        $collection = new GenericStringPrimaryBasket();

        $collection->addItem(new StringPrimaryRecordImpl('foo'));

        $this->assertCount(1, $collection->getAll());
        $this->assertSame('foo', $collection->getByID('foo')->getID());
    }

    public function test_addMultipleItems() : void
    {
        $collection = new GenericStringPrimaryBasket();

        $collection->addItems(array(
            new StringPrimaryRecordImpl('foo'),
            new StringPrimaryRecordImpl('bar')
        ));

        $this->assertCount(2, $collection->getAll());
        $this->assertSame('foo', $collection->getByID('foo')->getID());
        $this->assertSame('bar', $collection->getByID('bar')->getID());
    }

    public function test_addAny() : void
    {
        $this->assertRecordCount(0, GenericStringPrimaryBasket::create()->addAny());

        $this->assertRecordCount(1, GenericStringPrimaryBasket::create()->addAny(new StringPrimaryRecordImpl('foo')));

        $this->assertRecordCount(
            2,
            GenericStringPrimaryBasket::create()->addAny(
                new StringPrimaryRecordImpl('bar'),
                new stdClass(),
                123,
                'baz',
                array(
                    array(
                        null,
                        array(
                            new StringPrimaryRecordImpl('qux')
                        )
                    )
                )
            )
        );

        $this->assertRecordCount(
            2,
            GenericStringPrimaryBasket::create()->addAny(array(
                new StringPrimaryRecordImpl('qux'),
                new StringPrimaryRecordImpl('quux')
            ))
        );
    }

    public function assertRecordCount(int $count, CollectionInterface $collection) : void
    {
        $this->assertSame($count, $collection->countRecords(), 'The record count should match the expected value.');
    }

    public function test_addCollectionWithCompatibleItems() : void
    {
        $collectionA = new GenericStringPrimaryBasket(array(
            new StringPrimaryRecordImpl('foo'),
            new StringPrimaryRecordImpl('bar')
        ));

        $this->assertCount(2, $collectionA->getAll());

        $collectionB = new GenericStringPrimaryBasket(array(
            new StringPrimaryRecordImpl('baz'),
            new StringPrimaryRecordImpl('qux')
        ));

        $collectionA->addCollection($collectionB);

        $this->assertCount(4, $collectionA->getAll());
    }

    public function test_addCollectionWithIncompatibleItems() : void
    {
        $collectionA = new GenericStringPrimaryBasket(array(
            new StringPrimaryRecordImpl('foo'),
            new StringPrimaryRecordImpl('bar')
        ));

        $collectionB = new GenericIntegerPrimaryBasket(array(
            new IntegerPrimaryRecordImpl(333),
            new IntegerPrimaryRecordImpl(444)
        ));

        $collectionA->addCollection($collectionB);

        $this->assertCount(2, $collectionA->getAll());
    }

    public function test_createWithAny() : void
    {
        $collection = GenericStringPrimaryBasket::create(
            new StringPrimaryRecordImpl('foo'),
            new IntegerPrimaryRecordImpl(333),
            null,
            new stdClass(),
            547,
            array(
                new StringPrimaryRecordImpl('bar'),
                array(
                    new StringPrimaryRecordImpl('lopos'),
                )
            ),
            new GenericStringPrimaryBasket(array(
                new StringPrimaryRecordImpl('baz')
            ))
        );

        $this->assertCount(4, $collection->getAll());
        $this->assertTrue($collection->idExists('foo'));
        $this->assertTrue($collection->idExists('bar'));
        $this->assertTrue($collection->idExists('baz'));
        $this->assertTrue($collection->idExists('lopos'));
    }

    public function test_eventTriggeredForEveryItem() : void
    {
        $triggerCount = 0;

        $collection = GenericStringPrimaryBasket::create();

        $collection->onItemAdded(function() use (&$triggerCount) : void {
            $triggerCount++;
        });

        $collection->addItem(new StringPrimaryRecordImpl('foo'));
        $collection->addItem(new StringPrimaryRecordImpl('bar'));
        $collection->addItem(new StringPrimaryRecordImpl('baz'));

        $this->assertSame(3, $triggerCount, 'Events should have been triggered for each added item.');
    }

    public function test_initiallyAddedItemsAlsoTriggerEvents() : void
    {
        $triggerCount = 0;

        $collection = GenericStringPrimaryBasket::create(
            new StringPrimaryRecordImpl('foo'),
            new StringPrimaryRecordImpl('bar')
        );

        $collection->onItemAdded(function() use (&$triggerCount) : void {
            $triggerCount++;
        });

        // Trigger the item registration by accessing the collection
        $this->assertCount(2, $collection->getAll());
        $this->assertSame(2, $triggerCount, 'Events should have been triggered for the initial items.');
    }

    public function test_specificItemBasketOnlyAcceptsAllowedItems() : void
    {
        $basket = new SpecificItemBasketImpl();

        $basket->addItem(new StringPrimaryRecordImpl('foo'));
        $basket->addItem(new SpecificItemImpl('bar'));

        $this->assertCount(1, $basket->getAll());
        $this->assertSame(array('bar'), $basket->getIDs());
    }

    public function test_removeItem() : void
    {
        $collection = new GenericStringPrimaryBasket();

        $item = new StringPrimaryRecordImpl('foo');
        $collection->addItem($item);
        $collection->removeItem($item);

        $this->assertEmpty($collection->getAll());
    }

    public function test_removeItems() : void
    {
        $collection = new GenericStringPrimaryBasket();

        $collection->addItems(array(
            new StringPrimaryRecordImpl('foo'),
            new StringPrimaryRecordImpl('bar')
        ));

        $collection->removeItems(array('foo', 'bar'));

        $this->assertEmpty($collection->getAll());
    }

    public function test_itemAddedEvent() : void
    {
        $collection = new GenericStringPrimaryBasket();
        $eventTriggered = false;

        $collection->onItemAdded(function() use (&$eventTriggered) : void {
            $eventTriggered = true;
        });

        $collection->addItem(new StringPrimaryRecordImpl('foo'));

        $this->assertTrue($eventTriggered);
    }

    public function test_itemRemovedEvent() : void
    {
        $collection = new GenericStringPrimaryBasket();
        $eventTriggered = false;

        $collection->onItemRemoved(function(ItemRemovedEvent $event) use (&$eventTriggered) : void {
            $eventTriggered = true;
            $this->assertSame('foo', $event->getItem()->getID());
        });

        $item = new StringPrimaryRecordImpl('foo');
        $collection->addItem($item);
        $collection->removeItem($item);

        $this->assertTrue($eventTriggered);
    }
}
