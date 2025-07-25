<?php

declare(strict_types=1);

namespace AppUtilsTests;

use AppUtils\Collections\CollectionEventsInterface;
use AppUtils\Collections\Events\ItemsInitializedEvent;
use AppUtilsTestClasses\BaseTestCase;
use AppUtilsTestClasses\IntegerPrimaryCollectionImpl;
use AppUtilsTestClasses\StringPrimaryCollectionImpl;

final class EventTests extends BaseTestCase
{
    public function test_itemsInitializedString() : void
    {
        $collection = new StringPrimaryCollectionImpl();

        $this->assertCollectionTriggersInitialization($collection);
    }

    public function test_itemsInitializedInteger() : void
    {
        $collection = new IntegerPrimaryCollectionImpl();

        $this->assertCollectionTriggersInitialization($collection);
    }

    protected function assertCollectionTriggersInitialization(CollectionEventsInterface $collection) : void
    {
        $triggered = false;

        $collection->onItemsInitialized(function (ItemsInitializedEvent $event) use(&$triggered, $collection): void {
            $triggered = true;
            $this->assertSame($event->getCollection(), $collection, 'Event collection does not match the collection');
        });

        $this->assertCount(1, $collection->getEventListeners(ItemsInitializedEvent::EVENT_NAME), 'Event listener not registered');

        // Force the initialization of items
        $collection->getAll();

        $this->assertTrue($triggered, 'Event was not triggered');

        $this->assertCount(0, $collection->getEventListeners(ItemsInitializedEvent::EVENT_NAME), 'Event listener not removed after triggering');
    }
}
