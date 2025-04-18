<?php

declare(strict_types=1);

namespace AppUtils;

class ComposerScripts
{
    public static function clearClassCache() : void
    {
        require_once __DIR__ . '/../tests/bootstrap.php';

        ClassHelper::getRepositoryManager()->clearCache();

        echo 'Class cache cleared.' . PHP_EOL;
    }
}
