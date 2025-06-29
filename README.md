# AppUtils - Collections

Interfaces, traits and classes for handling item collections,
similar to Enums and with useful getter methods. 

In essence, it allows creating collections like this with a 
minimum of code:

```php
$basil = Herbs::getInstance()->getByID(Herbs::BASIL);

echo $basil->getID(); // basil
echo $basil->getName(); // Basil
```

```php
foreach(Herbs::getInstance()->getAll() as $herb) {
    echo $herb->getName();
}
```

> This is part of the [Application Utils][] ecology.

## The Principle

The basic principle is to have a collection class for a data type,
which knows all the possible values for that type, and a record class
that represents a single value of that type.

The collections and records are distinguished by the return type of
their `getID()` method. 

> Currently, only string and integer types are supported.

## Implementation

There are two ways to implement collections: 

1. By extending the abstract base classes (e.g. `BaseStringPrimaryCollection`)
2. By implementing the interface and trait (e.g. `StringPrimaryCollectionTrait`)

> The second way is useful when working with classes that already 
> extend another class.

The records have no abstract base class, only an interface that
contains the `getID()` method with the relevant return type.

## Usage

There are example implementations of the string and integer collections
in the unit test classes:

### Items with an integer-based ID

- [Integer collection](tests/AppUtilsTestClasses/IntegerPrimaryCollectionImpl.php) 
- [Integer record](tests/AppUtilsTestClasses/IntegerPrimaryRecordImpl.php)
- [Non-default-aware collection](tests/AppUtilsTestClasses/IntegerPrimaryCollectionNoDefaultImpl.php)

### Items with a string-based ID

- [String collection](tests/AppUtilsTestClasses/IntegerPrimaryCollectionImpl.php)
- [String record](tests/AppUtilsTestClasses/IntegerPrimaryRecordImpl.php)
- [Non-default-aware collection](tests/AppUtilsTestClasses/StringPrimaryCollectionNoDefaultImpl.php)

### Dynamic class loading

This specialized collection loads all classes from a folder that match a 
given interface or class name, instantiates them, and gives access to the
resulting objects. 

Fueled by AppUtils' ClassHelper class loading mechanism, it is a powerful, 
fire-and-forget tool that helps with building dynamic applications. 

- [Class folder loading](tests/AppUtilsTestClasses/ClassLoaderCollectionImpl.php)
- [Class folder loading (filtered)](tests/AppUtilsTestClasses/ClassLoaderCollectionInstanceOfImpl.php)
- [Class folder loading (multiple folders)](tests/AppUtilsTestClasses/ClassLoaderCollectionMultiImpl.php)

### Events

Items in a collection are initialized on demand. To be able to react to this, 
the collections offer the `onItemsInitialized()` method, which can be used to
register a listener that is called when the items are initialized.

```php
use AppUtils\Collections\Events\ItemsInitializedEvent;use AppUtilsTestClasses\StringPrimaryCollectionImpl;

$collection = new StringPrimaryCollectionImpl();

// Register listeners before accessing the items
$collection->onItemsInitialized(function(ItemsInitializedEvent $event) : void {
    // Do something
});

$collection->getAll(); // This, for example, will trigger the event
```

[Application Utils]: https://github.com/Mistralys/application-utils
