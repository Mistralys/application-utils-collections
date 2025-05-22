<?php
/**
 * @package App Utils
 * @subpackage Collections
 */

declare(strict_types=1);

namespace AppUtils\Collections;

use AppUtils\BaseException;

/**
 * Exception class for the Collections module.
 *
 * @package App Utils
 * @subpackage Collections
 */
class CollectionException extends BaseException
{
    public const ERROR_CLASS_CACHE_FOLDER_NOT_SET = 176901;
}
