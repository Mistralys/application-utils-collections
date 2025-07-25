## v1.2.0 - Basket Collections
- Baskets: Added basket-like collections to handle items that can be added and removed.
- Collections: Improved some type handling and documentation.
- Build: Added the `composer build` command.
- Build: Now dynamically generating traits to reduce maintenance overhead.
- PHPStan: Clean up to level 9.

## v1.1.9 - Class loader filtering
- ClassLoader: `createItemInstance()` can now return `NULL` to ignore classes following the application's logic.

## v1.1.8 - Collection events
- Collections: Split off the event methods into a separate interface to avoid event implementation conflicts with other event handling systems.

## v1.1.7 - Collection events
- Collections: Added a collection init event that can be listened to.

## v1.1.6 - Improved exception
- Collections: The record ID not found exception has been improved with more information.

## v1.1.5 - Class loader collection
- ClassLoader: Added overridable `getClassRepository()` to work with a custom class repository instance.
- Dependencies: App Utils Core now requires a minimum version of [v2.3.11](https://github.com/Mistralys/application-utils-core/releases/tag/2.3.11).

## v1.1.4 - Class loader collection
- ClassLoader: Added the `BaseClassLoaderCollectionMulti` to load classes from multiple folders.
- Core: Added the protected method `getAutoDefault()` to handle non-default-aware collections.
- Core: Added a Composer script to clear the class cache on dump-autoload for the tests.

## v1.1.3 - Class loader collection (Deprecation)
- ClassLoader: Added the `BaseClassLoaderCollection` to use the class registry for loading classes.
- Code: Added PHPStan utility shell scripts and configuration.
- Code: Clean up to PHPStan level 9.
- Dependencies: App Utils Core now requires a minimum version of [v2.3.7](https://github.com/Mistralys/application-utils-core/releases/tag/2.3.7).

### Deprecations
- The trait `RegisterStringFromFolderTrait` is obsolete. Use the class loader collection
  or trait and interface instead.

## v1.1.2 - Folder auto-loading
- Added `RegisterStringFromFolderTrait` to automatically load collection item classes from a folder.
- Added overridable `sortItems()` to customize the collection item sorting.
- Dependencies: App Utils Core now requires a minimum version of [v2.2.3](https://github.com/Mistralys/application-utils-core/releases/tag/2.2.3).

## v1.1.1 - Counting records
- Added the collection `countRecords()` method.
- Added the `BaseCollection` class.

## v1.1.0 - Added integer collection
- Added the integer-based collection and record classes.
- Added some docs in the readme.

## v1.0.1 - Dependency update
- Dependencies: Relaxed Core version requirement to `>=1.0`.

## v1.0.0 - Initial release
- Added base structure with string-based collections and records.
