<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\ClassHelper;
use AppUtils\Interfaces\CollectionInterface;
use AppUtils\Interfaces\IntegerPrimaryCollectionInterface;

/**
 * Exception thrown when a record does not exist in a collection.
 *
 * > Note: the exception code is specific to the collection type.
 * > For example, {@see IntegerPrimaryCollectionInterface::ERROR_CODE_RECORD_NOT_FOUND}.
 *
 * @package App Utils
 * @subpackage Collections
 */
class RecordNotExistsException extends CollectionException
{
    /**
     * @param CollectionInterface $collection
     * @param string|int $recordID
     * @param int $code Error code to use.
     */
    public function __construct(CollectionInterface $collection, $recordID, int $code)
    {
        parent::__construct(
            'Collection record does not exist.',
            sprintf(
                'The collection record with ID [%s] does not exist in the [%s] collection. '.PHP_EOL.
                'Available IDs are: '.PHP_EOL.
                '- %s',
                $recordID,
                ClassHelper::getClassTypeName($collection),
                implode(PHP_EOL.'- ', $collection->getIDs())
            ),
            $code
        );
    }
}
