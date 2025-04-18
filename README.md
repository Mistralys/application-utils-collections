# AppUtils - Collections

Interfaces, traits and classes for handling static item collections,
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

- [Class folder loading](tests/AppUtilsTestClasses/ClassLoaderCollectionImpl.php)
- [Class folder loading (filtered)](tests/AppUtilsTestClasses/ClassLoaderCollectionInstanceOfImpl.php)
- [Class folder loading (multiple folders)](tests/AppUtilsTestClasses/ClassLoaderCollectionMultiImpl.php)

[Application Utils]: https://github.com/Mistralys/application-utils
