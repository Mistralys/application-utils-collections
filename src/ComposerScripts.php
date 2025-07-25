<?php
/**
 * @package AppUtils
 * @subpackage Composer
 */

declare(strict_types=1);

namespace AppUtils;

use AppUtils\Collections\Build\TraitBuilder;

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
        self::pl("Clearing class cache...");

        self::init();

        ClassHelper::getRepositoryManager()->clearCache();

        self::pl('DONE.');
    }

    public static function build() : void
    {
        self::pl("Building...");

        self::init();

        (new TraitBuilder())->build();

        self::pl('DONE.');
    }

    private static bool $initialized = false;

    private static function init() : void
    {
        if(self::$initialized) {
            return;
        }

        self::$initialized = true;

        require_once __DIR__ . '/../tests/bootstrap.php';
    }

    /**
     * @param string $message
     * @param string|int|float|NULL ...$args
     * @return void
     */
    private static function pl(string $message, ...$args): void
    {
        if (count($args) > 0) {
            $message = vsprintf($message, $args);
        }

        echo $message . PHP_EOL;
    }
}
