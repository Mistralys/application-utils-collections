<?php

declare(strict_types=1);

namespace AppUtilsTestClasses;

use AppUtils\ClassHelper;
use AppUtils\FileHelper\FolderInfo;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected function setUp(): void
    {
        if(ClassHelper::getCacheFolder() === null) {
            ClassHelper::setCacheFolder(FolderInfo::factory(__DIR__.'/../cache'));
        }
    }
}
