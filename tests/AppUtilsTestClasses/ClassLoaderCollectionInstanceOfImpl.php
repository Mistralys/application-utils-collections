<?php
/**
 * @package App Utils Tests
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtilsTestClasses\StringClassesFolder\StringItemA;

/**
 * @package App Utils Tests
 * @subpackage Collections
 *
 * @method BaseStringItem[] getAll()
 * @method BaseStringItem getByID(string $id)
 * @method BaseStringItem getDefault()
 */
class ClassLoaderCollectionInstanceOfImpl extends ClassLoaderCollectionImpl
{
    public function getInstanceOfClassName(): string
    {
        return StringItemA::class;
    }
}
