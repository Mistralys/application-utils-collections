<?php
/**
 * @package AppUtils
 * @subpackage Composer
 */

declare(strict_types=1);

namespace AppUtils;

/**
 * Used as a repository for composer scripts.
 *
 * @package AppUtils
 * @subpackage Composer
 */
class ComposerScripts
{
    public static function clearClassCache() : void
    {
        echo "Clearing class cache..." . PHP_EOL;

        require_once __DIR__ . '/../tests/bootstrap.php';

        ClassHelper::getRepositoryManager()->clearCache();

        echo 'DONE.' . PHP_EOL;
    }
}
